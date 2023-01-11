<?php

namespace App\Http\Controllers;

require(__DIR__ . '/../../../public/functions.php');

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class managerController extends Controller {
    public function __construct() {
        // 未ログイン時にログイン画面へ
        $this->middleware('auth');
        // コントローラー内で認証情報を使用
        $this->middleware(function ($request, $next) {
            // ログイン情報
            $this->user = \Auth::user();
            $role = $this->user->role;
            // お客様アカウントの場合、リダイレクト
            if ($role === 0) {
                return redirect(route('mypage'));
            }
            return $next($request);
        });
        // 他のコントローラーのメソッドを使う準備
        $this->menuController = app()->make('App\Http\Controllers\MenuController');
        $this->startTimeController = app()->make('App\Http\Controllers\StartTimeController');
        $this->emptyStatusController = app()->make('App\Http\Controllers\EmptyStatusController');
        $this->waitingStatusController = app()->make('App\Http\Controllers\WaitingStatusController');
        $this->reservationController = app()->make('App\Http\Controllers\ReservationController');
        $this->userController = app()->make('App\Http\Controllers\UserController');
    }

    // managerページの表示
    public function manager(Request $request) {
        $request->session()->forget(['kana', 'name', 'date', 'time', 'menu', 'id', 'menu_id']);
        // 空席状況の取得
        $emptyStatuses = $this->emptyStatusController->getEmptyStatuses();
        // 待ち状況の取得
        $waitingStatuses = $this->waitingStatusController->getWaitingStatuses();
        // 本日の予約を取得
        $today = $this->reservationController->getSelectedDateReservations(date('Y-m-d'));
        session()->forget('id');
        return view('cutHouseMoon.manager.manager', compact('emptyStatuses', 'waitingStatuses', 'today'));
    }

    // 空き状況更新
    public function updateEmpty(Request $request) {
        // ダイレクトアクセス対策
        $referer = substr($request->header('referer'), -7);
        $checkReferer = ($referer !== 'manager');
        $checkRequest = (empty($request->empty));
        if ($checkReferer || $checkRequest) {
            return redirect(route('mypage'));
        }
        // 空席状況の選択を解除
        $this->emptyStatusController->resetEmptyStatus();
        // 空席状況を更新
        $this->emptyStatusController->updateEmptyStatus($request->empty);
        // 待ち状況の選択を解除
        $this->waitingStatusController->resetWaitingStatus();
        // 待ち状況を更新
        $this->waitingStatusController->updateWaitingStatus($request->waiting);
        // 完了したらindexへ
        return redirect(route('index'));
    }

    // 予約の施術完了
    public function finishReservation(Request $request) {
        $this->reservationController->finishStatus($request->id);
        return redirect(route('allReservation'));
    }

    // 予約の編集画面1へ
    public function editReservationFirst(Request $request) {
        // ダイレクトアクセス対策
        if (empty($request->id)) {
            return redirect(route('allReservation'));
        }
        // 選択された予約を取得
        if (empty(session('id'))) {
            $reservation = $this->reservationController->getSelectedReservation($request->id);
            // sessionに保存
            $request->session()->put('kana', $reservation['user']['kana']);
            $request->session()->put('name', $reservation['user']['name']);
            $request->session()->put('date', $reservation['date']);
            $request->session()->put('time', $reservation['startTime']['time']);
            $request->session()->put('menu', $reservation['menu']['name']);
            $request->session()->put('id', $reservation['id']);
            $request->session()->put('menu_id', $reservation['menu_id']);
        }
        return view('cutHouseMoon.manager.reservation.editReservationFirst');
    }

    // 予約の編集画面2へ
    public function editReservationSecond(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'editReservation') == false) {
            return redirect(route('allReservation'));
        }
        // 同じ日付の予約を取得
        $already = $this->reservationController->getSelectedDateReservations($request->date);
        // 既に予約されている予約時間IDを取得
        $unableTime = [];
        foreach ($already as $array) {
            $unableTime[] = $array['start_time_id'];
        }
        $startTimes = $this->startTimeController->getStartTimes();
        $menus = $this->menuController->getMenus();
        return view('cutHouseMoon..manager.reservation.editReservationSecond', compact('menus', 'startTimes' , 'unableTime'));
    }

    // 予約更新
    public function updateReservation(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if ((strpos($referer, 'editReservationSecond') == false)) {
            return redirect(route('allReservation'));
        }
        // バリデーション
        $request->validate([
            'start_time' => 'required',
            'menu' => 'required',
        ], [
            'start_time.required' => '開始時間を選択してください',
            'menu.required' => 'カットメニューを選択してください',
        ]);
        // セッション保存
        $request->session()->put('selectedDate', $request->date);
        // 変更後の時間とメニューの取得
        $startTime = $this->startTimeController->getSelectedStartTime($request->start_time);
        $request->session()->put('selectedStartTime', $startTime['time']);
        $menu = $this->menuController->getSelectedMenu($request->menu);
        $request->session()->put('selectedMenu', $menu['name']);
        // 処理
        $this->reservationController->update($request);
        return redirect(route('finishUpdatingReservation'));
    }

    public function finishUpdatingReservation() {
        return view('cutHouseMoon.manager.reservation.finishUpdatingReservation');
    }

    // 予約一覧表示
    public function showAllReservation(Request $request) {
        $request->session()->forget(['kana', 'name', 'date', 'time', 'menu', 'id', 'menu_id']);
        $reservations = $this->reservationController->getYetReservations();
        session()->forget('id');
        return view('cutHouseMoon.manager.reservation.allReservations', compact('reservations'));
    }

    // カットメニュー表示
    public function showCutMenu() {
        $menus = $this->menuController->getMenus();
        return view('cutHouseMoon.manager.cutMenu.showCutMenu', compact('menus'));
    }

    // カットメニュー編集画面表示
    public function editCutMenuFirst(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'showCutMenu') == false) {
            return redirect(route('showCutMenu'));
        }
        $menu = $this->menuController->getSelectedMenu($request->id);
        return view('cutHouseMoon.manager.cutMenu.editCutMenuFirst', compact('menu'));
    }

    // カットメニュー編集完了・バリデーション
    public function editMenuComplete(Request $request) {
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric',
            'display' => 'required',
        ], [
            'name.required' => 'メニュー名を入力してください'
        ]);
        $this->menuController->editCutMenu($request);
        return redirect(route('showCutMenu'));
    }

    // カットメニュー追加画面
    public function addCutMenuFirst() {
        return view('cutHouseMoon.manager.cutMenu.addCutMenuFirst');
    }

    // カットメニュー追加完了・バリデーション
    public function addCutMenuComplete(Request $request) {
        $request->validate([
            'name' => 'required|string|max:10|unique:menus,name',
            'price' => 'required|numeric',
            'display' => 'numeric',
        ], [
            'name.required' => 'メニュー名を入力してください',
            'name.unique' => 'ご入力いただいたカットメニューは既に登録されています',
            'display.numeric' => '状態を選択してください'
        ]);
        $this->menuController->addCutMenu($request);
        return redirect(route('showCutMenu'));
    }

    // カットメニュー削除
    public function deleteCutMenu(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        $checkReferer = (strpos($referer, 'showCutMenu') == false);
        $checkRequest = (empty($request->id));
        if ($checkReferer || $checkRequest) {
            return redirect(route('manager'));
        }
        $this->menuController->deleteCutMenu($request->id);
        return redirect(route('showCutMenu'));
    }

    // 会員一覧取得
    public function showUsers() {
        $users = $this->userController->getCustomerUsers();
        return view('cutHouseMoon.manager.user.showUsers', compact('users'));
    }

    // 会員削除
    public function deleteUser(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        $checkReferer = (strpos($referer, 'showUser') == false);
        $checkRequest = (empty($request->id));
        if ($checkReferer || $checkRequest) {
            return redirect(route('manager'));
        }
        $this->userController->deleteUser($request->id);
        return redirect(route('showUsers'));
    }

    // 会員の詳細情報表示
    public function showUserDetail(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        $checkReferer = (strpos($referer, 'showUsers') == false);
        $checkRequest = (empty($request->id));
        if ($checkReferer || $checkRequest) {
            return redirect(route('manager'));
        }
        // 処理
        $user = $this->userController->getSelectedUser($request->id);
        return view('cutHouseMoon.manager.user.showUserDetail', compact('user'));
    }

    // 予約の追加
    // お客様選択
    public function addReservationFirst(Request $request) {
        session()->forget(['user_id', 'date', 'startTime', 'menu', 'user_kana', 'user_name', 'reservations']);
        $users = $this->userController->getCustomerUsers();
        return view('cutHouseMoon.manager.reservation.addReservationFirst', compact('users'));
    }

    // お客様情報表示、
    public function addReservationSecond(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        $checkReferer = (strpos($referer, 'addReservation') == false);
        if ($checkReferer) {
            return redirect(route('addReservationFirst'));
        }
        // セッション保存
        if (empty(session('user_id'))) {
            $request->session()->put('user_id', $request->id);
        }
        // DBからデータ取得
        $user = $this->userController->getSelectedUser(session('user_id'));
        $reservations = $this->reservationController->getSelectedCustomerReservations(session('user_id'));
        // セッション保存
        $request->session()->put('user_name', $user['name']);
        $request->session()->put('user_kana', $user['kana']);
        $request->session()->put('reservations', $reservations);
        return view('cutHouseMoon.manager.reservation.addReservationSecond');
    }

    public function addReservationThird(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        $checkReferer = (strpos($referer, 'addReservation') == false);
        if ($checkReferer) {
            return redirect(route('manager'));
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
        // セッション保存
        return view('cutHouseMoon.manager.reservation.addReservationThird', compact('startTimes', 'menus', 'unableTime'));
    }

    // 予約内容バリデーション
    public function addReservationValidate(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'addReservationThird') == false) {
            return redirect(route('addReservationFirst'));
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
        return redirect(route('addReservationForth'));
    }

    public function addReservationForth(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'addReservationThird') == false) {
            return redirect(route('addReservationFirst'));
        }
        $startTimes = $this->startTimeController->getStartTimes();
        $menus = $this->menuController->getDisplayedCutMenu();
        return view('cutHouseMoon.manager.reservation.addReservationForth', compact('startTimes', 'menus'));
    }

    public function doReservation(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'addReservationForth') == false) {
            return redirect(route('addReservationFirst'));
        }
        // 処理
        if (!empty(session('date'))) {
            $this->reservationController->managerAddReservation();
            session()->forget(['user_id', 'date', 'startTime', 'menu', 'user_kana', 'user_name', 'reservations']);
            return view('cutHouseMoon.manager.reservation.reservationFinish');
        } else {
            // 二重送信対策
            return redirect(route('addReservationFirst'));
        }
    }

    // 予約するお客様の詳細情報表示
    public function showUserDetailForReservation(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        $checkReferer = (strpos($referer, 'addReservationFirst') == false);
        $checkRequest = (empty($request->id));
        if ($checkReferer || $checkRequest) {
            return redirect(route('manager'));
        }
        // 処理
        $user = $this->userController->getSelectedUser($request->id);
        return view('cutHouseMoon.manager.reservation.showUserDetailForReservation', compact('user'));
    }
}
