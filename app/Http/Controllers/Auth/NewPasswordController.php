<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class NewPasswordController extends Controller
{
    public function resetIndex(Request $request, $token = null)
    {
        $guard = $request->route('guard');
        $email = $request->query('email');

        return view('auth.reset-password', compact('guard', 'token', 'email'));
    }

    public function resetPassword(Request $request)
    {

        // dd($request->all());
        $guard = $request->route('guard');


        $broker = $this->getPasswordBroker($guard);

        $status = Password::broker($broker)->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route("$guard.indexLogin")->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    // Helper method لتحديد broker حسب guard
    protected function getPasswordBroker($guard)
    {
        return match ($guard) {
            'admin' => 'admins',
            'freelancer' => 'freelancers',
            default => 'users',
        };
    }
}
