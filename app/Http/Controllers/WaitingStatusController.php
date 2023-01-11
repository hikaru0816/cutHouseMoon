<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\WaitingStatus;

class WaitingStatusController extends Controller {
    // 他のコントローラーのメソッドを使う準備
    public function __construct() {
        $this->errorController = app()->make('App\Http\Controllers\ErrorController');
    }

    // 選択中の待ち状況の取得
    public function getSelectedWaitingStatus() {
        try {
            DB::beginTransaction();
            $sql = WaitingStatus::query();
            $sql->where('waiting_select', 1);
            $waitingStatus = $sql->first();
            DB::commit();
            return $waitingStatus;
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    // 登録されている待ち状況を全部取得
    public function getWaitingStatuses() {
        try {
            DB::beginTransaction();
            $waitingStatuses = WaitingStatus::all();
            DB::commit();
            return $waitingStatuses;
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    // 空席状況の選択を解除
    public function resetWaitingStatus() {
        try {
            DB::beginTransaction();
            $prevWaiting = $this->getSelectedWaitingStatus();
            $prevWaiting->waiting_select = 0;
            $prevWaiting->save();
            DB::commit();
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    // 空席状況を更新
    public function updateWaitingStatus($id) {
        try {
            DB::beginTransaction();
            $newWaiting = WaitingStatus::find($id);
            $newWaiting->waiting_select = 1;
            $newWaiting->save();
            DB::commit();
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }
}
