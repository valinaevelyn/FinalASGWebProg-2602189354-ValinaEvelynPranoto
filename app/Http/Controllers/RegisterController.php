<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:5',
            'gender' => 'required',
            'hobby' => 'required|array|min:3',
            'phone_num' => 'required|min:10|max:14',
            'image' => 'required|mimes:jpg,png,jpeg|max:2048',
            'instagram' => 'required'
        ];

        $message = [
            'required' => ':attribute must be field',
            'password.min' => 'password must have minimal :min characters',
            'hobby.min' => 'hobby must selected at least 3',
            'image.mimes' => 'image must in jpg, png or jpeg format',
            'image.max' => 'image must maximal at 2 MB'
        ];

        $validator = Validator::make($request->all(), $rules, $message);
        $validator->after(function ($validator) use ($request) {
            if (strpos($request->instagram, 'http://instagram.com/') !== 0) {
                $validator->errors()->add('instagram', 'Instagram link must start with http://instagram.com/');
            }
        });

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()->withErrors($validator);
        } else {

            $image = $request->file('image');
            $path_image = time() . '.' . $image->getClientOriginalExtension();
            Storage::disk('public')->putFileAs('profile_image', $image, $path_image);

            $hobbies = implode(',', (array) $request->input('hobby'));
            $register_payment = mt_rand(100000, 125000);

            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'gender' => $request->input('gender'),
                'hobby' => $hobbies,
                'phone_number' => $request->input('phone_num'),
                'instagram' => $request->input('instagram'),
                'image' => $path_image,
                'register_payment' => $register_payment
            ]);

            $credentials = [
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ];

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->route('pay');
            }

        }

    }

    public function pay()
    {
        $user = User::findOrFail(auth()->user()->id);
        $register_payment = $user->register_payment;
        return view('payment', compact('register_payment'));
    }

    public function payment(Request $request)
    {
        $rules = [
            'payment' => 'required'
        ];

        $message = [
            'required' => 'balance must be field'
        ];

        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()->withErrors($validator);
        } else {
            $user = User::findOrFail(auth()->user()->id);
            $payment = $user->register_payment;

            $balance = $request->input('payment');
            if ($balance < $payment) {
                $underpaid = $payment - $balance;
                return redirect()->back()->with('underpaid', 'You are still underpaid ' . $underpaid);
            } else if ($balance > $payment) {
                $overpaid = $balance - $payment;
                Session::put('balance', $balance);
                return redirect()->back()->with('overpaid', "Sorry you overpaid " . $overpaid . " , would you like to enter a balance?");
            } else {
                return redirect()->route('login')->with('success', 'Account has been registered!');
            }
        }
    }

    public function overpaidyes()
    {
        $user = User::findOrFail(auth()->user()->id);
        $balance = Session::get('balance');
        $user->coin = $balance - $user->register_payment;
        $user->save();

        return redirect()->route('login')->with('success', 'Account has been registered!');
    }
}
