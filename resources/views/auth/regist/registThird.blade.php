<?php
    $pageTitle = '会員登録内容確認 - カットハウスムーン';
?>


@include('layouts.header')

<div class="wrapper">
    <section id="register">
        <h2>会員登録内容確認</h2>
        <div class="content-container">
            <div class="confirm">
                <div class="confirm-content confirm-content-vertical">
                    <div class="confirm-title-verticle">
                        <p>メールアドレス</p>
                    </div>
                    <div class="confirm-body confirm-body-verticle">
                        <p>{{ session('email') }}</p>
                    </div>
                </div>
                <div class="confirm-content confirm-content-vertical">
                    <div class="confirm-title-verticle">
                        <p>名前</p>
                    </div>
                    <div class="confirm-body confirm-body-verticle">
                        <p>{{ session('name') }}</p>
                    </div>
                </div>
                <div class="confirm-content confirm-content-vertical">
                    <div class="confirm-title-verticle">
                        <p>フリガナ</p>
                    </div>
                    <div class="confirm-body confirm-body-verticle">
                        <p>{{ session('kana') }}</p>
                    </div>
                </div>
                <div class="confirm-content confirm-content-vertical">
                    <div class="confirm-title-verticle">
                        <p>電話番号</p>
                    </div>
                    <div class="confirm-body confirm-body-verticle">
                        <p>{{ session('tel') }}</p>
                    </div>
                </div>
            </div>
            <p class="rice-mark">※パスワードは個人情報保護のため表示しておりません。</p>
            <div class="btn-container">
                <a href="{{ route('registSecond') }}" class="btn btn-secondary modify-btn">修正</a>
                <a href="{{ route('regist') }}" class="btn btn-primary next-btn">登録</a>
            </div>
        </div>
    </section>
</div>

@include('layouts.footer')
