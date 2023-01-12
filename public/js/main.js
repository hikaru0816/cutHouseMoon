'use strict';

// headerのbottom位置取得
// let headerTop = $('.header').offset().top;
// let headerHeight = $('.header').outerHeight();
// let headerBottom = headerTop + headerHeight;
// console.log(headerTop);
// console.log(headerHeight);
// console.log(headerBottom);
// ページトップボタン
// $(window).on('scroll', function(){
//     let headerTop = $('.header').offset().top;
//     let headerHeight = $('.header').outerHeight();
//     let headerBottom = headerTop + headerHeight;
//     console.log(headerTop);
//     console.log(headerHeight);
//     console.log(headerBottom);
// });

$('#vdbanner').on('onReady', function(){
    alert('追加');
});

// .topの高さを指定
$('.top').css('height', `calc(100vh - ${headerBottom}px)`);

// 画像スライド
$('.img-container img:nth-child(n+2)').hide();
setInterval(function() {
    $(".img-container img:first-child").fadeOut(4000);
    $(".img-container img:nth-child(2)").fadeIn(4000);
    $(".img-container img:first-child").appendTo(".img-container");
}, 5000);

// ページトップボタン
$(window).on('scroll', function(){
    let scroll = $(window).scrollTop();
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

// レスポンシブメニュー開閉
$('#hambarger').on('change', function(){
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
            window.location.href = 'bookingFirst';
        }
        // editReservationFirstへ戻る
        if (path.includes('editReservation')) {
            let id = $('#reservation-id').val();
            window.location.href = `editReservationFirst?id=${id}`;
        }
        // addReservationSecondへ戻る
        if (path.includes('addReservation')) {
            let id = $('#user-id').val();
            window.location.href = `addReservationSecond?id=${id}`;
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
