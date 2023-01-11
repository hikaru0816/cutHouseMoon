<?php

// YYYY-MM-DD形式から〇曜日を取得
function getDayOfWeek($date) {
    $dayOfWeek = ['日', '月', '火', '水', '木', '金', '土'];
    return $dayOfWeek[date('w', strtotime(str_replace('-', '' , $date)))];
}
