<?php
    $pageTitle = 'パスワード変更 - カットハウスムーン';

?>

@include('layouts.header')

<div class="wrapper">
    <section id="reset-password">
        <h2>パスワード変更</h2>
        <div class="content-container">
            <form action="{{ route('checkEmailInResetPassword') }}" method="POST" novalidate>
                @csrf
                <div class="form-content">
                    <label for="email" class="form-label label-left">パスワードを変更したいアカウントのメールアドレスを入力してください</label>
                    @if($errors->has('email'))
                        @foreach($errors->get('email') as $message)
                        <p class="validation-error-message">
                            {{ $message }}
                        </p>
                        @endforeach
                    @endif
                    @if (!empty(old('email')))
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="例）example@cut.com" class="form-control">
                    @else
                        <input id="email" type="email" name="email" value="{{ session('email') }}" required autofocus placeholder="例）example@cut.com" class="form-control">
                    @endif
                </div>
                <div class="form-content">
                    <button type="submit" class="btn btn-primary">
                        次へ
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>

@include('layouts.footer')
