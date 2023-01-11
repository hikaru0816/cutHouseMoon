<?php
    $pageTitle = 'パスワード変更 - カットハウスムーン';
?>


@include('layouts.header')

<div class="wrapper">
    <section id="reset-password">
        <h2>パスワード変更</h2>
        <div class="content-container">
            <form action="{{ route('resetPassword') }}" method="POST" novalidate>
                @csrf
                <div class="form-content">
                    <label for="email" class="form-label">メールアドレス</label>
                    <input value="{{ session('email') }}" class="form-control" disabled>
                    <input type="hidden" id="email" name="email" value="{{ session('email') }}">
                </div>
                <div class="form-content">
                    <label for="password" class="form-label">新しいパスワード</label>
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
                    <label for="password-confirm" class="form-label">新しいパスワード（確認用）</label>
                    <input id="password-confirm" type="password" name="password_confirmation" required placeholder="上欄と同じものを入力" class="form-control">
                </div>
                <div class="form-content">
                    <button type="submit" class="btn btn-primary">
                        変更する
                    </button>
                </div>
            </form>
            <div class="back-btn-container">
                <a href="{{ route('resetPasswordFirst') }}" class="btn btn-link back-btn">メールアドレス入力へ戻る</a>
            </div>
        </div>
    </section>
</div>

@include('layouts.footer')
