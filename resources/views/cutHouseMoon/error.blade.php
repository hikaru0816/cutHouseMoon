<?php
    $pageTitle = 'エラー - カットハウスムーン';
?>
@include('layouts.header')

<section id="error">
    <div class="wrapper">
        <h2>エラー</h2>
        <div class="content-container">
            <p>{{ $errorMessage }}</p>
        </div>
    </div>
</section>

@include('layouts.footer')
