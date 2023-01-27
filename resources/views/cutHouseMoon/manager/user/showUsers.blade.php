<?php
    require_once(__DIR__ . '/../../../public/functions.php');
    $pageTitle = '会員一覧 - カットハウスムーン';
?>

@include('layouts.header')

<section id="show-users">
    <div class="wrapper">
        <div class="content-container">
            <h2>お客様一覧</h2>
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>名前</th>
                        <th>ヨミ</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0  ?>
                    @foreach ($users as $user)
                    <?php $i++ ?>
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['kana'] }}</td>
                        <td>
                            <form action="{{ route('showUserDetail') }}" method="get">
                                <input type="hidden" name="id" value="{{ $user['user_id'] }}">
                                <button type="submit" class="btn btn-link">詳細</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="links">
                {!! $users->links() !!}
            </div>
            <div class="back-btn-container">
                <a href="{{ route('manager') }}" class="btn btn-link back-btn">管理者ページへ</a>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
