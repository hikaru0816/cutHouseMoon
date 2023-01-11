<?php
    $pageTitle = '予約内容確認 - カットハウスムーン';
?>
@include('layouts.header')

<section id="customer-name">
    <div class="wrapper">
        <p>{{ Auth::user()->name }} 様</p>
    </div>
</section>

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
                        @foreach ($startTimes as $startTime)
                            @if ($startTime['id'] == session('startTime'))
                                <p>
                                    {{ ltrim(substr($startTime['time'], 0, 5), 0) }}
                                </p>
                            @endif
                        @endforeach
                    </div>
                </div>
                @foreach ($menus as $menu)
                    @if ($menu['id'] == session('menu'))
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
                    @endif
                @endforeach
            </div>
            <div class="btn-container">
                <a href="{{ route('bookingSecond') }}" class="btn btn-secondary modify-btn">修正</a>
                <a href="{{ route('booking') }}" class="btn btn-primary next-btn">予約</a>
            </div>
            <div class="back-btn-container">
                <a href="{{ route('mypage') }}" class="btn btn-link back-btn">マイページへ</a>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
