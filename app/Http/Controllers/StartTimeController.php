<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\StartTime;

class StartTimeController extends Controller {
    // 他のコントローラーのメソッドを使う準備
    public function __construct() {
        $this->errorController = app()->make('App\Http\Controllers\ErrorController');
    }

    // 施術開始時間取得
    public function getStartTimes() {
        try {
            DB::beginTransaction();
            $sql = StartTime::query();
            $sql->where('status', 0);
            $startTimes = $sql->get();
            DB::commit();
            return $startTimes;
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    // 指定IDの時間を取得
    public function getSelectedStartTime($id) {
        try {
            DB::beginTransaction();
            $startTime = StartTime::find($id);
            DB::commit();
            return $startTime;
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }
}
