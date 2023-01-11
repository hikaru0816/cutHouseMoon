<?php
    require_once(__DIR__ . '/../../../public/functions.php');
    $pageTitle = '会員詳細 - カットハウスムーン';
?>

@include('layouts.header')

<section id="show-user-detail">
    <div class="wrapper">
        <div class="content-container">
            <h2>予約追加</h2>
            <div class="content-container">
                <h4>お客様詳細</h4>
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
                <div class="btn-container">
                    <form action="{{ route('addReservationSecond') }}" method="get">
                        <input type="hidden" name="id" value="{{ $user['user_id'] }}">
                        <button type="submit" class="btn btn-primary next-btn" value="{{ $user['name'] }}">選択</button>
                    </form>
                </div>
                <div class="back-btn-container">
                    <a href="{{ route('addReservationFirst') }}" class="btn btn-link back-btn">お客様一覧へ</a>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
