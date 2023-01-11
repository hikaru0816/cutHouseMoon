<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    // use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = '/cutHouseMoon/index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
        // 追加
        $this->userController = app()->make('App\Http\Controllers\UserController');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => 'required|string|max:255',
    //         'email' => 'string|email|max:255|unique:users',
    //         'password' => 'required|string|min:6|confirmed',
    //         'kana' => 'required|string|max:255',
    //         'tel' => 'required|string|max:11',
    //     ],[
    //         'email.unique' => 'ご入力いただいたメールアドレスは登録されています。',
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    // protected function create(array $data)
    // {
    //     return User::create([
    //         'name' => $data['name'],
    //         'kana' => $data['kana'],
    //         'tel' => $data['tel'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //     ]);
    // }

    // 追加
    // 会員登録時にメールアドレスが既に登録済みか確認する
    // メールアドレス入力ページ
    public function registFirst(Request $request) {
        // 戻るボタン以外からのアクセスの時はセッションクリア
        $referer = $request->header('referer');
        if (strpos($referer, 'registSecond') == false) {
            session()->forget(['email', 'name', 'kana', 'tel', 'password', 'password_confirmation']);
        }
        return view('auth.regist.registFirst');
    }

    //メールアドレスの重複チェック
    public function checkEmail(Request $request) {
        $request->validate([
            'email' => 'required|email:filter|unique:users',
        ]);
        $request->session()->put('email', $request->email);
        return redirect(route('registSecond'));
    }

    // パスワード設定画面
    public function registSecond(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'regist') == false) {
            return redirect('cutHouseMoon/index');
        }
        return view('auth.regist.registSecond');
    }

    // バリデーション
    public function registCheck(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'registSecond') == false) {
            return redirect('cutHouseMoon/index');
        }
        // 入力内容の保存
        $request->session()->put('name', $request->name);
        $request->session()->put('kana', $request->kana);
        $request->session()->put('tel', $request->tel);
        $request->session()->put('password', $request->password);
        // バリデーション
        $request->validate([
            'name' => 'required|string|max:255',
            'kana' => 'required|string|max:255',
            'tel' => 'required|string|max:11',
            'password' => 'required|string|min:6|confirmed',
        ]);
        return redirect(route('registThird'));
    }

    public function registThird(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'registSecond') == false) {
            return redirect('cutHouseMoon/index');
        }
        return view('auth.regist.registThird');
    }

    public function regist(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'registThird') == false) {
            return redirect('cutHouseMoon/index');
        }
        $this->userController->addUser();
        $request->session()->forget(['email', 'name', 'kana', 'tel', 'password', 'password_confirmation']);
        return view('auth.regist.registComplete');
    }
}
