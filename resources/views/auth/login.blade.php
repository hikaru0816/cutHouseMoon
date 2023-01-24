<?php
    $pageTitle = 'ログイン - カットハウスムーン';
?>

@include('layouts.header')

<div class="wrapper">
    <section id="login">
        <h2>ログイン</h2>
        <div class="content-container">
            <form action="{{ route('login') }}" method="POST" novalidate>
                @csrf
                <div class="form-content">
                    <label for="email" class="form-label">メールアドレス</label>
                    @if($errors->has('email'))
                        @foreach($errors->get('email') as $message)
                        <p class="validation-error-message">
                            {{ $message }}
                        </p>
                        @endforeach
                    @endif
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="例）example@cut.com" class="form-control">
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
                    <input id="password" type="password" name="password" value="{{ old('password') }}" required autofocus placeholder="パスワード" class="form-control">
                </div>
                <div class="form-content">
                    <button type="submit" class="btn btn-primary">
                        ログイン
                    </button>
                </div>
                <div class="form-content">
                    <a class="btn btn-link" href="{{ route('resetPasswordFirst') }}">
                        パスワードを忘れてしまった方はこちら
                    </a>
                </div>
            </form>
        </div>
    </section>
</div>

@include('layouts.footer')
