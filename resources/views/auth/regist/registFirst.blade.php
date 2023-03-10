<?php
    $pageTitle = '会員登録 - カットハウスムーン';
?>

@include('layouts.header')

<div class="wrapper">
    <section id="register">
        <h2>会員登録</h2>
        <div class="content-container">
            <form action="{{ route('checkEmailInRegister') }}" method="POST" novalidate>
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
                    <input id="email" type="text" name="email" value="{{ session('email') ?? old('email') }}" required autofocus placeholder="例）example@cut.com" class="form-control">
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
