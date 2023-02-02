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
                            {{ str_replace('/0', '/', str_replace('-', '/', session('nowDate'))) }}({{ getDayOfWeek(session('nowDate')) }})
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
            <div class="form-content">
                <label class="form-label">カットメニュー</label>
                <input value="{{ $menu['name'] }}　{{ number_format($menu['price']) }}円" class="form-control" disabled>
            </div>
            <form action="{{ route('editReservationThird') }}" method="GET" style="margin-top: 20px">
                <div class="form-content">
                    <label for="date" class="form-label">日付</label>
                    <input type="date" id="date" name="date" value="{{ session('date') }}" required class="form-control" min="{{ date('Y-m-d') }}" max="{{ date('Y-m-d', strtotime('2 weeks')) }}" onchange="submit(this.form)">
                    <p class="date-info rice-mark">
                        ※翌日から2週間後までの予約が可能です。<br>
                        当日の予約はお電話にてお願いいたします。<br>
                        毎月、第一日曜日・毎週月曜日はお休みのため予約できません。<br>
                        毎年、1/1～1/4は正月休み・8/13～8/15はお盆休みのため予約できません。
                    </p>
                </div>
            </form>
            <form action="{{ route('validateStartTimeOnEditReservation') }}" method="GET" style="margin-top: 20px">
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
                        @foreach ($ableTimes as $ableTime)
                            @if (!empty(session('startTime')))
                                @if (session('startTime') == $ableTime['id'])
                                    <option value="{{ $ableTime['id'] }}" selected>
                                        {{ ltrim(substr($ableTime['time'], 0, 5), 0) }}
                                    </option>
                                @else
                                    <option value="{{ $ableTime['id'] }}">
                                        {{ ltrim(substr($ableTime['time'], 0, 5), 0) }}
                                    </option>
                                @endif
                            @else
                                @if (old('start_time') == $ableTime['id'])
                                    <option value="{{ $ableTime['id'] }}" selected>
                                        {{ ltrim(substr($ableTime['time'], 0, 5), 0) }}
                                    </option>
                                @else
                                    <option value="{{ $ableTime['id'] }}">
                                        {{ ltrim(substr($ableTime['time'], 0, 5), 0) }}
                                    </option>
                                @endif
                            @endif
                        @endforeach
                    </select>
                    <p class="date-info rice-mark">
                        ※9:00～18:30の間で30分毎に予約可能です。<br>
                        予約可能な時間のみ表示されます。（表示されない時間は既に予約が入っています。）
                    </p>
                </div>
                <div class="btn-container">
                    <div class="form-content">
                        <button type="submit" class="btn btn-primary">
                            次へ
                        </button>
                    </div>
                </div>
            </form>
            <div class="back-btn-container">
                <a href="{{ route('allReservation') }}" class="btn btn-link back-btn">予約一覧へ</a>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
