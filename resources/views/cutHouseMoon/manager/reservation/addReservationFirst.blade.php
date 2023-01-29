<?php
    require_once(__DIR__ . '/../../../public/functions.php');
    $pageTitle = '予約追加 - カットハウスムーン';
?>

@include('layouts.header')

<section id="show-users">
    <div class="wrapper">
        <h2>予約追加</h2>
        <div class="content-container">
            <h4>お客様選択</h4>
            <form action="{{ route('addReservationFirst') }}" method="get" class="search">
                <input type="search" placeholder="名前またはヨミを入力" name="search" value="@if (isset($search)) {{ $search }} @endif" class="form-control">
                <button type="submit" class="btn btn-secondary">検索</button>
                <a href="{{ route('addReservationFirst') }}"  class="btn btn-outline-dark">
                    クリア
                </a>
            </form>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>名前</th>
                        <th>ヨミ</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0  ?>
                    @foreach ($users as $user)
                    <?php $i++ ?>
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['kana'] }}</td>
                        <td>
                            <form action="{{ route('showUserDetailForReservation') }}" method="get">
                                <input type="hidden" name="id" value="{{ $user['user_id'] }}">
                                <button type="submit" class="btn btn-link detail-btn table-btn">詳細</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('addReservationSecond') }}" method="get">
                                <input type="hidden" name="id" value="{{ $user['user_id'] }}">
                                <button type="submit" class="btn btn-link select-btn table-btn" value="{{ $user['name'] }}">選択</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="links">
                {!! $users->appends(request()->query())->links() !!}
            </div>
            <div class="back-btn-container">
                <a href="{{ route('manager') }}" class="btn btn-link back-btn">管理者ページへ</a>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
