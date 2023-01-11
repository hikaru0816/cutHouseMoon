<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\EmptyStatus;

class EmptyStatusController extends Controller {
    // 他のコントローラーのメソッドを使う準備
    public function __construct() {
        $this->errorController = app()->make('App\Http\Controllers\ErrorController');
    }

    // 空席状況の取得
    public function getSelectedEmptyStatus() {
        try {
            DB::beginTransaction();
            $sql = EmptyStatus::query();
            $sql->where('empty_select', 1);
            $emptyStatus = $sql->first();
            DB::commit();
            return $emptyStatus;
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    // 登録されている空席状況を全部取得
    public function getEmptyStatuses() {
        try {
            DB::beginTransaction();
            $emptyStatuses = EmptyStatus::all();
            DB::commit();
            return $emptyStatuses;
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    // 空席状況の選択を解除
    public function resetEmptyStatus() {
        try {
            DB::beginTransaction();
            $prevEmpty = $this->getSelectedEmptyStatus();
            $prevEmpty->empty_select = 0;
            $prevEmpty->save();
            DB::commit();
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    // 空席状況を更新
    public function updateEmptyStatus($id) {
        try {
            DB::beginTransaction();
            $newEmpty = EmptyStatus::find($id);
            $newEmpty->empty_select = 1;
            $newEmpty->save();
            DB::commit();
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }
}
