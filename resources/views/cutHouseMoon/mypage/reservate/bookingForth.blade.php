<?php
    $pageTitle = '予約 - カットハウスムーン';
?>
@include('layouts.header')

<section id="booking">
    <div class="wrapper">
        <h2>予約内容確認</h2>
        <div class="content-container">
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
                        <p>開始時間</p>
                    </div>
                    <div class="confirm-body">
                        <p>
                            {{ ltrim(substr($startTime['time'], 0, 5), 0) }}
                        </p>
                    </div>
                </div>
                <div class="confirm-content">
                    <div class="confirm-title">
                        <p>カットメニュー</p>
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
                <a href="{{ route('bookingThird') }}" class="btn btn-secondary modify-btn">修正</a>
                <a href="{{ route('booking') }}" class="btn btn-primary next-btn">予約</a>
            </div>
            <div class="back-btn-container">
                <a href="{{ route('mypage') }}" class="btn btn-link back-btn">マイページへ</a>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
