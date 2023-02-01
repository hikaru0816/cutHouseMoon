<?php
    require_once(__DIR__ . '/../../../public/functions.php');
    $pageTitle = '予約編集 - カットハウスムーン';
?>

@include('layouts.header')

<section id="edit-reservation">
    <div class="wrapper">
        <h2>予約編集</h2>
        <div class="content-container">
            <h4>お客様情報</h4>
            <div class="confirm">
                <div class="confirm-content">
                    <div class="confirm-title">
                        <p>ヨミ</p>
                    </div>
                    <div class="confirm-body">
                        <p>{{ session('kana') }}</p>
                    </div>
                </div>
                <div class="confirm-content">
                    <div class="confirm-title">
                        <p>名前</p>
                    </div>
                    <div class="confirm-body">
                        <p>{{ session('name') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-container">
            <h4>現在の予約</h4>
            <div class="confirm">
                <div class="confirm-content">
                    <div class="confirm-title">
                        <p>日付</p>
                    </div>
                    <div class="confirm-body">
                        <p>
                            {{ str_replace('/0', '/', str_replace('-', '/', session('nowDate'))) }}({{ getDayOfWeek(session('nowDate')) }})
                        </p>
                    </div>
                </div>
                <div class="confirm-content">
                    <div class="confirm-title">
                        <p>時間</p>
                    </div>
                    <div class="confirm-body">
                        <p>{{ ltrim(substr(session('time'), 0, 5), 0) }}</p>
                    </div>
                </div>
                <div class="confirm-content">
                    <div class="confirm-title">
                        <p>メニュー</p>
                    </div>
                    <div class="confirm-body">
                        <p>{{ session('menu') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-container">
            <h4>予約変更後</h4>
            <div class="confirm">
                <div class="confirm-content">
                    <div class="confirm-title">
                        <p>日付</p>
                    </div>
                    <div class="confirm-body">
                        <p>
                            {{ str_replace('/0', '/', str_replace('-', '/' , session('date'))) }}({{ getDayOfWeek(session('date')) }})
                        </p>
                    </div>
                </div>
                <div class="confirm-content">
                    <div class="confirm-title">
                        <p>時間</p>
                    </div>
                    <div class="confirm-body">
                        <p>
                            {{ ltrim(substr($startTime['time'], 0, 5), 0) }}
                        </p>
                    </div>
                </div>
                <div class="confirm-content">
                    <div class="confirm-title">
                        <p>メニュー</p>
                    </div>
                    <div class="confirm-body">
                        <p>{{ $menu['name'] }}</p>
                    </div>
                </div>
                <div class="confirm-content">
                    <div class="confirm-title">
                        <p>料金</p>
                    </div>
                    <div class="confirm-body">
                        <p>{{ number_format($menu['price']) }}円</p>
                    </div>
                </div>
            </div>
            <div class="btn-container">
                <a href="{{ route('editReservationThird') }}" class="btn btn-secondary modify-btn">修正</a>
                <a href="{{ route('editReservation') }}" class="btn btn-primary next-btn">予約</a>
            </div>
            <div class="back-btn-container">
                <a href="{{ route('allReservation') }}" class="btn btn-link back-btn">予約一覧へ</a>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
