<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;

class TestController extends Controller {
    public function test(Request $request) {
        $userController = app()->make('App\Http\Controllers\UserController');
        $data = $userController->getTenCustomer();
        // 検索フォームで入力された値を取得する
        $search = $request->search;
        // 検索ワードがあった場合
        if ($search) {
            $data = $userController->getSearchedCustomer($search);
        }
        return view('test',compact('data', 'search'));
    }
}
