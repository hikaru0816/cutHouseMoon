<?php
    require_once(__DIR__ . '/../../../public/functions.php');
    $pageTitle = '予約一覧 - カットハウスムーン';
?>

@include('layouts.header')

<section id="show-all-reservations">
    <div class="wrapper">
        <div class="content-container">
            <h2>予約一覧</h2>
            @if (count($reservations) === 0)
                <p style="text-align: center">予約はありません</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>日付</th>
                            <th>時間</th>
                            <th>氏名</th>
                            <th>メニュー</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0 ?>
                        @foreach ($reservations as $reservation)
                        <?php $i++ ?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td>
                                {{ ltrim(str_replace('/0', '/', substr(str_replace('-', '/', $reservation['date']), -5)), 0)}}({{ getDayOfWeek($reservation['date']) }})
                            </td>
                            <td>{{ ltrim(substr($reservation['startTime']['time'], 0, 5), 0) }} </td>
                            <td>{{ $reservation['user']['name'] }}</td>
                            <td>{{ $reservation['menu']['name'] }}</td>
                            <td>
                                <form action="{{ route('editReservationFirst') }}" method="get">
                                    <input type="hidden" name="id" value="{{ $reservation['id'] }}">
                                    <button type="submit" class="btn btn-link">編集</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('finishReservation') }}" method="get">
                                    <input type="hidden" name="id" value="{{ $reservation['id'] }}">
                                    <button type="submit" class="btn btn-link finish-reservation" value="{{ $i }}">済</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="links">
                    {!! $reservations->links() !!}
                </div>
            @endif
            <div class="back-btn-container">
                <a href="{{ route('manager') }}" class="btn btn-link back-btn">管理者ページへ</a>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
