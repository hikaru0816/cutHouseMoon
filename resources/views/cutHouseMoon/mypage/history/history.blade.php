<?php
    require_once(__DIR__ . '/../../../public/functions.php');
    $pageTitle = 'カット履歴 - カットハウスムーン';
?>

@include('layouts.header')

<section id="history">
    <div class="wrapper">
        <h2>カット履歴</h2>
        <div class="content-container">
            <div class="done-reservation">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>日付</th>
                            <th>カットメニュー</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0  ?>
                        @foreach ($histories as $history)
                            <?php $i++ ?>
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ str_replace('/0', '/', str_replace('-', '/' , $history['date'])) }}({{ getDayOfWeek($history['date']) }})</td>
                                <td>{{ $history['menu']['name'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="links">
                {!! $histories->links() !!}
            </div>
            <div class="back-btn-container">
                <a href="{{ route('mypage') }}" class="btn btn-link back-btn">マイページへ</a>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
