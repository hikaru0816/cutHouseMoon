<?php
    $pageTitle = 'ご登録情報修正内容確認 - カットハウスムーン';
?>

@include('layouts.header')

<div class="wrapper">
    <section id="register">
        <h2>ご登録情報修正内容確認</h2>
        <div class="content-container">
            <div class="confirm">
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
                        <p>名前</p>
                    </div>
                    <div class="confirm-body confirm-body-verticle">
                        <p>{{ session('name') }}</p>
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
                <div class="confirm-content confirm-content-vertical">
                    <div class="confirm-title-verticle">
                        <p>メールアドレス</p>
                    </div>
                    <div class="confirm-body confirm-body-verticle">
                        <p>{{ session('email') }}</p>
                    </div>
                </div>
            </div>
            <div class="btn-container">
                <a href="{{ route('mypage.editMyInfoFirst') }}" class="btn btn-secondary modify-btn">修正</a>
                <a href="{{ route('mypage.editMyInfoComplete') }}" class="btn btn-primary next-btn">変更</a>
            </div>
            <div class="back-btn-container">
                <a href="{{ route('mypage') }}" class="btn btn-link back-btn">マイページへ</a>
            </div>
        </div>
    </section>
</div>

@include('layouts.footer')
