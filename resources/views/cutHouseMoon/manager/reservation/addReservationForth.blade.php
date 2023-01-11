<?php
    require_once(__DIR__ . '/../../../public/functions.php');
    $pageTitle = '予約追加内容確認 - カットハウスムーン';
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
            <h4 style="margin-top: 15px">{{ session('user_name') }}様の予約状況</h4>
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
            <div class="add-reservation-confirm">
                <h4 style="margin-top: 15px">予約内容確認</h4>
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
            </div>
            <div class="btn-container">
                <a href="{{ route('addReservationThird') }}" class="btn btn-secondary modify-btn">修正</a>
                <a href="{{ route('finisfAddingReservation') }}" class="btn btn-primary next-btn">予約</a>
            </div>
            <div class="back-btn-container">
                <a href="{{ route('addReservationFirst') }}" class="btn btn-link back-btn">お客様一覧へ</a>
            </div>
        </div>
    </div>
</section>
<section>

</section>

@include('layouts.footer')
