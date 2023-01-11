<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/cutHouseMoon/index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
        $this->userController = app()->make('App\Http\Controllers\UserController');
    }

    public function resetPasswordFirst(Request $request) {
        // 戻るボタン以外からのアクセスの時はセッションクリア
        $referer = $request->header('referer');
        if (strpos($referer, 'resetPasswordSecond') == false) {
            $request->session()->forget('email');
        }
        return view('auth.passwords.reset.resetPasswordFirst');
    }

    public function checkEmail(Request $request) {
        $request->validate([
            'email' => 'required|email:filter|exists:users,email',
        ]);
        $request->session()->put('email', $request->email);
        return redirect(route('resetPasswordSecond'));
    }

    public function resetPasswordSecond(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'resetPassword') == false) {
            return redirect(route('index'));
        }
        return view('auth.passwords.reset.resetPasswordSecond');
    }

    public function resetPass(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'resetPasswordSecond') == false) {
            return redirect(route('index'));
        }
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);
        $this->userController->resetPassword($request);
        $request->session()->forget('email');
        return view('auth.passwords.reset.resetPasswordComplete');
    }
}
