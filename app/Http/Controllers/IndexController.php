<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class IndexController extends Controller {
    // 他のコントローラーのメソッドを使う準備
    public function __construct() {
        $this->menuController = app()->make('App\Http\Controllers\MenuController');
        $this->emptyStatusController = app()->make('App\Http\Controllers\EmptyStatusController');
        $this->waitingStatusController = app()->make('App\Http\Controllers\WaitingStatusController');
    }

    public function index(Request $request) {
        // セッション削除
        $request->session()->forget('email');
        // 空席状況の取得
        $empty = $this->emptyStatusController->getSelectedEmptyStatus();
        // 待ち状況の取得
        $waiting = $this->waitingStatusController->getSelectedWaitingStatus();
        // メニュー全件取得
        $menus = $this->menuController->getDisplayedCutMenu();
        return view('cutHouseMoon.index',compact('empty', 'waiting', 'menus'));
    }
}
