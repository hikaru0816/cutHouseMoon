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
Route::post('/cutHouseMoon/regist', 'Auth\RegisterController@regist')->name('regist');

// パスワード変更
Route::get('/cutHouseMoon/resetPasswordFirst', 'Auth\ResetPasswordController@resetPasswordFirst')->name('resetPasswordFirst');
Route::post('/cutHouseMoon/resetPasswordFirst', 'Auth\ResetPasswordController@checkEmail')->name('checkEmailInResetPassword');
Route::get('/cutHouseMoon/resetPasswordSecond', 'Auth\ResetPasswordController@resetPasswordSecond')->name('resetPasswordSecond');
Route::get('/cutHouseMoon/resetPassword', 'Auth\ResetPasswordController@resetPass')->name('resetPassword'); // ダイレクトアクセス禁止用
Route::post('/cutHouseMoon/resetPassword', 'Auth\ResetPasswordController@resetPass');

// 管理者ページ
ROUTE::get('/cutHouseMoon/manager', 'ManagerController@manager')->name('manager');
// 空き状況更新
Route::get('/cutHouseMoon/manager/updateEmpty', 'ManagerController@updateEmpty')->name('updateEmpty'); // ダイレクトアクセス禁止用
Route::post('/cutHouseMoon/manager/updateEmpty', 'ManagerController@updateEmpty');
// 予約関連
ROUTE::get('/cutHouseMoon/manager/finishReservation', 'ManagerController@finishReservation')->name('finishReservation');
ROUTE::get('/cutHouseMoon/manager/editReservationFirst', 'ManagerController@editReservationFirst')->name('editReservationFirst');
ROUTE::get('/cutHouseMoon/manager/editReservationSecond', 'ManagerController@editReservationSecond')->name('editReservationSecond');
Route::get('/cutHouseMoon/manager/updateReservation', 'ManagerController@updateReservation')->name('updateReservation'); // ダイレクトアクセス禁止用
Route::post('/cutHouseMoon/manager/updateReservation', 'ManagerController@updateReservation');
Route::get('/cutHouseMoon/manager/finishUpdatingReservation', 'ManagerController@finishUpdatingReservation')->name('finishUpdatingReservation');
Route::get('/cutHouseMoon/manager/allReservation', 'ManagerController@showAllReservation')->name('allReservation');
Route::get('/cutHouseMoon/manager/addReservationFirst', 'ManagerController@addReservationFirst')->name('addReservationFirst');
Route::get('/cutHouseMoon/manager/addReservationSecond', 'ManagerController@addReservationSecond')->name('addReservationSecond');
Route::get('/cutHouseMoon/manager/addReservationThird', 'ManagerController@addReservationThird')->name('addReservationThird');
Route::post('/cutHouseMoon/manager/addReservationThird', 'ManagerController@addReservationThird');
Route::get('/cutHouseMoon/manager/addReservationValidate', 'ManagerController@addReservationValidate')->name('addReservationValidate');
Route::post('/cutHouseMoon/manager/addReservationValidate', 'ManagerController@addReservationValidate');
Route::get('/cutHouseMoon/manager/addReservationForth', 'ManagerController@addReservationForth')->name('addReservationForth');
Route::get('/cutHouseMoon/manager/finisfAddingReservation', 'ManagerController@doReservation')->name('finisfAddingReservation');
Route::get('/cutHouseMoon/manager/addReservation/showUserDetailForReservation', 'ManagerController@showUserDetailForReservation')->name('showUserDetailForReservation');
// カットメニュー関連
Route::get('/cutHouseMoon/manager/showCutMenu', 'ManagerController@showCutMenu')->name('showCutMenu');
Route::get('/cutHouseMoon/manager/editCutMenu', 'ManagerController@editCutMenuFirst')->name('editCutMenuFirst');
Route::get('/cutHouseMoon/manager/editCutMenuComplete', 'ManagerController@editMenuComplete')->name('editCutMenuComplet'); // ダイレクトアクセス禁止用
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
ROUTE::get('/cutHouseMoon/mypage', 'MypageController@mypage')->name('mypage');
// 予約作成
ROUTE::get('/cutHouseMoon/mypage/bookingFirst', 'MypageController@bookingFirst')->name('bookingFirst');
ROUTE::get('/cutHouseMoon/mypage/bookingSecond', 'MypageController@bookingSecond')->name('bookingSecond');
ROUTE::post('/cutHouseMoon/mypage/bookingSecond', 'MypageController@bookingSecond');
ROUTE::get('/cutHouseMoon/mypage/bookingCheck', 'MypageController@bookingCheck')->name('bookingCheck');
ROUTE::post('/cutHouseMoon/mypage/bookingCheck', 'MypageController@bookingCheck');
ROUTE::get('/cutHouseMoon/mypage/bookingThird', 'MypageController@bookingThird')->name('bookingThird');
ROUTE::get('/cutHouseMoon/mypage/bookingFinish', 'MypageController@doBooking')->name('booking');
ROUTE::post('/cutHouseMoon/mypage/bookingFinish', 'MypageController@doBooking');

// ログイン認証関連
Auth::routes();

// エラー表示ページ
ROUTE::get('/cutHouseMoon/error', 'ErrorController@displayError')->name('error');
