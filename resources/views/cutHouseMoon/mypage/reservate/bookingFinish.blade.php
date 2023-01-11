<?php
    $pageTitle = '予約完了 - カットハウスムーン';
?>
@include('layouts.header')

<section id="customer-name">
    <div class="wrapper">
        <p>{{ Auth::user()->name }} 様</p>
    </div>
</section>

<section id="booking">
    <div class="wrapper">
        <h2>予約完了</h2>
        <div class="content-container">
            <p>予約が完了しました。</p>
            <p>
                予約の変更・キャンセルに関してはお電話をお願いいたします。
            </p>
        </div>
    </div>
</section>

@include('layouts.footer')
