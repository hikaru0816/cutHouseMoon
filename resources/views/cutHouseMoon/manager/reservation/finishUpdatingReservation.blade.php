<?php
    require_once(__DIR__ . '/../../../public/functions.php');
    $pageTitle = '予約編集完了 - カットハウスムーン';
?>

@include('layouts.header')

<section id="update-reservation">
    <div class="wrapper">
        <h2>予約編集完了</h2>
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
        <div class="content-container update-reservation-content">
            <h4>予約変更内容</h4>
            <p>以下の内容で予約の変更を登録しました。</p>
            <div class="confirm">
                <div class="confirm-content confirm-content-vertical">
                    <div class="confirm-title">
                        <p>日付</p>
                    </div>
                    <div class="confirm-content">
                        <div class="confirm-body-update">
                            <p>
                                {{ ltrim(str_replace('/0', '/', str_replace('-', '/', session('date'))), 0)}}({{ getDayOfWeek(session('date')) }})
                            </p>
                        </div>
                        <div class="arrow">➡</div>
                        <div class="confirm-body-update">
                            <p>
                                {{ ltrim(str_replace('/0', '/', str_replace('-', '/', session('selectedDate'))), 0)}}({{ getDayOfWeek(session('selectedDate')) }})
                            </p>
                        </div>
                    </div>
                </div>
                <div class="confirm-content confirm-content-vertical">
                    <div class="confirm-title">
                        <p>時間</p>
                    </div>
                    <div class="confirm-content">
                        <div class="confirm-body-update">
                            <p>
                                {{ substr(session('time'), 0, 5) }}
                            </p>
                        </div>
                        <div class="arrow">➡</div>
                        <div class="confirm-body-update">
                            <p>
                                {{ substr(session('selectedStartTime'), 0, 5) }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="confirm-content confirm-content-vertical">
                    <div class="confirm-title">
                        <p>メニュー</p>
                    </div>
                    <div class="confirm-content">
                        <div class="confirm-body-update">
                            <p>{{ session('menu') }}</p>
                        </div>
                        <div class="arrow">➡</div>
                        <div class="confirm-body-update">
                            <p>{{ session('selectedMenu') }}</p>
                        </div>
                    </div>
                </div>
                <div class="back-btn-container" style="margin-top: 10px">
                    <a href="{{ route('allReservation') }}" class="btn btn-link back-btn">予約一覧へ</a>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
