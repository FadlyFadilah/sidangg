<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;

class HomeController
{
    public function index()
    {
        // $users = User::find(auth()->user()->id);
        // foreach ($users->roles as $user) {
        //     if ($user->title == 'Admin') {
        //         echo 'ya';
        //     } else {
        //         echo 'tidak';
        //     }
        // }
        return view('home');
    }
}