<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loc = session()->get('locale');
        App::setLocale($loc);

        $friend_requested = Friend::join('users', 'friends.receiver_id', '=', 'users.id')
            ->where('friends.sender_id', '=', auth()->user()->id)
            ->where('friends.status', 0)
            ->select([
                'friends.id as id',
                'friends.sender_id as sender_id',
                'friends.receiver_id as receiver_id',
                'users.name as name',
                'users.image as image',
                'users.hobby as hobby',
                'users.is_avatar as is_avatar'
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
                'users.hobby as hobby',
                'users.is_avatar as is_avatar'
            ])->get();

        return view('myfriends', compact('friend_requested', 'friend_accepted'));
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
        $loc = session()->get('locale');
        App::setLocale($loc);

        $receiver_id = $request->input('receiver_id');
        $friends = Friend::where([
            ['friends.receiver_id', $receiver_id],
            ['friends.sender_id', auth()->user()->id]
        ])->orWhere([
                    ['friends.receiver_id', auth()->user()->id],
                    ['friends.sender_id', $receiver_id]
                ])->select('*')->exists();

        if ($friends == false) { // kalau gak ada request temenan sm sekali
            // pov aku: ini aku sender dia receiver kalau dia mau send request
            Friend::create([
                'receiver_id' => $receiver_id,
                'sender_id' => auth()->user()->id,
                'status' => false
            ]);
        } else if ($friends == true) { // kalau sudah ada request temenan
            $friends_data = Friend::where([
                ['friends.receiver_id', $receiver_id],
                ['friends.sender_id', auth()->user()->id]
            ])->orWhere([
                        ['friends.receiver_id', auth()->user()->id],
                        ['friends.sender_id', $receiver_id]
                    ])->first();

            if ($friends_data->status == 1) {
                // kalau statusnya udah ada request temenan dan udah ada temen berarti udah masuk friend list
                return redirect()->back()->with('error', 'Already in the Friend List!');
            } else if ($friends_data->status == 0) {
                // kalau statusnya udah ada request temenan dan belom jadi temenkan kemungkinan 2
                // dari sender dia udah kirim req belum diterima
                $friend_requested = Friend::join('users', 'friends.receiver_id', '=', 'users.id')
                    ->where('friends.sender_id', '=', auth()->user()->id)
                    ->where('friends.status', 0)
                    ->select([
                        'friends.id as id',
                        'friends.sender_id as sender_id',
                        'friends.receiver_id as receiver_id',
                        'users.name as name',
                        'users.image as image',
                        'users.hobby as hobby',
                        'users.is_avatar as is_avatar'
                    ])->exists();

                if ($friend_requested) {
                    return redirect()->back()->with('error', 'Friend Requested is already sent!');
                }

                // dari receiver belum acc dan harus acc
                $friend_accepted = Friend::join('users', 'friends.sender_id', '=', 'users.id')
                    ->where('friends.receiver_id', '=', auth()->user()->id)
                    ->where('friends.status', 0)
                    ->select([
                        'friends.id as id',
                        'friends.sender_id as sender_id',
                        'friends.receiver_id as receiver_id',
                        'users.name as name',
                        'users.image as image',
                        'users.hobby as hobby',
                        'users.is_avatar as is_avatar'
                    ])->exists();

                if ($friend_accepted) {
                    $friend_accepted = Friend::join('users', 'friends.sender_id', '=', 'users.id')
                        ->where('friends.receiver_id', '=', auth()->user()->id)
                        ->where('friends.status', 0)
                        ->select([
                            'friends.id as id',
                            'friends.sender_id as sender_id',
                            'friends.receiver_id as receiver_id',
                            'friends.status as status',
                            'users.name as name',
                            'users.image as image',
                            'users.hobby as hobby',
                            'users.is_avatar as is_avatar'
                        ])->update(['status' => 1]);

                    return redirect()->route('friend.index')->with('success', 'Friend Request has been accepted!');
                }

            }
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
        $loc = session()->get('locale');
        App::setLocale($loc);

        $friend->status = 1;
        $friend->save();

        return redirect()->back()->with('success', 'Friend Request has been accepted!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Friend $friend)
    {
        $loc = session()->get('locale');
        App::setLocale($loc);

        $friend->delete();
        return redirect()->back()->with('success', 'Friend has been successfully deleted!');
    }
}
