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
                            {{ str_replace('/0', '/', str_replace('-', '/', session('date'))) }}({{ getDayOfWeek(session('date')) }})
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
            <h4>予約変更</h4>
            <form action="{{ route('editReservationSecond') }}" method="GET">
                <input type="hidden" name="id" value="{{ session('id') }}" id="reservation-id">
                <label for="date" class="form-label">日付</label>
                <input id="date" type="date" name="date" required class="form-control" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('2 weeks')) }}" onchange="submit(this.form)">
                <p class="rice-mark">
                    ※当日から2週間後までの予約が可能です。<br>
                    毎月、第一日曜日・毎週月曜日はお休みのため予約できません。<br>
                    毎年、1/1～1/4は正月休み・8/13～8/15はお盆休みのため予約できません。
                </p>
            </form>
            <div class="back-btn-container">
                <a href="{{ route('allReservation') }}" class="btn btn-link back-btn">予約一覧へ</a>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
