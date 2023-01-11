<?php
    require_once(__DIR__ . '/../../../public/functions.php');
    $pageTitle = '予約編集 - カットハウスムーン';
?>

@include('layouts.header')

<section id="edit-reservation">
    <div class="wrapper">
        <h2>予約編集</h2>
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
        <div class="content-container">
            <h4>現在の予約</h4>
            <div class="confirm">
                <div class="confirm-content">
                    <div class="confirm-title">
                        <p>日付</p>
                    </div>
                    <div class="confirm-body">
                        <p>
                            {{ str_replace('/0', '/', str_replace('-', '/', session('date'))) }}({{ getDayOfWeek(session('date')) }})
                        </p>
                    </div>
                </div>
                <div class="confirm-content">
                    <div class="confirm-title">
                        <p>時間</p>
                    </div>
                    <div class="confirm-body">
                        <p>{{ ltrim(substr(session('time'), 0, 5), 0) }}</p>
                    </div>
                </div>
                <div class="confirm-content">
                    <div class="confirm-title">
                        <p>メニュー</p>
                    </div>
                    <div class="confirm-body">
                        <p>{{ session('menu') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-container">
            <h4>予約変更</h4>
            <form action="{{ route('editReservationSecond') }}" method="GET">
                <input type="hidden" name="id" value="{{ session('id') }}" id="reservation-id">
                <label for="date" class="form-label">日付</label>
                <input id="date" type="date" name="date" required class="form-control" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('2 weeks')) }}" onchange="submit(this.form)" value="{{ $_GET['date'] }}">
                <p class="rice-mark">
                    ※当日から2週間後までの予約が可能です。<br>
                    毎月、第一日曜日・毎週月曜日はお休みのため予約できません。<br>
                    毎年、1/1～1/4は正月休み・8/13～8/15はお盆休みのため予約できません。
                </p>
            </form>
            <form action="{{ route('updateReservation') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ session('id') }}">
                <input type="hidden" name="date" value="{{ $_GET['date'] }}">
                <div class="form-content">
                    <label for="start_time" class="form-label">開始時間</label>
                    @if($errors->has('start_time'))
                        @foreach($errors->get('start_time') as $message)
                        <p class="validation-error-message">
                            {{ $message }}
                        </p>
                        @endforeach
                    @endif
                    <select name="start_time" id="start_time" class="form-select">
                        <option hidden value="">選択してください</option>
                        @foreach ($startTimes as $startTime)
                            @if ($_GET['date'] === session('date'))
                                @if (!in_array($startTime['id'], $unableTime) || (session('time') === $startTime['time']))
                                    @if (session('time') === $startTime['time'])
                                        <option value="{{ $startTime['id'] }}" selected>
                                            {{ ltrim(substr($startTime['time'], 0, 5), 0) }}
                                        </option>
                                    @else
                                        <option value="{{ $startTime['id'] }}">
                                            {{ ltrim(substr($startTime['time'], 0, 5), 0) }}
                                        </option>
                                    @endif
                                @endif
                            @else
                                @if (!in_array($startTime['id'], $unableTime))
                                    <option value="{{ $startTime['id'] }}">
                                        {{ ltrim(substr($startTime['time'], 0, 5), 0) }}
                                    </option>
                                @endif
                            @endif
                        @endforeach
                    </select>
                    <p class="rice-mark">
                        ※9:00～18:00の間で30分毎に予約可能です。<br>
                        予約可能な時間のみ表示されます。（表示されない時間は既に予約が入っています。）
                    </p>
                </div>
                <div class="form-content">
                    <label for="menu" class="form-label">カットメニュー</label>
                    @if($errors->has('menu'))
                        @foreach($errors->get('menu') as $message)
                        <p class="validation-error-message">
                            {{ $message }}
                        </p>
                        @endforeach
                    @endif
                    <select name="menu" id="menu" class="form-select">
                        <option hidden value="">選択してください</option>
                        @foreach ($menus as $menu)
                            @if (session('menu_id') === $menu['id'])
                                <option value="{{ $menu['id'] }}" selected>
                                    {{ $menu['name'] }}　{{ number_format($menu['price']) }}円
                                </option>
                            @else
                                <option value="{{ $menu['id'] }}">
                                    {{ $menu['name'] }}　{{ number_format($menu['price']) }}円
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-content" style="margin-top: 15px">
                    <button type="submit" class="btn btn-primary">
                        変更する
                    </button>
                </div>
            </form>
            <div class="back-btn-container">
                <a href="{{ route('allReservation') }}" class="btn btn-link back-btn">予約一覧へ</a>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
