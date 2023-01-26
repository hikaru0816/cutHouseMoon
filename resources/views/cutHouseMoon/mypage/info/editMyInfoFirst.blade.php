<?php
    $pageTitle = 'ご登録情報修正 - カットハウスムーン';
?>

@include('layouts.header')

<div class="wrapper">
    <section id="register">
        <h2>ご登録情報修正</h2>
        <div class="content-container">
            <form action="{{ route('mypage.editMyInfoCheck') }}" method="POST" novalidate>
                @csrf
                <div class="form-content">
                    <label for="kana" class="form-label">フリガナ</label>
                    @if($errors->has('kana'))
                        @foreach($errors->get('kana') as $message)
                        <p class="validation-error-message">
                            {{ $message }}
                        </p>
                        @endforeach
                    @endif
                    <input id="kana" name="kana" type="text" value="{{ session('kana') ?? old('kana') }}" class="form-control" placeholder="例）ヤマダタロウ">
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
                    <input id="name" name="name" type="text" value="{{ session('name') ?? old('name') }}" class="form-control" placeholder="例）山田太郎">
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
                    <input id="tel" name="tel" type="text" value="{{ session('tel') ?? old('tel') }}" class="form-control" placeholder="例）08012345678">
                </div>
                <div class="form-content">
                    <label for="email" class="form-label">メールアドレス</label>
                    @if($errors->has('email'))
                        @foreach($errors->get('email') as $message)
                        <p class="validation-error-message">
                            {{ $message }}
                        </p>
                        @endforeach
                    @endif
                    <input id="email" name="email" type="text" value="{{ session('email') ?? old('email') }}" class="form-control" placeholder="例）example@email.com">
                </div>
                <div class="form-content">
                    <button type="submit" class="btn btn-primary" style="margin-left: 5px">
                        次へ
                    </button>
                </div>
            </form>
            <div class="back-btn-container">
                <a href="{{ route('mypage') }}" class="btn btn-link back-btn">マイページへ</a>
            </div>
        </div>
    </section>
</div>

@include('layouts.footer')
