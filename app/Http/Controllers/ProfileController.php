<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ProfileController extends Controller
{
    public function index()
    {
        $loc = session()->get('locale');
        App::setLocale($loc);

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
                'users.hobby as hobby',
                'users.is_avatar as is_avatar'
            ])
            ->get();

        return view('profile', compact('user', 'new_friend'));
    }

    public function topup()
    {
        $loc = session()->get('locale');
        App::setLocale($loc);

        $user = User::findOrFail(auth()->user()->id);
        $user->coin += 100;
        $user->save();

        return redirect()->back();
    }

    public function visibility(Request $request)
    {
        $loc = session()->get('locale');
        App::setLocale($loc);

        $visibility = $request->input('is_visible');
        $user = User::findOrFail(auth()->user()->id);

        if ($visibility == 1) {
            if ($user->coin < 50) {
                return redirect()->back()->with('error', 'Your Balance is not enough to hide!');
            } else {
                $user->coin -= 50;
                $user->is_visible = false;
                $user->save();

                return redirect()->back()->with('success', 'Your profile now hidden!');
            }
        } else if ($visibility == 0) {
            if ($user->coin < 5) {
                return redirect()->back()->with('error', 'Your Balance is not enough to show!');
            } else {
                $user->coin -= 5;
                $user->is_visible = true;
                $user->save();

                return redirect()->back()->with('success', 'Your profile is back now!');
            }
        }
    }
}
