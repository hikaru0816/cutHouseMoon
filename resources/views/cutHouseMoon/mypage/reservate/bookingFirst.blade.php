<?php
    $pageTitle = '予約 - カットハウスムーン';
?>
@include('layouts.header')

<section id="booking">
    <div class="wrapper">
        <h2>新規予約</h2>
        <div class="content-container">
            <form action="{{ route('bookingSecond') }}" method="GET">
                <div class="form-content">
                    <label for="date" class="form-label">日付</label>
                    <input id="date" type="date" name="date" required class="form-control" min="{{ date('Y-m-d', strtotime('1 days')) }}" max="{{ date('Y-m-d', strtotime('2 weeks')) }}" onchange="submit(this.form)">
                    <p class="date-info rice-mark">
                        ※翌日から2週間後までの予約が可能です。<br>
                        当日の予約はお電話にてお願いいたします。<br>
                        毎月、第一日曜日・毎週月曜日はお休みのため予約できません。<br>
                        毎年、1/1～1/4は正月休み・8/13～8/15はお盆休みのため予約できません。
                    </p>
                </div>
            </form>
            <div class="back-btn-container">
                <a href="{{ route('mypage') }}" class="btn btn-link back-btn">マイページへ</a>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
