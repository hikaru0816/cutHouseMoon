<?php
    $pageTitle = '予約 - カットハウスムーン';
?>
@include('layouts.header')

<section id="booking">
    <div class="wrapper">
        <h2>新規予約</h2>
        <div class="content-container">
            <form action="{{ route('validateMenu') }}" method="GET">
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
