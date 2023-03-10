<?php
    require_once(__DIR__ . '/../../../public/functions.php');
    $pageTitle = '予約追加 - カットハウスムーン';
?>

@include('layouts.header')

<section id="edit-reservation">
    <div class="wrapper">
        <h2>予約追加</h2>
        <div class="content-container">
            <h4>お客様情報</h4>
            <div class="confirm">
                <div class="confirm-content">
                    <div class="confirm-title">
                        <p>ヨミ</p>
                    </div>
                    <div class="confirm-body">
                        <p>{{ session('user_kana') }}</p>
                    </div>
                </div>
                <div class="confirm-content">
                    <div class="confirm-title">
                        <p>名前</p>
                    </div>
                    <div class="confirm-body">
                        <p>{{ session('user_name') }}</p>
                    </div>
                </div>
            </div>
            <h4 style="margin-top: 15px">予約状況</h4>
            @if (count(session('reservations')) === 0)
                <div class="no-reservation">
                    <p>予約していません</p>
                </div>
            @else
                <div class="done-reservation">
                    <?php $i = 0 ?>
                    <div class="confirm">
                        @foreach (session('reservations') as $reservation)
                            <?php $i++ ?>
                            <div class="confirm-content">
                                <div class="confirm-title">
                                    <p>予約{{$i}}</p>
                                </div>
                                <div class="confirm-body">
                                    <p>
                                        {{ str_replace('/0', '/', str_replace('-', '/' , $reservation['date'])) }}({{ getDayOfWeek($reservation['date']) }}) {{ substr($reservation['startTime']['time'], 0, 5) }}<br>
                                        {{ $reservation['menu']['name'] }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <form action="{{ route('validateMenuOnManager') }}" method="GET" style="margin-top: 20px">
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
                <form action="{{ route('addReservationFirst') }}" method="get">
                    <input type="hidden" name="search" value="{{ session("search") }}">
                    <input type="hidden" name="page" value="{{ session("page") }}">
                    <button type="submit" class="btn btn-link back-btn">
                        お客様一覧
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
<section>

</section>

@include('layouts.footer')
