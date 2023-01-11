<?php
    $pageTitle = 'カットメニュー追加 - カットハウスムーン';
?>
@include('layouts.header')

<section id="add-cut-menu">
    <div class="wrapper">
        <h2>カットメニュー追加</h2>
        <div class="content-container">
            <form action="{{ route('addCutMenuComplete') }}" method="post" novalidate>
                @csrf
                <div class="form-content">
                    <label for="name" class="form-label">メニュー名</label>
                    @if($errors->has('name'))
                        @foreach($errors->get('name') as $message)
                        <p class="validation-error-message">
                            {{ $message }}
                        </p>
                        @endforeach
                    @endif
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="例）〇〇カット" class="form-control">
                </div>
                <div class="form-content">
                    <label for="price" class="form-label">料金</label>
                    @if($errors->has('price'))
                        @foreach($errors->get('price') as $message)
                        <p class="validation-error-message">
                            {{ $message }}
                        </p>
                        @endforeach
                    @endif
                    <input id="price" type="number" name="price" value="{{ old('price') }}" required autofocus placeholder="例）5000（数字のみ入力）" class="form-control">
                </div>
                <div class="form-content">
                    <label for="display" class="form-label">状態</label>
                    @if($errors->has('display'))
                        @foreach($errors->get('display') as $message)
                        <p class="validation-error-message">
                            {{ $message }}
                        </p>
                        @endforeach
                    @endif
                    <select name="display" id="display" class="form-select">
                        @if ((old('display') === '未選択') || (old('display') === ''))
                            <option value="未選択" hidden selected>選択してください</option>
                            <option value=0>表示</option>
                            <option value=1>非表示</option>
                        @elseif (old('display') === 0)
                            <option value=0 selected>表示</option>
                            <option value=1>非表示</option>
                        @elseif (old('display') === 1)
                            <option value=0>表示</option>
                            <option value=1 selected>非表示</option>
                        @else
                            <option value="未選択" hidden selected>選択してください</option>
                            <option value=0>表示</option>
                            <option value=1>非表示</option>
                        @endif
                    </select>
                </div>
                <div class="form-content">
                    <button type="submit" class="btn btn-primary">
                        追加する
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
