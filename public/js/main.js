'use strict';

// topの高さ設定
// XREAの広告が追加されたタイミングで再計算
let observer = new MutationObserver(function(){
    calcTopHeight();
});
const body = document.querySelector('body');
const config = {
    childList: true,
}
observer.observe(body, config);
// 画面がリサイズされたら再計算
$(window).on('resize', function(){
    calcTopHeight();
});
// top高さ計算関数
function calcTopHeight() {
    // headerのbottom位置取得
    let headerTop = $('.header').offset().top;
    let headerHeight = $('.header').outerHeight();
    let headerBottom = headerTop + headerHeight;
    // .top, .small-navの高さを指定
    $('.top').css('height', `calc(100vh - ${headerBottom}px)`);
    $('.small-nav').css({
        'height': `calc(100vh - ${headerBottom}px)`,
        'top': `${headerBottom}px`,
    });
}

// 画像スライド
$('.img-container img:nth-child(n+2)').hide();
setInterval(function() {
    $(".img-container img:first-child").fadeOut(4000);
    $(".img-container img:nth-child(2)").fadeIn(4000);
    $(".img-container img:first-child").appendTo(".img-container");
}, 5000);

// スクロールによるイベント
$(window).on('scroll', function(){
    let scroll = $(window).scrollTop();
    // ページトップへボタン
    let line = 450;
    if (scroll >= line) {
        $('.go-to-page-top').css({
            'bottom': '10px',
            'opacity': '1',
        });
    } else {
        $('.go-to-page-top').css({
            'bottom': '-50px',
            'opacity': '0',
            'transition': 'all .5s',
        });
    }
});
// スクロールによるイベント
$(window).on('scroll', function(){
    let scroll = $(window).scrollTop();
    // .small-navの高さ調整
    let headerTop = $('.header').offset().top;
    let headerHeight = $('.header').outerHeight();
    let headerBottom = headerTop + headerHeight;
    let headerBottomOffsetOnScreen = headerBottom - scroll;
    if (headerBottom - 70 >= scroll) {
        $('.small-nav').css({
            'height': `calc(100vh - ${headerBottomOffsetOnScreen}px)`,
            'top': `${headerBottomOffsetOnScreen}px`,
        });
        $('.fixed-header').css({
            'display': `none`,
        });
    } else {
        $('.small-nav').css({
            'height': `calc(100vh - 70px)`,
            'top': `70px`,
        });
        $('.fixed-header').css({
            'display': `inline`,
        });
    }
});

// .headerと.fixed-headerの
//チェックボックス（type='checkbox'）の値が変更されたとき
$("input[type='checkbox']").on('change', function(){
    //クリックされたチェックボックスのvalue値を変数に格納
    let cbv = $(this).val();
    //もしクリックされたチェックボックスがチェックされていたら・・・
    if( $(this).prop('checked')){
        //同じvalueを持つチェックボックスは全部チェックを入れる
        $("input:checkbox[value='" + cbv + "']").prop('checked',true);
    }else{
        //逆にチェックが外れていたら全部チェックを外す。
        $("input:checkbox[value='" + cbv + "']").prop('checked',false);
    }
});

// レスポンシブメニュー開閉
$('#hambarger').on('change', function(){
    $('.small-nav').toggleClass('active');
});
$('#fixed-hambarger').on('change', function(){
    $('.small-nav').toggleClass('active');
});
// aタグ押したらメニュー閉じる
$('.small-nav a').on('click', function(){
    $('#hambarger').removeAttr("checked").prop("checked", false).change();
});
// メニューの左側を押したら閉じる
$('.small-menu-left').on('click', function(){
    $('#hambarger').removeAttr("checked").prop("checked", false).change();
});

// 月曜日・第一日曜日・お盆・正月に予約できないようにする
$("#date").on("change", function(){
    // 休みの日を配列で保存
    let vacations = [
        '01-01',
        '01-02',
        '01-03',
        '01-04',
        '08-13',
        '08-14',
        '08-15',
    ];
    //内容を取得
    let val = $(this).val();
    // 〇月〇日を取得
    let monthDay = val.substr(-5);
    // 選択した日がvacationsと被っているかのチェック
    let checkVacations = (vacations.includes(monthDay));
    //曜日を取得できる形に整形
    let date = new Date(val);
    //曜日を取得　0:日曜日　1:月曜日
    let dayOfWeek = date.getDay();
    // 〇日の取得
    let day = val.substr(-2);
    // 第一日曜日のチェック
    let checkFirstSunday = ((day <= 7) && (dayOfWeek == 0))
    //
    if((dayOfWeek == 1) || checkFirstSunday || checkVacations){
        //アラート
        alert("その日はお休みのため選択できません。");
        //inputを空に
        // 現在のパスを取得
        let path = location.pathname;
        // bookingFirstへ戻る
        if (path.includes('booking')) {
            window.location.href = 'bookingSecond';
        }
        // editReservationFirstへ戻る
        if (path.includes('editReservation')) {
            window.location.href = `editReservationSecond`;
        }
        // addReservationThirdへ戻る
        if (path.includes('addReservation')) {
            window.location.href = `addReservationThird`;
        }
    }
});

// メニュー削除ボタン押下時の確認ポップアップ
$('.delete-menu-btn').on('click', function(){
    // カットメニュー名取得
    let name = $(this).val();
    if (!confirm(`${name}を削除しますか?`)) {
        return false;
    }
});

// 会員削除ボタン押下時の確認ポップアップ
$('.delete-user-btn').on('click', function(){
    // 会員名取得
    let name = $(this).val();
    if (!confirm(`${name}様を削除しますか?`)) {
        return false;
    }
});

// 予約の施術済みボタン押下時の確認ポップアップ
$('.finish-reservation').on('click', function(){
    // 会員名取得
    let number = $(this).val();
    if (!confirm(`No.${number}を済にしますか?`)) {
        return false;
    }
});

// ログアウトボタン押下時のポップアップ
$('.logout').on('click', function(){
    alert('ログアウトしました');
});

// 新規予約ボタン押下時の判定
$('.new-reserve').on('click', function(){
    let count = $('.count-of-reservations').val();
    if (count >= 2) {
        alert('予約数の上限に達しています（2件まで予約可能です）')
        return false;
    }
});
