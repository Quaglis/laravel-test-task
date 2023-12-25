<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailController extends Controller
{
    public function emailVerifyNotice() 
    {
        return view('pages/email-verify');
    }

    public function emailVerifyHandler(EmailVerificationRequest $request) 
    {
        $request->fulfill();

        return redirect('index');
    }
}
