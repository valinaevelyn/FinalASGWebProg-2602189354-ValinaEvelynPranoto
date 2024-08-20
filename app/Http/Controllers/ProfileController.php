<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(auth()->user()->id);

        return view('profile', compact('user'));
    }

    public function topup()
    {
        $user = User::findOrFail(auth()->user()->id);
        $user->coin += 100;
        $user->save();

        return redirect()->back();
    }
}
