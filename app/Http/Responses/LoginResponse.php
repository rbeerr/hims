<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        // if (Auth::user()->user_type == '1') {  // '1' is for Admin
        //     return redirect()->route('admin.manage-account');
        // } elseif (Auth::user()->user_type == '2') { // '2' is for Employee
        //     return redirect()->route('employee.dashboard');
        // }

        // // Fallback in case neither condition is met
        // return $request->wantsJson()
        //     ? response()->json(['two_factor' => false])
        //     : redirect()->intended(config('fortify.home'));
    }
}
