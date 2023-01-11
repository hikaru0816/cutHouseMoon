<?php
    $pageTitle = '予約 - カットハウスムーン';
?>

@include('layouts.header')

<section id="customer-name">
    <div class="wrapper">
        <p>{{ Auth::user()->name }} 様</p>
    </div>
</section>

<section id="booking">
    <div class="wrapper">
        <h2>新規予約</h2>
        <div class="content-container">
            <form action="{{ route('bookingSecond') }}" method="GET">
                <div class="form-content">
                    <label for="date" class="form-label">日付</label>
                    @if (!empty($_GET['date']))
                        <input id="date" type="date" name="date" value="{{ $_GET['date'] }}" required class="form-control" min="{{ date('Y-m-d', strtotime('1 days')) }}" max="{{ date('Y-m-d', strtotime('2 weeks')) }}" onchange="submit(this.form)">
                    @elseif (!empty(session('date')))
                        <input id="date" type="date" name="date" value="{{ session('date') }}" required class="form-control" min="{{ date('Y-m-d', strtotime('1 days')) }}" max="{{ date('Y-m-d', strtotime('2 weeks')) }}" onchange="submit(this.form)">
                    @else
                        <input id="date" type="date" name="date" value="{{ old('date') }}" required class="form-control" min="{{ date('Y-m-d', strtotime('1 days')) }}" max="{{ date('Y-m-d', strtotime('2 weeks')) }}" onchange="submit(this.form)">
                    @endif
                    <p class="date-info rice-mark">
                        ※翌日から2週間後までの予約が可能です。<br>
                        当日の予約はお電話にてお願いいたします。<br>
                        毎月、第一日曜日・毎週月曜日はお休みのため予約できません。<br>
                        毎年、1/1～1/4は正月休み・8/13～8/15はお盆休みのため予約できません。
                    </p>
                </div>
            </form>
            <form action="{{ route('bookingCheck') }}" method="POST">
                @csrf
                @if (!empty($_GET['date']))
                    <input type="hidden" name="date" value="{{ $_GET['date'] }}">
                @elseif (!empty(session('date')))
                    <input type="hidden" name="date" value="{{ session('date') }}">
                @else
                    <input type="hidden" name="date" value="{{ old('date') }}">
                @endif
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
                            @if (!in_array($startTime['id'], $unableTime))
                                @if (!empty(session('startTime')))
                                    @if (session('startTime') == $startTime['id'])
                                        <option value="{{ $startTime['id'] }}" selected>
                                            {{ ltrim(substr($startTime['time'], 0, 5), 0) }}
                                        </option>
                                    @else
                                        <option value="{{ $startTime['id'] }}">
                                            {{ ltrim(substr($startTime['time'], 0, 5), 0) }}
                                        </option>
                                    @endif
                                @else
                                    @if (old('start_time') == $startTime['id'])
                                        <option value="{{ $startTime['id'] }}" selected>
                                            {{ ltrim(substr($startTime['time'], 0, 5), 0) }}
                                        </option>
                                    @else
                                        <option value="{{ $startTime['id'] }}">
                                            {{ ltrim(substr($startTime['time'], 0, 5), 0) }}
                                        </option>
                                    @endif
                                @endif
                            @endif
                        @endforeach
                    </select>
                    <p class="date-info rice-mark">
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
                            @if (!empty(session('menu')))
                                @if (session('menu') == $menu['id'])
                                    <option value="{{ $menu['id'] }}" selected>
                                        {{ $menu['name'] }}　{{ number_format($menu['price']) }}円
                                    </option>
                                @else
                                    <option value="{{ $menu['id'] }}">
                                        {{ $menu['name'] }}　{{ number_format($menu['price']) }}円
                                    </option>
                                @endif
                            @else
                                @if (old('menu') == $menu['id'])
                                    <option value="{{ $menu['id'] }}" selected>
                                        {{ $menu['name'] }}　{{ number_format($menu['price']) }}円
                                    </option>
                                @else
                                    <option value="{{ $menu['id'] }}">
                                        {{ $menu['name'] }}　{{ number_format($menu['price']) }}円
                                    </option>
                                @endif
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-content" style="margin-top: 20px">
                    <button type="submit" class="btn btn-primary">
                        次へ
                    </button>
                </div>
            </form>
            <div class="back-btn-container">
                <a href="{{ route('mypage') }}" class="btn btn-link back-btn">マイページへ</a>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
