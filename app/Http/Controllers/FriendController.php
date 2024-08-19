<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $friend_requested = Friend::join('users', 'friends.sender_id', '=', 'users.id')
            ->where('friends.sender_id', '=', auth()->user()->id)
            ->where('friends.status', 0)
            ->select([
                'friends.id as id',
                'friends.sender_id as sender_id',
                'friends.receiver_id as receiver_id',
                'users.name as name',
                'users.image as image',
                'users.hobby as hobby'
            ])->get();

        $friend_accepted = Friend::join('users', 'friends.sender_id', '=', 'users.id')
            ->where('friends.receiver_id', '=', auth()->user()->id)
            ->where('friends.status', 0)
            ->select([
                'friends.id as id',
                'friends.sender_id as sender_id',
                'friends.receiver_id as receiver_id',
                'users.name as name',
                'users.image as image',
                'users.hobby as hobby'
            ])->get();

        $new_friend = Friend::join('users', 'friends.sender_id', '=', 'users.id')
            ->where('friends.status', 1)
            ->select([
                'friends.id as id',
                'friends.sender_id as sender_id',
                'friends.receiver_id as receiver_id',
                'users.name as name',
                'users.image as image',
                'users.hobby as hobby'
            ])->get();

        return view('myfriends', compact('friend_requested', 'friend_accepted', 'new_friend'));
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
        $receiver_id = $request->input('receiver_id');
        $friends = Friend::where('friends.receiver_id', $receiver_id)
            ->where('friends.sender_id', auth()->user()->id)->select('*')->exists();

        if ($friends == false) {
            Friend::create([
                'receiver_id' => $receiver_id,
                'sender_id' => auth()->user()->id,
                'status' => false
            ]);
        } else {
            return redirect()->back()->with('error', 'Friend Requested is already sent!');
        }

        return redirect()->back()->with('success', 'Friend Requested has been sent!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Friend $friend)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Friend $friend)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Friend $friend)
    {
        $friend->status = 1;
        $friend->save();

        return redirect()->back()->with('success', 'Friend Request has been accepted!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Friend $friend)
    {
        $friend->delete();
        return redirect()->back()->with('success', 'Friend has been successfully deleted!');
    }
}
