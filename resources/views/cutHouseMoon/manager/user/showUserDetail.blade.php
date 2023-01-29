<?php
    require_once(__DIR__ . '/../../../public/functions.php');
    $pageTitle = '会員詳細 - カットハウスムーン';
?>

@include('layouts.header')

<section id="show-user-detail">
    <div class="wrapper">
        <h2>お客様詳細</h2>
        <div class="content-container">
            <div class="confirm">
                <div class="confirm-content">
                    <div class="confirm-title">
                        <p>ヨミ</p>
                    </div>
                    <div class="confirm-body">
                        <p>{{ $user['kana'] }}</p>
                    </div>
                </div>
                <div class="confirm-content">
                    <div class="confirm-title">
                        <p>名前</p>
                    </div>
                    <div class="confirm-body">
                        <p>{{ $user['name'] }}</p>
                    </div>
                </div>
                <div class="confirm-content">
                    <div class="confirm-title">
                        <p>電話番号</p>
                    </div>
                    <div class="confirm-body">
                        <p>{{ $user['tel'] }}</p>
                    </div>
                </div>
                <div class="confirm-content">
                    <div class="confirm-title">
                        <p>メールアドレス</p>
                    </div>
                    <div class="confirm-body">
                        <p>{{ $user['email'] }}</p>
                    </div>
                </div>
            </div>
            <div class="back-btn-container">
                <form action="{{ route('showUsers') }}" method="get">
                    <input type="hidden" name="search" value="{{ session("search") }}">
                    <input type="hidden" name="page" value="{{ session("page") }}">
                    <button type="submit" class="btn btn-link back-btn">
                        お客様一覧
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
