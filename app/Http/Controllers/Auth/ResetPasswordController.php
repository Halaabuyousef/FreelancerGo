<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{


    function forgotIndex(Request $request)
    {

        
        $guard = $request->route('guard');
        return view('auth.forget-password', compact('guard'));
    }
    function forgotPassword(Request $request)
    {
        // dd($request->all());


        $guard = $request->route('guard');
        $provider = config("auth.guards.$guard.provider");
        $model = config("auth.providers.$provider.model");

        $request->validate([
            'email'=> 'required|email',
        ]);
        $broker = match ($guard) {
            'admin' => 'admins',
            'freelancer' => 'freelancers',
            default => 'users',
        };


        $status = Password::broker($broker)->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
        
    
}
