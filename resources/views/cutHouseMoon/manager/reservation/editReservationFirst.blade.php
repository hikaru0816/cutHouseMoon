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
            <form action="{{ route('validateMenuOnEditReservation') }}" method="GET">
                <div class="form-content">
                    <label for="newMenu" class="form-label">カットメニュー</label>
                    @if($errors->has('newMenu'))
                        @foreach($errors->get('newMenu') as $message)
                        <p class="validation-error-message">
                            {{ $message }}
                        </p>
                        @endforeach
                    @endif
                    <select name="newMenu" id="newMenu" class="form-select">
                        <option hidden value="">選択してください</option>
                        @foreach ($menus as $menu)
                            @if (session('newMenu'))
                                @if (session('newMenu') == $menu['id'])
                                    <option value="{{ $menu['id'] }}" selected>
                                        {{ $menu['name'] }}　{{ number_format($menu['price']) }}円
                                    </option>
                                @else
                                    <option value="{{ $menu['id'] }}">
                                        {{ $menu['name'] }}　{{ number_format($menu['price']) }}円
                                    </option>
                                @endif
                            @elseif (old('newMenu'))
                                @if (old('newMenu') == $menu['id'])
                                    <option value="{{ $menu['id'] }}" selected>
                                        {{ $menu['name'] }}　{{ number_format($menu['price']) }}円
                                    </option>
                                @else
                                    <option value="{{ $menu['id'] }}">
                                        {{ $menu['name'] }}　{{ number_format($menu['price']) }}円
                                    </option>
                                @endif
                            @else
                                @if (session('menu_id') == $menu['id'])
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
                <a href="{{ route('allReservation') }}" class="btn btn-link back-btn">予約一覧へ</a>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
