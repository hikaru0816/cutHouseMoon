<?php

namespace App\Http\Controllers;

require(__DIR__ . '/../../../public/functions.php');

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\InputDoingTime;

class managerController extends Controller {
    public function __construct() {
        // 未ログイン時にログイン画面へ
        $this->middleware('auth');
        // コントローラー内で認証情報を使用
        $this->middleware(function ($request, $next) {
            // お客様アカウントの場合、リダイレクト
            if (Auth::user()->role === 0) {
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
        $request->session()->forget(['kana', 'name', 'date', 'time', 'menu', 'id', 'menu_id', 'no']);
        // 空席状況の取得
        $emptyStatuses = $this->emptyStatusController->getEmptyStatuses();
        // 待ち状況の取得
        $waitingStatuses = $this->waitingStatusController->getWaitingStatuses();
        // 本日の予約を取得
        $today = $this->reservationController->getTodayReservations(date('Y-m-d'));
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
        $this->reservationController->finishStatus($request->no);
        return redirect(route('allReservation'));
    }

    // 予約の編集画面1へ
    public function editReservationFirst(Request $request) {
        // ダイレクトアクセス対策
        if (empty($request->no)) {
            return redirect(route('allReservation'));
        }
        $referer = $request->header('referer');
        // セッション管理
        if (strpos($referer, 'editReservationSecond') == false) {
            session()->forget(['newMenu']);
        }
        // 選択された予約を取得
        if (empty(session('no'))) {
            $reservations = $this->reservationController->getSelectedReservation($request->no);

            // sessionに保存
            $request->session()->put('kana', $reservations[0]['user']['kana']);
            $request->session()->put('name', $reservations[0]['user']['name']);
            $request->session()->put('user_id', $reservations[0]['user']['user_id']);
            $request->session()->put('nowDate', $reservations[0]['date']);
            $request->session()->put('time', $reservations[0]['startTime']['time']);
            $request->session()->put('menu', $reservations[0]['menu']['name']);
            $request->session()->put('no', $reservations[0]['no']);
            $request->session()->put('menu_id', $reservations[0]['menu_id']);
        }
        $menus = $this->menuController->getDisplayedCutMenu();
        return view('cutHouseMoon.manager.reservation.editReservationFirst', compact('menus'));
    }

    public function validateMenuOnEditReservation(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'editReservationFirst') == false) {
            return redirect(route('allReservation'));
        }
        // 入浴内容の保存
        $request->session()->put('newMenu', $request->newMenu);
        // バリデーション
        $request->validate([
            'newMenu' => 'required',
        ], [
            'newMenu.required' => 'カットメニューを選択してください',
        ]);
        $menu = $this->menuController->getSelectedMenu(session('newMenu'));
        $doingTimeBlock = ($menu['doing_time'] * 10) / 5 - 1;
        $request->session()->put('doingTime', $doingTimeBlock);
        return redirect(route('editReservationSecond'));
    }

    // 予約の編集画面2へ
    public function editReservationSecond(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'editReservation') == false) {
            return redirect(route('allReservation'));
        }
        $menu = $this->menuController->getSelectedMenu(session('newMenu'));
        return view('cutHouseMoon.manager.reservation.editReservationSecond', compact('menu'));
    }

    // 予約の編集画面3へ
    public function editReservationThird(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'editReservation') == false) {
            return redirect(route('allReservation'));
        }
        if ((strpos($referer, 'editReservationSecond') == true) || (strpos($referer, 'editReservationThird') == true)) {
            session()->forget(['startTime']);
            $request->session()->put('date', $request->date);
        }
        // 現在の予約を削除
        $this->reservationController->deleteReservation(session('no'));
        $menu = $this->menuController->getSelectedMenu(session('newMenu'));
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
            return redirect(route('editReservationSecond'));
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
        return view('cutHouseMoon.manager.reservation.editReservationThird', compact('menu', 'ableTimes'));
    }

    public function validateStartTimeOnEditReservation(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'editReservationThird') == false) {
            return redirect(route('allReservation'));
        }
        // 入浴内容の保存
        $request->session()->put('startTime', $request->start_time);
        // バリデーション
        $request->validate([
            'start_time' => 'required',
        ], [
            'start_time.required' => '開始時間を選択してください',
        ]);
        return redirect(route('editReservationForth'));
    }

    public function editReservationForth(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'editReservationThird') == false) {
            return redirect(route('allReservation'));
        }
        $menu = $this->menuController->getSelectedMenu(session('newMenu'));
        $startTime = $this->startTimeController->getSelectedStartTime(session('startTime'));
        return view('cutHouseMoon.manager.reservation.editReservationForth', compact('menu', 'startTime'));
    }

    public function editReservation(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'editReservationForth') == false) {
            return redirect(route('allReservation'));
        }
        session()->forget(['menu']);
        $request->session()->put('menu', session('newMenu'));
        $reservation = $this->reservationController->getMaximumNo();
        if ($reservation) {
            $registNo = $reservation['no'] + 1;
        } else {
            $registNo = 1;
        }
        $reservation = $this->reservationController->addHeadReservationOnManager($registNo);
        for ($i = 1; $i <= session('doingTime'); $i++) {
            $reservation = $this->reservationController->addNotHeadReservationOnManager($registNo, $i);
        }
        session()->forget(['startTime', 'menu', 'doingTime', 'date', 'user_id', 'user_kana', 'user_name', 'reservations']);
        return view('cutHouseMoon.manager.reservation.editReservation');
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
        $request->session()->forget(['kana', 'name', 'date', 'time', 'menu', 'id', 'menu_id', 'no']);
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
        if ((strpos($referer, 'showCutMenu') == true) || (strpos($referer, 'editCutMenu') == true)) {
            $menu = $this->menuController->getSelectedMenu($request->id);
            return view('cutHouseMoon.manager.cutMenu.editCutMenuFirst', compact('menu'));
        } else {
            return redirect(route('showCutMenu'));
        }
    }

    // カットメニュー編集完了・バリデーション
    public function editMenuComplete(Request $request) {
        $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'doing_time' => 'required|numeric|min:0',
            'doing_time' => ['required', 'numeric', 'min:0', new InputDoingTime()],
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
            'price' => 'required|numeric|min:0',
            'doing_time' => ['required', 'numeric', 'min:0', new InputDoingTime()],
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
    public function showUsers(Request $request) {
        $users = $this->userController->getTenCustomer();
        $referer = $request->header('referer');
        $checkReferer = (strpos($referer, 'showUserDetail') == false);
        if ($checkReferer) {
            $request->session()->put('page', request()->query("page"));
            $request->session()->put('search', request()->query("search"));
        }
        // 検索ワードがあった場合
        if (session("search")) {
            $users = $this->userController->getSearchedCustomer(session("search"));
        }
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
        $users = $this->userController->getTenCustomer();
        $referer = $request->header('referer');
        $checkReferer = ((strpos($referer, 'showUserDetail') == false) || (strpos($referer, 'addReservation') == false));
        if ($checkReferer) {
            $request->session()->put('page', request()->query("page"));
            $request->session()->put('search', request()->query("search"));
        }
        // 検索ワードがあった場合
        if (session('search')) {
            $users = $this->userController->getSearchedCustomer(session('search'));
        }
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
        $menus = $this->menuController->getDisplayedCutMenu();
        return view('cutHouseMoon.manager.reservation.addReservationSecond', compact('menus'));
    }

    public function validateMenuOnManager(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'addReservationSecond') == false) {
            return redirect(route('addReservationFirst'));
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
        return redirect(route('addReservationThird'));
    }

    public function addReservationThird(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'addReservation') == false) {
            return redirect(route('addReservationFirst'));
        }
        $menu = $this->menuController->getSelectedMenu(session('menu'));
        return view('cutHouseMoon.manager.reservation.addReservationThird', compact('menu'));
    }

    public function addReservationForth(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'addReservation') == false) {
            return redirect(route('addReservationFirst'));
        }
        if ((strpos($referer, 'addReservationForth') == true) || (strpos($referer, 'addReservationThird') == true)) {
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
            return redirect(route('addReservationThird'));
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
        return view('cutHouseMoon.manager.reservation.addReservationForth', compact('menu', 'ableTimes'));
    }

    public function validateStartTimeOnManager(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'addReservationForth') == false) {
            return redirect(route('addReservationFirst'));
        }
        // 入浴内容の保存
        $request->session()->put('startTime', $request->start_time);
        // バリデーション
        $request->validate([
            'start_time' => 'required',
        ], [
            'start_time.required' => '開始時間を選択してください',
        ]);
        return redirect(route('addReservationFifth'));
    }

    public function addReservationFifth(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'addReservationForth') == false) {
            return redirect(route('addReservationFirst'));
        }
        $menu = $this->menuController->getSelectedMenu(session('menu'));
        $startTime = $this->startTimeController->getSelectedStartTime(session('startTime'));
        return view('cutHouseMoon.manager.reservation.addReservationFifth', compact('menu', 'startTime'));
    }

    public function reserve(Request $request) {
        // ダイレクトアクセス対策
        $referer = $request->header('referer');
        if (strpos($referer, 'addReservationFifth') == false) {
            return redirect(route('addReservationFirst'));
        }
        // 処理
        $reservation = $this->reservationController->getMaximumNo();
        if ($reservation) {
            $registNo = $reservation['no'] + 1;
        } else {
            $registNo = 1;
        }
        $reservation = $this->reservationController->addHeadReservationOnManager($registNo);
        for ($i = 1; $i <= session('doingTime'); $i++) {
            $reservation = $this->reservationController->addNotHeadReservationOnManager($registNo, $i);
        }
        session()->forget(['startTime', 'menu', 'doingTime', 'date', 'user_id', 'user_kana', 'user_name', 'reservations']);
        return view('cutHouseMoon.manager.reservation.reservationFinish');
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
