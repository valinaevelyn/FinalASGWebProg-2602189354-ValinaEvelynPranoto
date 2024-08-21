<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $friend_accepted = Friend::join('users', 'friends.sender_id', '=', 'users.id')
            ->where('friends.receiver_id', '=', auth()->user()->id)
            ->where('friends.status', 0)
            ->exists();

        $notification = $friend_accepted ? 'You have new friend requests' : null;

        $user = User::where('id', '!=', auth()->user()->id)
            ->where('users.is_visible', 1)
            ->get();

        if ($notification) {
            session()->flash('notification', $notification);
        }

        return view('home', compact('user'));
    }

    public function filter_gender($gender)
    {
        $user = User::where('users.gender', $gender)->select('*')->get();

        return view('home', compact('user'));
    }

    public function search(Request $request)
    {
        $user = User::where('users.hobby', 'LIKE', '%' . $request->input('input_search') . '%')->select('*')->get();

        return view('home', compact('user'));
    }


}
