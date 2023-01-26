<?php
    $pageTitle = '会員登録 - カットハウスムーン';
?>


@include('layouts.header')

<div class="wrapper">
    <section id="register">
        <h2>会員登録</h2>
        <div class="content-container">
            <form action="{{ route('registCheck') }}" method="POST" novalidate>
                @csrf
                <div class="form-content">
                    <label for="email" class="form-label">メールアドレス</label>
                    <input value="{{ session('email') }}" class="form-control" disabled>
                    <input type="hidden" id="email" name="email" value="{{ session('email') }}">
                </div>
                <div class="form-content">
                    <label for="name" class="form-label">名前</label>
                    @if($errors->has('name'))
                        @foreach($errors->get('name') as $message)
                        <p class="validation-error-message">
                            {{ $message }}
                        </p>
                        @endforeach
                    @endif
                    <input id="name" type="text" name="name" value="{{ session('name') ?? old('name') }}" required autofocus placeholder="例）山田太郎" class="form-control">
                </div>
                <div class="form-content">
                    <label for="kana" class="form-label">フリガナ</label>
                    @if($errors->has('kana'))
                        @foreach($errors->get('kana') as $message)
                        <p class="validation-error-message">
                            {{ $message }}
                        </p>
                        @endforeach
                    @endif
                    <input id="kana" type="text" name="kana" value="{{ session('kana') ?? old('kana') }}" required autofocus placeholder="例）ヤマダタロウ" class="form-control">
                </div>
                <div class="form-content">
                    <label for="tel" class="form-label">電話番号</label>
                    @if($errors->has('tel'))
                        @foreach($errors->get('tel') as $message)
                        <p class="validation-error-message">
                            {{ $message }}
                        </p>
                        @endforeach
                    @endif
                    <input id="tel" type="text" name="tel" value="{{ session('tel') ?? old('tel') }}" required autofocus placeholder="例）08012345678" class="form-control">
                </div>

                <div class="form-content">
                    <label for="password" class="form-label">パスワード</label>
                    @if($errors->has('password'))
                        @foreach($errors->get('password') as $message)
                        <p class="validation-error-message">
                            {{ $message }}
                        </p>
                        @endforeach
                    @endif
                    <input id="password" type="password" name="password" required autofocus placeholder="条件）6文字以上" class="form-control">
                </div>
                <div class="form-content">
                    <label for="password-confirm" class="form-label">パスワード（確認用）</label>
                    <input id="password-confirm" type="password" name="password_confirmation" required placeholder="パスワード再入力" class="form-control">
                </div>
                <div class="form-content">
                    <a href="{{ route('registFirst') }}" class="btn btn-secondary modify-btn" style="margin-right: 5px">メールアドレス変更</a>
                    <button type="submit" class="btn btn-primary" style="margin-left: 5px">
                        次へ
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>

@include('layouts.footer')
