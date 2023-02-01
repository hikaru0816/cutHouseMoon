<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;

class ReservationController extends Controller {
    // 他のコントローラーのメソッドを使う準備
    public function __construct() {
        $this->errorController = app()->make('App\Http\Controllers\ErrorController');
    }

    // 登録されている予約を全部取得
    public function getReservations() {
        try {
            DB::beginTransaction();
            $reservations = Reservation::all();
            $sql = Reservation::query();
            $sql->where('head', 0);
            $reservations = $sql->get();
            DB::commit();
            return $reservations;
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    // まだ終わっていない予約を取得
    public function getYetReservations() {
        try {
            DB::beginTransaction();
            $reservations = Reservation::where('head', 0)->where('status', '0')->orderBy('date', 'ASC')->orderBy('start_time_id', 'ASC')->paginate(10);
            DB::commit();
            return $reservations;
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    // 予約を追加
    public function addReservation() {
        try {
            DB::beginTransaction();
            $reservation = new Reservation();
            $reservation->user_id = Auth::user()->user_id;
            $reservation->menu_id = session('menu');
            $reservation->date = session('date');
            $reservation->start_time_id = session('startTime');
            $reservation->save();
            DB::commit();
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    public function addHeadReservation($registNo) {
        try {
            DB::beginTransaction();
            $reservation = new Reservation();
            $reservation->no = $registNo;
            $reservation->user_id = Auth::user()->user_id;
            $reservation->menu_id = session('menu');
            $reservation->remaining_time = session('doingTime') + 1;
            $reservation->head = 0;
            $reservation->date = session('date');
            $reservation->start_time_id = session('startTime');
            $reservation->save();
            DB::commit();
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    public function addNotHeadReservation($registNo, $i) {
        try {
            DB::beginTransaction();
            $reservation = new Reservation();
            $reservation->no = $registNo;
            $reservation->user_id = Auth::user()->user_id;
            $reservation->menu_id = session('menu');
            $reservation->remaining_time = session('doingTime') + 1 - $i;
            $reservation->head = 1;
            $reservation->date = session('date');
            $reservation->start_time_id = session('startTime') + $i;
            $reservation->save();
            DB::commit();
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }
    public function addHeadReservationOnManager($registNo) {
        try {
            DB::beginTransaction();
            $reservation = new Reservation();
            $reservation->no = $registNo;
            $reservation->user_id = session('user_id');
            $reservation->menu_id = session('menu');
            $reservation->remaining_time = session('doingTime') + 1;
            $reservation->head = 0;
            $reservation->date = session('date');
            $reservation->start_time_id = session('startTime');
            $reservation->save();
            DB::commit();
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    public function addNotHeadReservationOnManager($registNo, $i) {
        try {
            DB::beginTransaction();
            $reservation = new Reservation();
            $reservation->no = $registNo;
            $reservation->user_id = session('user_id');
            $reservation->menu_id = session('menu');
            $reservation->remaining_time = session('doingTime') + 1 - $i;
            $reservation->head = 1;
            $reservation->date = session('date');
            $reservation->start_time_id = session('startTime') + $i;
            $reservation->save();
            DB::commit();
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    // 施術完了した予約の状態を変更
    public function finishStatus($no) {
        try {
            DB::beginTransaction();
            $sql = Reservation::query();
            $sql->where('no', $no);
            $reservations = $sql->get();
            foreach ($reservations as $reservation) {
                $reservation->status = 1;
                $reservation->save();
            }
            DB::commit();
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    // ログインユーザーのカット履歴を取得
    public function getCustomerHistory() {
        try {
            DB::beginTransaction();
            $reservations = Reservation::where('user_id', Auth::user()->user_id)->where('head', 0)->where('status', 1)->orderBy('date', 'DESC')->orderBy('start_time_id', 'DESC')->paginate(5);
            DB::commit();
            return $reservations;
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    // ログインしているお客様の予約を取得
    public function getCustomerReservations() {
        try {
            DB::beginTransaction();
            $sql = Reservation::query();
            $sql->where('user_id', Auth::user()->user_id);
            $sql->where('head', 0);
            $sql->where('status', 0);
            $sql->orderBy('date', 'ASC');
            $reservations = $sql->get();
            DB::commit();
            // 取得データを日時が早い順に並び替え
            return $this->sortDateTime($reservations);
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    // 選択したお客様の予約を取得
    public function getSelectedCustomerReservations($id) {
        try {
            DB::beginTransaction();
            $sql = Reservation::query();
            $sql->where('user_id', $id);
            $sql->where('head', 0);
            $sql->where('status', 0);
            $sql->orderBy('date', 'ASC');
            $reservations = $sql->get();
            DB::commit();
            // 取得データを日時が早い順に並び替え
            return $this->sortDateTime($reservations);
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    // 引数の日付の予約を取得
    public function getSelectedDateReservations($date) {
        try {
            DB::beginTransaction();
            $sql = Reservation::query();
            $sql->where('date', $date);
            $sql->where('head', 0);
            $sql->where('status', 0);
            $sql->with(['startTime']);
            $reservations = $sql->get();
            DB::commit();
            // 取得データを時間が早い順に並び替え
            return $this->sortTime($reservations);
            return $reservations;
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    // 指定されたnoの予約を取得
    public function getSelectedReservation($no) {
        try {
            DB::beginTransaction();
            $sql = Reservation::query();
            $sql->where('no', $no);
            $reservations = $sql->get();
            DB::commit();
            return $reservations;
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    // 予約変更
    public function update($request) {
        try {
            DB::beginTransaction();
            $reservation = Reservation::find($request->id);
            $reservation->menu_id = $request->menu;
            $reservation->date = $request->date;
            $reservation->start_time_id = $request->start_time;
            $reservation->save();
            DB::commit();
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    // noカラムの最大値を取得
    public function getMaximumNo() {
        try {
            DB::beginTransaction();
            $sql = Reservation::query();
            $sql->orderBy('no', 'DESC');
            $reservation = $sql->first();
            DB::commit();
            return $reservation;
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    public function deleteReservation($no) {
        try {
            DB::beginTransaction();
            $sql = Reservation::query();
            $sql->where('no', $no);
            $sql->delete();
            DB::commit();
        } catch (Exception $e) {
            $errorMessage = "DBからデータの取得ができませんでした: {$e->getMessage()}";
            DB::rollBack();
            // エラーを表示
            return view('cutHouseMoon.error', compact('errorMessage'));
        }
    }

    // コントローラー内の関数
    // 取得データを時間が早い順に並び替え
    function sortTime($reservations) {
        $times = [];
        foreach ($reservations as $reservation) {
            $times[] = $reservation['startTime']['time'];
        }
        sort($times);
        $sortReservations = [];
        foreach ($times as $time) {
            foreach ($reservations as $reservation) {
                if ($time === $reservation['startTime']['time']) {
                    $sortReservations[] = $reservation;
                }
            }
        }
        return $sortReservations;
    }

    // 取得データを日時が早い順に並び替え
    function sortDateTime($reservations) {
        $dates = [];
        foreach ($reservations as $reservation) {
            $dates[] = $reservation['date'];
        }
        $dates = array_unique($dates);
        $sortReservations = [];
        foreach ($dates as $date) {
            $sameDateReservations = [];
            foreach ($reservations as $reservation) {
                if ($date === $reservation['date']) {
                    $sameDateReservations[] = $reservation;
                }
            }
            $times = [];
            foreach ($sameDateReservations as $reservation) {
                $times[] = $reservation['startTime']['time'];
            }
            sort($times);
            foreach ($times as $time) {
                foreach ($sameDateReservations as $reservation) {
                    if ($time === $reservation['startTime']['time']) {
                        $sortReservations[] = $reservation;
                    }
                }
            }
        }
        return $sortReservations;
    }
}
