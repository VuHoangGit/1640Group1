<?php

namespace App\Http\Controllers;

use app\Http\Controllers\Controller;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Session;

class PortalController
{
    public function login(Request $request)
    {
        // $request->validate([
        //     'email' => ['required','email','unique:users'],
        //     'password' => ['required','min:5','max:20']
        //     // 'remember' => ['nullable', 'boolean']
        // ]);
        // $user = User::where('email','=', $request->email)->first();
        // if ($user) {
        //     if (Hash::check($request -> password, $user->passwordHash)){
        //         $request->session()->put('loginId',$user->userid);
        //         return view("admin.home");
        //     } else {
        //         return back() ->with('fail', 'Password not matches');
        //     }
        // } else {
        //     return back() -> with('fail', 'This email is not registered.');
        // }
        return view("admin.home");
    }

    public function forgotPassword(){
        return view("portal.forgotPassword");
    }
    public function newPassword(){
        return view("portal.resetPassword");
    }


}
