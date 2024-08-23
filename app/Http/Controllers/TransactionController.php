<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $avatar = Avatar::all();
        return view('buyavatar', compact('avatar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $avatar_id = $request->input('avatar_id');
        $avatar = Avatar::findOrFail($avatar_id);
        $user = User::findOrFail(auth()->user()->id);

        $transaction_already = Transaction::where('transactions.avatar_id', $avatar_id)
            ->where('transactions.user_id', auth()->user()->id)->exists();

        if ($transaction_already) {
            return redirect()->back()->with('error', 'Avatar is already bought!');
        } else {
            if ($user->coin < $avatar->price) {
                return redirect()->back()->with('error', 'Your Balance is not enough to buy!');
            } else {
                $user->coin -= $avatar->price;
                $user->save();

                Transaction::create([
                    'avatar_id' => $avatar_id,
                    'user_id' => $user->id
                ]);

                return redirect()->back()->with('success', 'Your transaction is success!');
            }
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    public function myavatar()
    {
        $avatar = Transaction::join('users', 'users.id', '=', 'transactions.user_id')
            ->join('avatars', 'avatars.id', 'transactions.avatar_id')
            ->where('transactions.user_id', auth()->user()->id)
            ->select([
                'avatars.id as id',
                'avatars.name as name',
                'avatars.image as image'
            ])->get();

        return view('myavatar', compact('avatar'));
    }

    public function useavatar($avatar_id)
    {
        $user = User::findOrFail(auth()->user()->id);
        $avatar = Avatar::findOrFail($avatar_id);

        $user->image = $avatar->image;
        $user->is_avatar = true;
        $user->save();

        return redirect()->route('profile');
    }

    public function sendavatar(Request $request)
    {
        $avatar_id = $request->input('avatar_id');
        $avatar = Avatar::findOrFail($avatar_id);

        $user = User::where('id', '!=', auth()->user()->id)
            ->get();
        return view('sendavatar', compact('user', 'avatar'));
    }

    public function sendgift(Request $request)
    {

        // dd($request);

        $rules = [
            'name' => 'required',
        ];

        $message = [
            'required' => ':attribute must be choosen'
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()->withErrors($validator);
        } else {
            $avatar_id = $request->input('avatar_id');
            $receiver_id = $request->input('name');
            $sender = User::findOrFail(auth()->user()->id);

            $avatar = Avatar::findOrFail($avatar_id);

            $transaction_check = Transaction::where('transactions.avatar_id', $avatar_id)
                ->where('transactions.user_id', $receiver_id)->exists();

            if ($transaction_check) {
                return redirect()->back()->with('error', 'User has already have the avatar');
            } else {
                $sender->coin -= $avatar->price;
                $sender->save();

                Transaction::create([
                    'user_id' => $receiver_id,
                    'avatar_id' => $avatar_id
                ]);

                return redirect()->route('transaction.index')->with('success', 'Avatar has been send as gift!');
            }
        }
    }

}
