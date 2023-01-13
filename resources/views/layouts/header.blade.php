<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $pageTitle }}</title>
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script type="module" src="{{ asset('js/api.js') }}"></script>
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
</head>
<body>
    <div class="header">
        <div class="wrapper">
            <div class="header-container">
                <div class="header-left">
                    <a href="{{ route('index') }}">
                        <img src="{{ asset('img/logo.png') }}" alt="カットハウスムーン">
                    </a>
                </div>
                <div class="header-center">
                    <div>
                        <a href="{{ route('index') }}#about">店舗情報</a>
                    </div>
                    <div>
                        <a href="{{ route('index') }}#menu">カットメニュー</a>
                    </div>
                    <div>
                        <a href="{{ route('index') }}#access">アクセス</a>
                    </div>
                </div>
                <div class="header-right">
                    @if (empty(Auth::user()))
                        <div class="unlogin">
                            <div>
                                <a href="{{ route('registFirst') }}" class="btn btn-info">会員登録</a>
                            </div>
                            <div>
                                <a href="{{ route('login') }}" class="btn btn-primary">ログイン</a>
                            </div>
                        </div>
                    @else
                        <div class="login">
                            @if (Auth::user()->role === 0)
                                <div>
                                    <a href="{{ route('mypage') }}" class="btn btn-info">マイページ</a>
                                </div>
                            @else
                                <div>
                                    <a href="{{ route('manager') }}" class="btn btn-info">管理者ページ</a>
                                </div>
                            @endif
                            <div>
                                <a class="btn btn-primary logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    ログアウト
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
                <input type="checkbox" id="hambarger" style="display: none">
                <label for="hambarger" class="hambarger">
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                </label>
            </div>
        </div>
    </div>
    <div class="small-nav">
        <div class="small-menu-left"></div>
        <div class="small-menu-right">
            <div class="small-menu">
                <div>
                    <a href="{{ route('index') }}#about">店舗情報</a>
                </div>
                <div>
                    <a href="{{ route('index') }}#menu">カットメニュー</a>
                </div>
                <div>
                    <a href="{{ route('index') }}#access">アクセス</a>
                </div>
            </div>
            @if (empty(Auth::user()))
                <div class="small-unlogin">
                    <div>
                        <a href="{{ route('registFirst') }}" class="btn btn-info">会員登録</a>
                    </div>
                    <div>
                        <a href="{{ route('login') }}" class="btn btn-primary">ログイン</a>
                    </div>
                </div>
            @else
                <div class="small-login">
                    @if (Auth::user()->role === 0)
                        <div>
                            <a href="{{ route('mypage') }}" class="btn btn-info">マイページ</a>
                        </div>
                    @else
                        <div>
                            <a href="{{ route('manager') }}" class="btn btn-info">管理者ページ</a>
                        </div>
                    @endif
                    <div>
                        <a class="btn btn-primary logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            ログアウト
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <main>
