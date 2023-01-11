<?php
    $pageTitle = 'ホーム - カットハウスムーン';
?>

@include('layouts.header')

<section class="top">
    <div class="img-container">
        <img src="{{ asset('img/shop01.jpg') }}" alt="店舗イメージ1">
        <img src="{{ asset('img/shop02.jpg') }}" alt="店舗イメージ2">
        <img src="{{ asset('img/shop04.jpg') }}" alt="店舗イメージ4">
    </div>
    <div class="wrapper empty-status">
        <div class="content">
            <p>
                空席：{{ $empty['empty_number'] }}　待ち：{{ $waiting['waiting_number'] }}
            </p>
            <p>（{{ date('Y年n月j日 H時i分') }}現在）</p>
        </div>
    </div>
    <div class="top-message">
        <p>確かな技術と軽快なトークで楽しい時間をご提供!!</p>
        <p>佐世保で20年以上愛されている床屋さんです</p>
    </div>
</section>
<div class="wrapper">
    <section id="about">
        <h2>店舗情報</h2>
        <div class="content-container">
            <img src="{{ asset('img/about2.jpg') }}" alt="外観">
            <div class="about-message">
                <table style="margin-bottom: 20px">
                    <tr>
                        <th>店名</th>
                        <td>カットハウスムーン</td>
                    </tr>
                    <tr>
                        <th>住所</th>
                        <td>長崎県佐世保市小野町55-36</td>
                    </tr>
                    <tr>
                        <th>電話番号</th>
                        <td>0956-47-8861</td>
                    </tr>
                    <tr>
                        <th>営業時間</th>
                        <td>9:00 - 19:00</td>
                    </tr>
                    <tr>
                        <th>定休日</th>
                        <td>第一日曜日・毎週月曜日</td>
                    </tr>
                </table>
                <p>
                    佐世保にある床屋さんです。<br>
                    夫婦で元気に営業しております!<br>
                    理容師歴は30年以上!!<br>
                    お好みのヘアスタイルに仕上げます!!!<br>
                </p>
                <br>
                <p class="rice-mark">
                    ※施術中はマスクを外していただきます。<br>
                    ご理解のほど、よろしくお願いいたします。
                </p>
            </div>
        </div>
    </section>
</div>
<section id="menu">
    <div class="wrapper">
        <div class="content-container">
            <h2>カットメニュー</h2>
            <p class="sub-title">全て税込み価格です。</p>
            <div class="menu-content">
                @foreach ($menus as $menu)
                    <div class="menu-list">
                        <h3>{{ $menu['name'] }}</h3>
                        <p>{{ number_format($menu['price']) }}円</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<section id="access">
    <div class="wrapper">
        <div class="content-container">
            <h2>アクセス</h2>
            <div class="access-content">
                <p>店前に駐車場4台分完備しております。お車にてお越しくださいませ。</p>
                <div id="map">
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTfWbfPG8lVaVtvramNzLwSKtSHt44RwM&callback=initMap&v=weekly" defer></script>
                </div>
            </div>
        </div>
    </div>
</section>

@include('layouts.footer')
