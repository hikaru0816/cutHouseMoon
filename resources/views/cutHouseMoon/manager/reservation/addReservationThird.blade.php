<?php
    require_once(__DIR__ . '/../../../public/functions.php');
    $pageTitle = '予約追加 - カットハウスムーン';
?>

@include('layouts.header')

<section id="edit-reservation">
    <div class="wrapper">
        <h2>予約追加</h2>
        <div class="content-container">
            <h4>お客様情報</h4>
            <div class="confirm">
                <div class="confirm-content">
                    <div class="confirm-title">
                        <p>ヨミ</p>
                    </div>
                    <div class="confirm-body">
                        <p>{{ session('user_kana') }}</p>
                    </div>
                </div>
                <div class="confirm-content">
                    <div class="confirm-title">
                        <p>名前</p>
                    </div>
                    <div class="confirm-body">
                        <p>{{ session('user_name') }}</p>
                    </div>
                </div>
            </div>
            <h4 style="margin-top: 15px">予約状況</h4>
            @if (count(session('reservations')) === 0)
                <div class="no-reservation">
                    <p>予約していません</p>
                </div>
            @else
                <div class="done-reservation">
                    <?php $i = 0 ?>
                    <div class="confirm">
                        @foreach (session('reservations') as $reservation)
                            <?php $i++ ?>
                            <div class="confirm-content">
                                <div class="confirm-title">
                                    <p>予約{{$i}}</p>
                                </div>
                                <div class="confirm-body">
                                    <p>
                                        {{ str_replace('/0', '/', str_replace('-', '/' , $reservation['date'])) }}({{ getDayOfWeek($reservation['date']) }}) {{ substr($reservation['startTime']['time'], 0, 5) }}<br>
                                        {{ $reservation['menu']['name'] }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="form-content" style="margin-top: 20px">
                <label class="form-label">カットメニュー</label>
                <input value="{{ $menu['name'] }}　{{ number_format($menu['price']) }}円" class="form-control" disabled>
            </div>
            <form action="{{ route('addReservationForth') }}" method="GET" style="margin-top: 20px">
                <div class="form-content">
                    <label for="date" class="form-label">日付</label>
                    <input id="date" type="date" name="date" required class="form-control" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('2 weeks')) }}" onchange="submit(this.form)">
                    <p class="date-info rice-mark">
                        ※翌日から2週間後までの予約が可能です。<br>
                        当日の予約はお電話にてお願いいたします。<br>
                        毎月、第一日曜日・毎週月曜日はお休みのため予約できません。<br>
                        毎年、1/1～1/4は正月休み・8/13～8/15はお盆休みのため予約できません。
                    </p>
                </div>
            </form>
            <div class="btn-container">
                <a href="{{ route('addReservationSecond') }}" class="btn btn-secondary modify-btn">修正</a>
            </div>
            <div class="back-btn-container">
                <form action="{{ route('addReservationFirst') }}" method="get">
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
<section>

</section>

@include('layouts.footer')
