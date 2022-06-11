<?php
//Onwerを追加
namespace App\Http\Controllers\Owner\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
                    //OWNER_HOMEに変更
                    ? redirect()->intended(RouteServiceProvider::OWNER_HOME)
                    //owner.を追加
                    : view('owner.auth.verify-email');
    }
}
