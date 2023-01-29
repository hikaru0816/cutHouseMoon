<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Exception;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
    // 他のコントローラーのメソッドを使う準備
    public function __construct() {
        $this->errorController = app()->make('App\Http\Controllers\ErrorController');
    }

    // 登録されているユーザーを全部取得
    public function getUsers() {
        try {
            DB::beginTransaction();
            $users = User::all();
            DB::commit();
            return $users;
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    // お客様ユーザーを全部取得
    public function getCustomerUsers() {
        try {
            DB::beginTransaction();
            $sql = User::query();
            $sql->where('role', 0);
            $users = $sql->get();
            DB::commit();
            return $users;
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    // 指定されたIDのユーザーを取得
    public function getSelectedUser($id) {
        try {
            DB::beginTransaction();
            $user = User::find($id);
            DB::commit();
            return $user;
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    // ユーザー登録
    public function addUser() {
        try {
            DB::beginTransaction();
            $user = new User();
            $user->name = session('name');
            $user->kana = session('kana');
            $user->search = session('name') . "(" . session('kana') . ")";
            $user->tel = session('tel');
            $user->email = session('email');
            $user->password = Hash::make(session('password'));
            $user->save();
            DB::commit();
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    // パスワード変更
    public function resetPassword(Request $request) {
        try {
            DB::beginTransaction();
            $sql = User::query();
            $sql->where('email', $request->email);
            $user = $sql->first();
            $user->password = Hash::make($request->password);
            $user->save();
            DB::commit();
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    // ユーザーを削除
    public function deleteUser($id) {
        try {
            DB::beginTransaction();
            $user = User::find($id);
            $user->delete();
            DB::commit();
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    // メールアドレスのチェック
    public function getRegistedEmail() {
        try {
            DB::beginTransaction();
            $users = User::all();
            $emails = [];
            foreach ($users as $user) {
                $emails[] = $user['email'];
            }
            DB::commit();
            return $emails;
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    // 登録内容の修正
    public function editMyInfo() {
        try {
            DB::beginTransaction();
            $user = User::find(Auth::user()->user_id);
            $user->name = session('name');
            $user->kana = session('kana');
            $user->email = session('email');
            $user->tel = session('tel');
            $user->save();
            DB::commit();
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    // 会員を10名ずつ取得
    public function getTenCustomer() {
        try {
            DB::beginTransaction();
            $users = User::where('role', 0)->paginate(10);
            DB::commit();
            return $users;
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    // 検索にヒットした会員を取得
    public function getSearchedCustomer($search) {
        try {
            // 全角スペースを半角に変換
            $spaceConversion = mb_convert_kana($search, 's');
            // 単語を半角スペースで区切り、配列にする（例："山田 翔" → ["山田", "翔"]）
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
            DB::beginTransaction();
            // クエリビルダ
            $query = User::query();
            // 単語をループで回し、ユーザーネームと部分一致するものがあれば、$queryとして保持される
            foreach($wordArraySearched as $value) {
                $query->where('search', 'like', '%'.$value.'%');
            }
            $users = $query->paginate(2);
            DB::commit();
            return $users;
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }
}
