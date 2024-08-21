<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

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

        Transaction::create([
            'avatar_id' => $avatar_id,
            'user_id' => $user->id
        ]);

        if ($user->coin < $avatar->price) {
            return redirect()->back()->with('error', 'Your Balance is not enough to buy!');
        } else {
            $user->coin -= $avatar->price;
            $user->save();

            return redirect()->back()->with('success', 'Your transaction is success!');
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
                'avatars.name as name',
                'avatars.image as image'
            ])->get();

        return view('myavatar', compact('avatar'));
    }
}
