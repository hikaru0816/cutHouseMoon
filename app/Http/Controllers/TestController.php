<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\DB;
use Exception;


class TestController extends Controller {
    public function test() {
        $userController = app()->make('App\Http\Controllers\UserController');
        $data = $userController->getFiveCustomer();
        return view('test',compact('data'));
    }
}
