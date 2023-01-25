<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

require(__DIR__ . '/../../../public/functions.php');

use Illuminate\Http\Request;

class MypageController extends Controller {
    public function __construct() {
        // 未ログイン時にログイン画面へ
        $this->middleware('auth');
        // コントローラー内で認証情報を使用
        $this->middleware(function ($request, $next) {
            // ログイン情報
            $this->user = \Auth::user();
            $role = $this->user->role;
            // 管理者の場合、リダイレクト
            if ($role === 1) {
                return redirect(route('manager'));
            }
            return $next($request);
        });
        // 他のコントローラーのメソッドを使う準備
        $this->menuController = app()->make('App\Http\Controllers\MenuController');
        $this->startTimeController = app()->make('App\Http\Controllers\StartTimeController');
        $this->reservationController = app()->make('App\Http\Controllers\ReservationController');
    }

    public function mypage() {
        $reservations = $this->reservationController->getCustomerReservations();
        $countOfReservations = count($reservations);
        $histories = $this->reservationController->getCustomerHistory();
        return view('cutHouseMoon.mypage.mypage', compact('reservations', 'countOfReservations', 'histories'));
    }

    public function bookingFirst(Request $request) {
        return view('cutHouseMoon.mypage.reservate.bookingFirst');
    }

    public function bookingSecond(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'booking') == false) {
            return redirect(route('bookingFirst'));
        }
        // セッション削除
        if (!strpos($referer, 'bookingFirst') == false) {
            session()->forget(['date', 'startTime', 'menu']);
        }
        // 〇日取得
        $day = substr($request->date, -2);
        // 〇曜日を取得
        $dayOfWeek = getDayOfWeek($request->date);
        // 月曜日チェック
        $checkMonday = ($dayOfWeek == '月');
        // 第一日曜日チェック
        $checkSunday = (($dayOfWeek == '日') && ($day <= 7));
        // 休みの日を選択していたら、bookingFristへ
        if ($checkMonday || $checkSunday) {
            return redirect(route('bookingFirst'));
        }
        // 同じ日付の予約を取得
        if (!empty($request->date)) {
            $already = $this->reservationController->getSelectedDateReservations($request->date);
        } else {
            $already = $this->reservationController->getSelectedDateReservations(session('date'));
        }
        // 既に予約されている予約時間IDを取得
        $unableTime = [];
        foreach ($already as $array) {
            $unableTime[] = $array['start_time_id'];
        }
        $startTimes = $this->startTimeController->getStartTimes();
        $menus = $this->menuController->getDisplayedCutMenu();
        return view('cutHouseMoon.mypage.reservate.bookingSecond', compact('menus', 'startTimes' , 'unableTime'));
    }

    // バリデーション
    public function bookingCheck(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'booking') == false) {
            return redirect(route('bookingFirst'));
        }
        // 入浴内容の保存
        $request->session()->put('date', $request->date);
        $request->session()->put('startTime', $request->start_time);
        $request->session()->put('menu', $request->menu);
        // バリデーション
        $request->validate([
            'start_time' => 'required',
            'menu' => 'required',
        ], [
            'start_time.required' => '開始時間を選択してください',
            'menu.required' => 'カットメニューを選択してください',
        ]);
        return redirect(route('bookingThird'));
    }

    public function bookingThird(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'booking') == false) {
            return redirect(route('bookingFirst'));
        }
        $startTimes = $this->startTimeController->getStartTimes();
        $menus = $this->menuController->getDisplayedCutMenu();
        return view('cutHouseMoon.mypage.reservate.bookingThird', compact('startTimes', 'menus'));
    }

    public function doBooking(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'bookingThird') == false) {
            return redirect(route('mypage'));
        }
        // 処理
        if (!empty(session('date'))) {
            $this->reservationController->addReservation();
            session()->forget(['date', 'startTime', 'menu']);
            return view('cutHouseMoon.mypage.reservate.bookingFinish');
        } else {
            // 二重送信対策
            return redirect(route('mypage'));
        }
    }

    public function history() {
        $histories = $this->reservationController->getCustomerHistory();
        return view('cutHouseMoon.mypage.history.history', compact('histories'));
    }
}
