<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::where('id', '!=', auth()->user()->id)->get();

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
