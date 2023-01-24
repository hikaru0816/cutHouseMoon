<?php
    $pageTitle = 'パスワード変更完了 - カットハウスムーン';

?>

@include('layouts.header')

<div class="wrapper">
    <section id="regist-complete">
        <h2>パスワード変更完了</h2>
        <div class="content-container">
            <div>
                <p>
                    パスワードを変更しました。<br>
                    ログインをお願いいたします。
                </p>
            </div>
            <a href="{{ route('login') }}" class="btn btn-primary">ログイン</a>
        </div>
    </section>
</div>

@include('layouts.footer')
