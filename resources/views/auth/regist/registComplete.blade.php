<?php
    $pageTitle = '会員登録完了 - カットハウスムーン';

?>

@include('layouts.header')

<div class="wrapper">
    <section id="regist-complete">
        <h2>会員登録完了</h2>
        <div class="content-container">
            <div>
                <p>
                    ありがとうございます！<br>
                    会員登録が完了しました。<br>
                    ログインをお願いいたします。
                </p>
            </div>
            <a href="{{ route('login') }}" class="btn btn-primary">ログイン</a>
        </div>
    </section>
</div>

@include('layouts.footer')
