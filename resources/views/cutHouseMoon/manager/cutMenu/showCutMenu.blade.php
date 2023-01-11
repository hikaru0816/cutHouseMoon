<?php
    $pageTitle = 'カットメニュー編集 - カットハウスムーン';
?>
@include('layouts.header')

<section id="show-cut-menu">
    <div class="wrapper">
        <h2>カットメニュー一覧</h2>
        <div class="content-container">
            <table>
                <thead>
                    <tr>
                        <th>メニュー名</th>
                        <th>料金</th>
                        <th>状態</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menus as $menu)
                        <tr>
                            <td>{{ $menu['name'] }}</td>
                            <td>{{ number_format($menu['price']) }}円</td>
                            @if ($menu['display'] === 0)
                                <td>表示中</td>
                            @else
                                <td>非表示中</td>
                            @endif
                            <td>
                                <form action="{{ route('editCutMenuFirst') }}" method="get">
                                    <input type="hidden" name="id" value="{{ $menu['id'] }}">
                                    <button type="submit" class="btn btn-link">編集</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('deleteCutMenu') }}" method="get">
                                    <input type="hidden" name="id" value="{{ $menu['id'] }}">
                                    <button type="submit" class="btn btn-link delete-menu-btn" value="{{ $menu['name'] }}">削除</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="add-menu-btn">
                <a href="{{ route('addCutMenuFirst') }}" class="btn btn-primary">メニュー追加</a>
            </div>
            <div class="back-btn-container">
                <a href="{{ route('manager') }}" class="btn btn-link back-btn">管理者ページへ</a>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
