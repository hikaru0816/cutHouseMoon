# カットハウスムーンHP
カットハウスムーンという床屋さんのホームページです。

## 概要
施術の予約をすることができるようにホームページを作成しました。
ユーザーは管理者とお客様に分け、それぞれでログインできます。

## 使い方
お使いのphpMyAdminにて "DB.sql" をインポートをお願いします。
また、必要に応じて、 ".env" の
- DB_USERNAME=
- DB_PASSWORD=
　　の入力をお願いします。

## ログイン情報
### 管理者アカウント
- メールアドレス：manager@cut.house
- パスワード：manager
### お客様アカウント①
- customer001@cut.house
- パスワード：customer
### お客様アカウント②
- customer002@cut.house
- パスワード：customer

## 未ログインでできること
- ホームページの閲覧

## 管理者アカウントでできること
- ホームページの閲覧
- お客様の予約を追加
- お客様の予約を編集
- 空席・待ち状況の更新
- カットメニューの追加・編集
- 会員登録済みのお客様一覧確認

## お客様アカウントでできること
- ホームページの閲覧
- 施術の予約

## 環境
XAMPP/MySQL/PHP/

## データベース
- データベース名：cut_house_moon
- テーブル：全部で6種類
1. empty_statuses
2. menus
3. reservations
4. start_times
5. users
6. waiting_statues

## 更新
- 2023年1月11日：アップロード日
