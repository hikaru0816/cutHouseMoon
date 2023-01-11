<?php
    $pageTitle = 'カットメニュー編集 - カットハウスムーン';
?>
@include('layouts.header')

<section id="edit-cut-menu">
    <div class="wrapper">
        <h2>カットメニュー編集</h2>
        <div class="content-container">
            <h4>現在</h4>
            <table>
                <thead>
                    <tr>
                        <th>メニュー名</th>
                        <th>料金</th>
                        <th>状態</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $menu['name'] }}</td>
                        <td>{{ number_format($menu['price']) }}円</td>
                        @if ($menu['display'] === 0)
                            <td>
                                表示中
                            </td>
                        @else
                            <td>
                                非表示中
                            </td>
                        @endif
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="content-container edit">
            <h4>メニュー編集</h4>
            <form action="{{ route('editCutMenuComplet') }}" method="post" novalidate>
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
                    <label for="price" class="form-label">料金</label>
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
