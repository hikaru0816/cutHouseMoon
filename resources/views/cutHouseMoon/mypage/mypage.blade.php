<?php
    require_once(__DIR__ . '/../../../public/functions.php');
    $pageTitle = 'マイページ - カットハウスムーン';
?>

@include('layouts.header')

<section id="customer-name">
    <div class="wrapper">
        <p>{{ Auth::user()->name }} 様</p>
    </div>
</section>

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
    </div>
</section>

<section id="reservate">
    <div class="wrapper">
        <input type="hidden" value="{{ $countOfReservations }}" class="count-of-reservations">
        <a href="{{ route('bookingFirst') }}" class="btn btn-primary new-reserve">新規予約</a>
        <p class="rice-mark">
            ※翌日から2週間後まで予約可能です。<br>
        </p>
    </div>
</section>

@include('layouts.footer')
