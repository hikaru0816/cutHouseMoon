<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return redirect(route('index'));
});

// ホーム画面
Route::get('/cutHouseMoon/index', 'IndexController@index')->name('index');

// 会員登録
Route::get('/cutHouseMoon/registFirst', 'Auth\RegisterController@registFirst')->name('registFirst');
Route::post('/cutHouseMoon/registFirst', 'Auth\RegisterController@checkEmail')->name('checkEmailInRegister');
Route::get('/cutHouseMoon/registSecond', 'Auth\RegisterController@registSecond')->name('registSecond');
Route::get('/cutHouseMoon/registCheck', 'Auth\RegisterController@registCheck')->name('registCheck');
Route::post('/cutHouseMoon/registCheck', 'Auth\RegisterController@registCheck');
Route::get('/cutHouseMoon/registThird', 'Auth\RegisterController@registThird')->name('registThird');

Route::get('/cutHouseMoon/regist', 'Auth\RegisterController@regist')->name('regist'); // ダイレクトアクセス禁止用
Route::post('/cutHouseMoon/regist', 'Auth\RegisterController@regist');

// パスワード変更
Route::get('/cutHouseMoon/resetPasswordFirst', 'Auth\ResetPasswordController@resetPasswordFirst')->name('resetPasswordFirst');
Route::post('/cutHouseMoon/resetPasswordFirst', 'Auth\ResetPasswordController@checkEmail')->name('checkEmailInResetPassword');
Route::get('/cutHouseMoon/resetPasswordSecond', 'Auth\ResetPasswordController@resetPasswordSecond')->name('resetPasswordSecond');
Route::get('/cutHouseMoon/resetPassword', 'Auth\ResetPasswordController@resetPass')->name('resetPassword'); // ダイレクトアクセス禁止用
Route::post('/cutHouseMoon/resetPassword', 'Auth\ResetPasswordController@resetPass');

// 管理者ページ
Route::get('/cutHouseMoon/manager', 'ManagerController@manager')->name('manager');
// 空き状況更新
Route::get('/cutHouseMoon/manager/updateEmpty', 'ManagerController@updateEmpty')->name('updateEmpty'); // ダイレクトアクセス禁止用
Route::post('/cutHouseMoon/manager/updateEmpty', 'ManagerController@updateEmpty');
// 予約関連
Route::get('/cutHouseMoon/manager/finishReservation', 'ManagerController@finishReservation')->name('finishReservation');

// 予約編集
Route::get('/cutHouseMoon/manager/editReservationFirst', 'ManagerController@editReservationFirst')->name('editReservationFirst');
Route::get('/cutHouseMoon/manager/validateMenuOnEditReservation', 'ManagerController@validateMenuOnEditReservation')->name('validateMenuOnEditReservation');
Route::get('/cutHouseMoon/manager/editReservationSecond', 'ManagerController@editReservationSecond')->name('editReservationSecond');
Route::get('/cutHouseMoon/manager/editReservationThird', 'ManagerController@editReservationThird')->name('editReservationThird');
Route::get('/cutHouseMoon/manager/validateStartTimeOnEditReservation', 'ManagerController@validateStartTimeOnEditReservation')->name('validateStartTimeOnEditReservation');
Route::get('/cutHouseMoon/manager/editReservationForth', 'ManagerController@editReservationForth')->name('editReservationForth');
Route::get('/cutHouseMoon/manager/editReservation', 'ManagerController@editReservation')->name('editReservation');
Route::get('/cutHouseMoon/manager/allReservation', 'ManagerController@showAllReservation')->name('allReservation');
Route::get('/cutHouseMoon/manager/addReservation/showUserDetailForReservation', 'ManagerController@showUserDetailForReservation')->name('showUserDetailForReservation');


// 予約追加（管理者）
Route::get('/cutHouseMoon/manager/addReservationFirst', 'ManagerController@addReservationFirst')->name('addReservationFirst');
Route::get('/cutHouseMoon/manager/addReservationSecond', 'ManagerController@addReservationSecond')->name('addReservationSecond');
Route::get('/cutHouseMoon/manager/validateMenuOnManager', 'ManagerController@validateMenuOnManager')->name('validateMenuOnManager');
Route::get('/cutHouseMoon/manager/addReservationThird', 'ManagerController@addReservationThird')->name('addReservationThird');
Route::get('/cutHouseMoon/manager/addReservationForth', 'ManagerController@addReservationForth')->name('addReservationForth');
Route::get('/cutHouseMoon/manager/validateStartTimeOnManager', 'ManagerController@validateStartTimeOnManager')->name('validateStartTimeOnManager');
Route::get('/cutHouseMoon/manager/addReservationFifth', 'ManagerController@addReservationFifth')->name('addReservationFifth');
Route::get('/cutHouseMoon/manager/reserve', 'ManagerController@reserve')->name('reserve');

// カットメニュー関連
Route::get('/cutHouseMoon/manager/showCutMenu', 'ManagerController@showCutMenu')->name('showCutMenu');
Route::get('/cutHouseMoon/manager/editCutMenu', 'ManagerController@editCutMenuFirst')->name('editCutMenuFirst');
Route::get('/cutHouseMoon/manager/editCutMenuComplete', 'ManagerController@editMenuComplete')->name('editCutMenuComplete'); // ダイレクトアクセス禁止用
Route::post('/cutHouseMoon/manager/editCutMenuComplete', 'ManagerController@editMenuComplete');
Route::get('/cutHouseMoon/manager/addCutMenuFirst', 'ManagerController@addCutMenuFirst')->name('addCutMenuFirst');
Route::get('/cutHouseMoon/manager/addCutMenuComplete', 'ManagerController@addCutMenuComplete')->name('addCutMenuComplete'); // ダイレクトアクセス禁止用
Route::post('/cutHouseMoon/manager/addCutMenuComplete', 'ManagerController@addCutMenuComplete');
Route::get('/cutHouseMoon/manager/deleteCutMenu', 'ManagerController@deleteCutMenu')->name('deleteCutMenu');
// 会員関連
Route::get('/cutHouseMoon/manager/showUsers', 'ManagerController@showUsers')->name('showUsers');
Route::get('/cutHouseMoon/manager/deleteUser', 'ManagerController@deleteUser')->name('deleteUser');
Route::get('/cutHouseMoon/manager/showUserDetail', 'ManagerController@showUserDetail')->name('showUserDetail');


// お客様マイページ
Route::get('/cutHouseMoon/mypage', 'MypageController@mypage')->name('mypage');
// 予約作成
Route::get('/cutHouseMoon/mypage/bookingFirst', 'MypageController@bookingFirst')->name('bookingFirst');
Route::get('/cutHouseMoon/mypage/validateMenu', 'MypageController@validateMenu')->name('validateMenu');
Route::get('/cutHouseMoon/mypage/bookingSecond', 'MypageController@bookingSecond')->name('bookingSecond');
Route::get('/cutHouseMoon/mypage/bookingThird', 'MypageController@bookingThird')->name('bookingThird');
Route::get('/cutHouseMoon/mypage/validateStartTime', 'MypageController@validateStartTime')->name('validateStartTime');
Route::get('/cutHouseMoon/mypage/bookingForth', 'MypageController@bookingForth')->name('bookingForth');
Route::get('/cutHouseMoon/mypage/booking', 'MypageController@booking')->name('booking');


// カット履歴確認
Route::get('/cutHouseMooon/mypage/history', 'MypageController@history')->name('mypage.history');
// 登録内容編集
Route::get('/cutHouseMoon/mypage/editMyInfoFirst', 'MypageController@editMyInfoFirst')->name('mypage.editMyInfoFirst');
Route::get('/cutHouseMoon/mypage/editMyInfoCheck', 'MypageController@editMyInfoCheck')->name('mypage.editMyInfoCheck');
Route::post('/cutHouseMoon/mypage/editMyInfoCheck', 'MypageController@editMyInfoCheck');
Route::get('/cutHouseMoon/mypage/editMyInfoSecond', 'MypageController@editMyInfoSecond')->name('mypage.editMyInfoSecond');
Route::get('/cutHouseMoon/mypage/editMyInfoComplete', 'MypageController@editMyInfoComplete')->name('mypage.editMyInfoComplete');

// ログイン認証関連
Auth::routes();

// エラー表示ページ
Route::get('/cutHouseMoon/error', 'ErrorController@displayError')->name('error');

// テスト用
Route::get('/cutHouseMoon/test', 'TestController@test')->name('test');
Route::post('/cutHouseMoon/test', 'TestController@test');
