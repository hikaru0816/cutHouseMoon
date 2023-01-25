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
        </div>
    </div>
</section>

@include('layouts.footer')
