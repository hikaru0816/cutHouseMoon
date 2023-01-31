<?php
    $pageTitle = 'カットメニュー編集 - カットハウスムーン';
?>
@include('layouts.header')

<section id="edit-cut-menu">
    <div class="wrapper">
        <h2>カットメニュー編集</h2>
        <div class="content-container">
            <h4>現在</h4>
            <div class="confirm">
                <div class="confirm-content">
                    <div class="confirm-title">
                        <p>メニュー名</p>
                    </div>
                    <div class="confirm-body">
                        <p>{{ $menu['name'] }}</p>
                    </div>
                </div>
                <div class="confirm-content">
                    <div class="confirm-title">
                        <p>料金</p>
                    </div>
                    <div class="confirm-body">
                        <p>
                            {{ number_format($menu['price']) }}円
                        </p>
                    </div>
                </div>
                <div class="confirm-content">
                    <div class="confirm-title">
                        <p>施術時間</p>
                    </div>
                    <div class="confirm-body">
                        <p>
                            {{ sprintf('%.1f',$menu['doing_time']) }}時間
                        </p>
                    </div>
                </div>
                <div class="confirm-content">
                    <div class="confirm-title">
                        <p>状態</p>
                    </div>
                    <div class="confirm-body">
                        @if ($menu['display'] === 0)
                            <p>
                                表示中
                            </p>
                        @else
                            <p>
                                非表示中
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="content-container edit">
            <h4>メニュー編集</h4>
            <form action="{{ route('editCutMenuComplete') }}" method="post" novalidate>
                @csrf
                <input type="hidden" name="id" value="{{ $menu['id'] }}">
                <div class="form-content">
                    <label for="name" class="form-label">メニュー名</label>
                    @if($errors->has('name'))
                        @foreach($errors->get('name') as $message)
                        <p class="validation-error-message">
                            {{ $message }}
                        </p>
                        @endforeach
                    @endif
                    @if (empty(old('name')))
                        <input id="name" type="text" name="name" value="{{ $menu['name'] }}" required autofocus placeholder="例）〇〇カット" class="form-control">
                    @else
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="例）〇〇カット" class="form-control">
                    @endif
                </div>
                <div class="form-content">
                    <label for="price" class="form-label">料金（円）</label>
                    @if($errors->has('price'))
                        @foreach($errors->get('price') as $message)
                        <p class="validation-error-message">
                            {{ $message }}
                        </p>
                        @endforeach
                    @endif
                    @if (empty(old('price')))
                        <input id="price" type="number" name="price" value="{{ $menu['price'] }}" required autofocus placeholder="例）5000（数字のみ入力）" class="form-control">
                    @else
                        <input id="price" type="number" name="price" value="{{ old('price') }}" required autofocus placeholder="例）5000（数字のみ入力）" class="form-control">
                    @endif
                </div>
                <div class="form-content">
                    <label for="display" class="form-label">状態</label>
                    <select name="display" id="display" class="form-select">
                        <option hidden>選択してください</option>
                        @if (empty(old('display')))
                            @if ($menu['display'] === 0)
                                <option value="0" selected>表示</option>
                                <option value="1">非表示</option>
                            @else
                                <option value="0">表示</option>
                                <option value="1" selected>非表示</option>
                            @endif
                        @else
                            @if (old['display'] === 0)
                                <option value="0" selected>表示</option>
                                <option value="1">非表示</option>
                            @else
                                <option value="0">表示</option>
                                <option value="1" selected>非表示</option>
                            @endif
                        @endif
                    </select>
                </div>
                <div class="form-content">
                    <button type="submit" class="btn btn-primary">
                        変更する
                    </button>
                </div>
            </form>
            <div class="back-btn-container">
                <a href="{{ route('showCutMenu') }}" class="btn btn-link back-btn">カットメニュー一覧へ</a>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
