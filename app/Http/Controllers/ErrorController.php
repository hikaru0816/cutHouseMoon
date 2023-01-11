<?php

namespace App\Http\Controllers;

class ErrorController extends Controller {
    public function displayError($errorMessage = '') {
        // エラーメッセージが無い場合はindexへ
        if (empty($errorMessage)) {
            return redirect(route('index'));
        }
        // エラーメッセージが有ればerrorへ
        return view('cutHouseMoon.error', compact('errorMessage'));
    }
}
