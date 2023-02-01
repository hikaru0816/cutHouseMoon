<?php

namespace App\Http\Controllers;

use App\Rules\EmailUniqueCheck;
use Illuminate\Support\Facades\Auth;

require(__DIR__ . '/../../../public/functions.php');

use Illuminate\Http\Request;

class MypageController extends Controller {
    public function __construct() {
        // 未ログイン時にログイン画面へ
        $this->middleware('auth');
        // コントローラー内で認証情報を使用
        $this->middleware(function ($request, $next) {
            // 管理者の場合、リダイレクト
            if (Auth::user()->role === 1) {
                return redirect(route('manager'));
            }
            return $next($request);
        });
        // 他のコントローラーのメソッドを使う準備
        $this->menuController = app()->make('App\Http\Controllers\MenuController');
        $this->startTimeController = app()->make('App\Http\Controllers\StartTimeController');
        $this->reservationController = app()->make('App\Http\Controllers\ReservationController');
        $this->userController = app()->make('App\Http\Controllers\UserController');
    }

    public function mypage() {
        $reservations = $this->reservationController->getCustomerReservations();
        $countOfReservations = count($reservations);
        $histories = $this->reservationController->getCustomerHistory();
        return view('cutHouseMoon.mypage.mypage', compact('reservations', 'countOfReservations', 'histories'));
    }

    public function editMyInfoFirst(Request $request) {
        // editMyInfoSecondから戻ってきたときはセッション保存しない
        $referer = $request->header('referer');
        if (strpos($referer, 'editMyInfo') == false) {
            $request->session()->put('name', Auth::user()->name);
            $request->session()->put('kana', Auth::user()->kana);
            $request->session()->put('tel', Auth::user()->tel);
            $request->session()->put('email', Auth::user()->email);
        }
        return view('cutHouseMoon.mypage.info.editMyInfoFirst');
    }

    public function editMyInfoCheck(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'editMyInfoFirst') == false) {
            return redirect(route('mypage'));
        }
        // セッションのリセット
        session()->forget(['name', 'kana', 'tel', 'email']);
        // バリデーション
        $request->validate([
            'name' => 'required|string|max:255',
            'kana' => 'required|string|max:255',
            'tel' => 'required|string|max:11',
            'email' => ['required', 'email:filter', new EmailUniqueCheck],
        ], [
            'tel.max' => '電話番号は11桁以下で入力していください'
        ]);
        // 入力内容の保存
        $request->session()->put('name', $request->name);
        $request->session()->put('kana', $request->kana);
        $request->session()->put('tel', $request->tel);
        $request->session()->put('email', $request->email);
        return redirect(route('mypage.editMyInfoSecond'));
    }

    public function editMyInfoSecond(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'editMyInfoFirst') == false) {
            return redirect(route('mypage'));
        }
        return view('cutHouseMoon.mypage.info.editMyInfoSecond');
    }

    public function editMyInfoComplete(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'editMyInfoSecond') == false) {
            return redirect(route('mypage'));
        }
        $this->userController->editMyInfo();
        session()->forget(['name', 'kana', 'tel', 'email']);
        return view('cutHouseMoon.mypage.info.editMyInfoComplete');
    }


    public function history() {
        $histories = $this->reservationController->getCustomerHistory();
        return view('cutHouseMoon.mypage.history.history', compact('histories'));
    }

    // 新機能用
    public function bookingFirst(Request $request) {
        // セッション管理
        $referer = $request->header('referer');
        if (strpos($referer, 'bookingSecond') == false) {
            session()->forget(['menu']);
        }

        $menus = $this->menuController->getDisplayedCutMenu();
        return view('cutHouseMoon.mypage.reservate.bookingFirst', compact('menus'));
    }

    public function validateMenu(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'bookingFirst') == false) {
            return redirect(route('mypage'));
        }
        // 入浴内容の保存
        $request->session()->put('menu', $request->menu);
        // バリデーション
        $request->validate([
            'menu' => 'required',
        ], [
            'menu.required' => 'カットメニューを選択してください',
        ]);
        $menu = $this->menuController->getSelectedMenu(session('menu'));
        $doingTimeBlock = ($menu['doing_time'] * 10) / 5 - 1;
        $request->session()->put('doingTime', $doingTimeBlock);
        return redirect(route('bookingSecond'));
    }

    public function bookingSecond(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'booking') == false) {
            return redirect(route('mypage'));
        }
        $menu = $this->menuController->getSelectedMenu(session('menu'));
        return view('cutHouseMoon.mypage.reservate.bookingSecond', compact('menu'));
    }

    public function bookingThird(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'booking') == false) {
            return redirect(route('mypage'));
        }
        if ((strpos($referer, 'bookingSecond') == true) || (strpos($referer, 'bookingThird') == true)) {
            session()->forget(['startTime']);
            $request->session()->put('date', $request->date);
        }
        $menu = $this->menuController->getSelectedMenu(session('menu'));
        // 〇日取得
        $day = substr(session('date'), -2);
        // 〇曜日を取得
        $dayOfWeek = getDayOfWeek(session('date'));
        // 月曜日チェック
        $checkMonday = ($dayOfWeek == '月');
        // 第一日曜日チェック
        $checkSunday = (($dayOfWeek == '日') && ($day <= 7));
        // 休みの日を選択していたら、リダイレクト
        if ($checkMonday || $checkSunday) {
            return redirect(route('bookingSecond'));
        }
        // 同じ日付の予約を取得
        $already = $this->reservationController->getSelectedDateReservations(session('date'));
        // 既に予約されている予約時間IDを取得
        $unableTime = [];
        foreach ($already as $array) {
            $unableTime[] = $array['start_time_id'];
        }
        $startTimes = $this->startTimeController->getStartTimes();
        $emptyTimes = [];
        foreach ($startTimes as $startTime) {
            if (!in_array($startTime['id'], $unableTime)) {
                $emptyTimes[] = $startTime;
            }
        }
        $differences = [];
        // 次の空き時間idとの差を計算し、代入
        for ($i = 0; $i <= count($emptyTimes) - 1; $i++) {
            if ($i === count($emptyTimes) - 1) {
                $differences[$i] = 0;
            } else {
                $differences[$i] = $emptyTimes[$i + 1]['id'] - $emptyTimes[$i]['id'];
            }
        }
        // 空いている時間ブロック数のカウント
        for ($i = 0;  $i <= count($emptyTimes) - 1; $i++) {
            $emptyBlock = 0;
            for ($j = $i; $j <= count($differences) - 1; $j++) {
                if ($differences[$j] === 1) {
                    $emptyBlock++;
                } else {
                    $emptyTimes[$i]['emptyBlock'] = $emptyBlock;
                    break;
                }
            }
        }
        // メニューに応じた予約可能時間を取得
        $ableTimes = [];
        foreach ($emptyTimes as $emptyTime) {
            if ($emptyTime['emptyBlock'] >= session('doingTime')) {
                $ableTimes[] = $emptyTime;
            }
        }
        return view('cutHouseMoon.mypage.reservate.bookingThird', compact('menu', 'ableTimes'));
    }

    public function validateStartTime(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'bookingThird') == false) {
            return redirect(route('mypage'));
        }
        // 入浴内容の保存
        $request->session()->put('startTime', $request->start_time);
        // バリデーション
        $request->validate([
            'start_time' => 'required',
        ], [
            'start_time.required' => '開始時間を選択してください',
        ]);
        return redirect(route('bookingForth'));
    }

    public function bookingForth(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'booking') == false) {
            return redirect(route('mypage'));
        }
        $menu = $this->menuController->getSelectedMenu(session('menu'));
        $startTime = $this->startTimeController->getSelectedStartTime(session('startTime'));
        return view('cutHouseMoon.mypage.reservate.bookingForth', compact('menu', 'startTime'));
    }

    public function booking(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'bookingForth') == false) {
            return redirect(route('mypage'));
        }
        $reservation = $this->reservationController->getMaximumNo();
        if ($reservation) {
            $registNo = $reservation['no'] + 1;
        } else {
            $registNo = 1;
        }
        $reservation = $this->reservationController->addHeadReservation($registNo);
        for ($i = 1; $i <= session('doingTime'); $i++) {
            $reservation = $this->reservationController->addNotHeadReservation($registNo, $i);
        }
        session()->forget(['startTime', 'menu', 'doingTime', 'date']);
        return view('cutHouseMoon.mypage.reservate.booking');
    }
}
