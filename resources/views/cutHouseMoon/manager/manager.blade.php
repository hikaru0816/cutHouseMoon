<?php
    $pageTitle = '管理者ページ - カットハウスムーン';
?>

@include('layouts.header')

<section id="empty-status">
    <div class="wrapper">
        <div class="content-container">
            <h2>空き状況更新</h2>
            <form action="{{ route('updateEmpty') }}" method="POST">
                @csrf
                <div class="form-content">
                    <label for="empty" class="form-label">空席：</label>
                    <select name="empty" id="empty" class="form-select">
                        @foreach ($emptyStatuses as $emptyStatus)
                            @if ($emptyStatus['empty_select'] === 0)
                                <option value="{{ $emptyStatus['id'] }}">{{ $emptyStatus['empty_number'] }}</option>
                            @else
                                <option value="{{ $emptyStatus['id'] }}" selected>{{ $emptyStatus['empty_number'] }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-content">
                    <label for="waiting" class="form-label">待ち：</label>
                    <select name="waiting" id="waiting" class="form-select">
                        @foreach ($waitingStatuses as $waitingStatus)
                            @if ($waitingStatus['waiting_select'] === 0)
                                <option value="{{ $waitingStatus['id'] }}">{{ $waitingStatus['waiting_number'] }}</option>
                            @else
                                <option value="{{ $waitingStatus['id'] }}" selected>{{ $waitingStatus['waiting_number'] }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-content">
                    <button type="submit" class="btn btn-primary">
                        更新
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
<section id="reservation">
    <div class="wrapper">
        <div class="content-container">
            <h2>本日の予約</h2>
            @if (count($today) === 0)
                <p style="text-align: center; font-size: 20px">予約無し</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>時間</th>
                            <th>氏名</th>
                            <th>メニュー</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0 ?>
                        @foreach ($today as $reservation)
                        <?php $i++ ?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ ltrim(substr($reservation['startTime']['time'], 0, 5), 0) }} </td>
                            <td>{{ $reservation['user']['name'] }}</td>
                            <td>{{ $reservation['menu']['name'] }}</td>
                            <td>
                                <form action="{{ route('editReservationFirst') }}" method="get">
                                    <input type="hidden" name="no" value="{{ $reservation['no'] }}">
                                    <button type="submit" class="btn btn-link">編集</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('finishReservation') }}" method="get">
                                    <input type="hidden" name="no" value="{{ $reservation['no'] }}">
                                    <button type="submit" class="btn btn-link finish-reservation" value="{{ $i }}">済</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            <div class="all-reservations">
            </div>
            <div class="btn-container">
                <div class="btn-content">
                    <a href="{{ route('allReservation') }}" class="btn btn-link next-btn">予約一覧</a>
                </div>
                <div class="btn-content">
                    <a href="{{ route('addReservationFirst') }}" class="btn btn-primary next-btn">予約追加</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="manager-menu">
    <div class="wrapper">
        <h2>その他</h2>
        <div class="content-container">
            <div class="manager-menu-content">
                <a href="{{ route('showCutMenu') }}" class="btn btn-link">カットメニュー一覧</a>
            </div>
            <div class="manager-menu-content">
                <a href="{{ route('showUsers') }}" class="btn btn-link">お客様一覧</a>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
