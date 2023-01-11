    </main>
    <a href="#top" class="go-to-page-top">
        ▲ページトップへ
    </a>

    <footer>
        <div class="wrapper">
            <div class="content-container">
                <img src="{{ asset('img/logo.png') }}" alt="ロゴ">
                <div class="footer-shop-info">
                    <p>
                        カットハウスムーン<br>
                        〒858-0965　長崎県佐世保市小野町55-36<br>
                        Tel : 0956-47-8861
                    </p>
                </div>
                <div class="footer-menu">
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
            </div>
            <p class="copyright">
                &copy;2022 カットハウスムーン
            </p>
        </div>
    </footer>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
