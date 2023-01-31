<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller {
    // 他のコントローラーのメソッドを使う準備
    public function __construct() {
        $this->errorController = app()->make('App\Http\Controllers\ErrorController');
    }

    // 登録されているカットメニューを全部取得
    public function getMenus() {
        try {
            DB::beginTransaction();
            $menus = Menu::all();
            DB::commit();
            return $menus;
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    // 表示中のカットメニューを取得
    public function getDisplayedCutMenu() {
        try {
            DB::beginTransaction();
            $sql = Menu::query();
            $sql->where('display', 0);
            $menus = $sql->get();
            DB::commit();
            return $menus;
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    // 指定のカットメニューを取得
    public function getSelectedMenu($id) {
        try {
            DB::beginTransaction();
            $menu = Menu::find($id);
            DB::commit();
            return $menu;
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    // カットメニュー編集
    public function editCutMenu($request) {
        try {
            DB::beginTransaction();
            $menu = MEnu::find($request->id);
            $menu->name = $request->name;
            $menu->price = $request->price;
            $menu->doing_time = $request->doing_time;
            $menu->display = $request->display;
            $menu->save();
            DB::commit();
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    // カットメニュー追加
    public function addCutMenu($request) {
        try {
            DB::beginTransaction();
            $menu = new Menu();
            $menu->name = $request->name;
            $menu->price = $request->price;
            $menu->doing_time = $request->doing_time;
            $menu->display = $request->display;
            $menu->save();
            DB::commit();
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    // カットメニュー削除
    public function deleteCutMenu($id) {
        try {
            DB::beginTransaction();
            $menu = Menu::find($id);
            $menu->delete();
            DB::commit();
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }
}
