<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(auth()->user()->id);

        $new_friend = Friend::where('status', 1)
            ->where(function ($query) {
                $query->where('sender_id', auth()->user()->id)
                    ->orWhere('receiver_id', auth()->user()->id);
            })
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'friends.sender_id')
                    ->orOn('users.id', '=', 'friends.receiver_id');
            })
            ->where('users.id', '!=', auth()->user()->id)
            ->select([
                'friends.id as id',
                'users.name as name',
                'users.image as image',
                'users.hobby as hobby'
            ])
            ->get();

        return view('profile', compact('user', 'new_friend'));
    }

    public function topup()
    {
        $user = User::findOrFail(auth()->user()->id);
        $user->coin += 100;
        $user->save();

        return redirect()->back();
    }
}
