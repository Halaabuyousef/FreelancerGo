<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    // function verify(Request $request, $guard)
    // {
    //     $token = $request->query('token');

    //     $provider = config("auth.guards.$guard.provider");
    //     $modelClass = config("auth.providers.$provider.model");

    //     $user =  $modelClass::where('verification_token', $token)->first();

    //     $sendAt = Carbon::parse($user->verification_token_sent_at);
    //     if (Carbon::now()->diffInHours($sendAt) > 24) {
    //         return 'انتهت مدة الرابط ';
    //     }

    //     $user->update([
    //         'verification_token' => null,
    //         'verification_token_sent_at' => null,
    //         'email_verified_at' => now(),
    //     ]);

    //     return 'تمت العملية بنجاح ';
    // }

    public function verify(Request $request, $guard)
{
    $token = $request->query('token');

    $provider = config("auth.guards.$guard.provider");
    $modelClass = config("auth.providers.$provider.model");

    $user = $modelClass::where('verification_token', $token)->first();

    if (!$user) {
        return redirect()->route("$guard.indexLogin")->withErrors(['message' => 'المستخدم غير موجود أو الرمز خاطئ']);
    }

    $sendAt = $user->verification_token_sent_at;

    if (!$sendAt || Carbon::now()->diffInHours($sendAt) > 24) {
        return redirect()->route("$guard.indexLogin")->withErrors(['message' => 'انتهت صلاحية الرابط']);
    }

    $user->email_verified_at = now();
    $user->verification_token = null;
    $user->verification_token_sent_at = null;
    $user->save();

    return redirect()->route("$guard.indexLogin")->with('status', 'تم التحقق من بريدك الإلكتروني بنجاح');
}
}
