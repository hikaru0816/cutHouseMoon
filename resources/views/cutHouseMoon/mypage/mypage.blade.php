<?php
    require_once(__DIR__ . '/../../../public/functions.php');
    $pageTitle = 'マイページ - カットハウスムーン';
?>

@include('layouts.header')

<section id="check-reservation">
    <div class="wrapper">
        <h2>予約</h2>
        <div class="content-container">
            @if (count($reservations) === 0)
                <div class="no-reservation">
                    <p>予約していません</p>
                </div>
            @else
                <div class="done-reservation">
                    <table>
                        <thead>
                            <tr>
                                <th>日時</th>
                                <th>カットメニュー</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $reservation)
                                <tr>
                                    <td>{{ str_replace('/0', '/', str_replace('-', '/' , $reservation['date'])) }}({{ getDayOfWeek($reservation['date']) }}) {{ ltrim(substr($reservation['startTime']['time'], 0, 5), 0) }}</td>
                                    <td>{{ $reservation['menu']['name'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p class="rice-mark">※予約の変更・キャンセルはお電話お願いいたします。</p>
                </div>
            @endif
        </div>
        <div class="content-container">
            <input type="hidden" value="{{ $countOfReservations }}" class="count-of-reservations">
            <a href="{{ route('bookingFirst') }}" class="btn btn-primary new-reserve">新規予約</a>
            <p class="rice-mark">
                ※翌日から2週間後まで予約可能です。<br>
            </p>
        </div>
    </div>
</section>

<section id="check-history">
    <div class="wrapper">
        <h2>カット履歴</h2>
        <div class="content-container">
            @if (count($histories) === 0)
                <div class="no-reservation">
                    <p>カット履歴がありません</p>
                </div>
            @elseif (count($histories) <= 3)
                <div class="done-reservation">
                    <table>
                        <thead>
                            <tr>
                                <th>日付</th>
                                <th>カットメニュー</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($histories as $history)
                                <tr>
                                    <td>{{ str_replace('/0', '/', str_replace('-', '/' , $history['date'])) }}({{ getDayOfWeek($history['date']) }})</td>
                                    <td>{{ $history['menu']['name'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="done-reservation">
                    <table>
                        <thead>
                            <tr>
                                <th>日付</th>
                                <th>カットメニュー</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ str_replace('/0', '/', str_replace('-', '/' , $histories[0]['date'])) }}({{ getDayOfWeek($histories[0]['date']) }})</td>
                                <td>{{ $histories[0]['menu']['name'] }}</td>
                            </tr>
                            <tr>
                                <td>{{ str_replace('/0', '/', str_replace('-', '/' , $histories[1]['date'])) }}({{ getDayOfWeek($histories[1]['date']) }})</td>
                                <td>{{ $histories[1]['menu']['name'] }}</td>
                            </tr>
                            <tr>
                                <td>{{ str_replace('/0', '/', str_replace('-', '/' , $histories[2]['date'])) }}({{ getDayOfWeek($histories[2]['date']) }})</td>
                                <td>{{ $histories[2]['menu']['name'] }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="rice-mark">※最新の3件のみ表示しています。</p>
                    <a href="{{ route('mypage.history') }}" class="btn btn-link" style="font-size: 20px">もっと見る</a>
                </div>
            @endif
        </div>
    </div>
</section>

<section id="check-my-info">
    <div class="wrapper">
        <h2>ご登録情報</h2>
        <div class="content-container">

        </div>
    </div>
</section>

@include('layouts.footer')
