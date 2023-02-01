SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- データベース：woogamihikaru上で作業することを宣言
USE woogamihikaru;

-- テーブル：empty_statusesを作成
CREATE TABLE empty_statuses (
    id INT(11) AUTO_INCREMENT NOT NULL,
    empty_number INT(1) NOT NULL,
    empty_select INT(1) NOT NULL,
    PRIMARY KEY (id)
);

-- テーブル：empty_statusesにデータ挿入
INSERT INTO empty_statuses (empty_number, empty_select) VALUES
    (0, 1),
    (1, 0),
    (2, 0);

-- テーブル：menusを作成
CREATE TABLE menus (
    id INT(11) AUTO_INCREMENT NOT NULL,
    name VARCHAR(100) NOT NULL UNIQUE,
    price INT(11) NOT NULL,
    doing_time FLOAT NOT NULL,
    display INT(1) NOT NULL,
    PRIMARY KEY (id)
);

-- テーブル：menusにデータ挿入
INSERT INTO menus (name, price, doing_time,  display) VALUES
    ('大人カット', 2800, 1.0,  0),
    ('高校生カット', 2500, 1.0, 0),
    ('中学生カット', 2000, 1.0, 0),
    ('小学生カット', 1800, 1.0, 0),
    ('パーマ', 6300, 2.5, 0),
    ('パンチ', 6300, 3.0, 0),
    ('ヘアダイ', 5300, 2.0, 0);

-- テーブル：reservationsを作成
CREATE TABLE reservations (
    id INT(11) AUTO_INCREMENT NOT NULL,
    no INT NOT NULL,
    user_id INT(11) NOT NULL,
    menu_id INT(11) NOT NULL,
    remaining_time INT NOT NULL,
    head INT(1) NOT NULL,
    date DATE NOT NULL,
    start_time_id INT(11) NOT NULL,
    status INT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

-- テーブル：start_timesを作成
CREATE TABLE start_times (
    id INT(11) AUTO_INCREMENT NOT NULL,
    time TIME NOT NULL UNIQUE,
    status INT(1) NOT NULL,
    PRIMARY KEY (id)
);

-- テーブル：start_timesにデータ挿入
INSERT INTO start_times (time, status) VALUES
    ('00:00:00', 1),
    ('00:30:00', 1),
    ('01:00:00', 1),
    ('01:30:00', 1),
    ('02:00:00', 1),
    ('02:30:00', 1),
    ('03:00:00', 1),
    ('03:30:00', 1),
    ('04:00:00', 1),
    ('04:30:00', 1),
    ('05:00:00', 1),
    ('05:30:00', 1),
    ('06:00:00', 1),
    ('06:30:00', 1),
    ('07:00:00', 1),
    ('07:30:00', 1),
    ('08:00:00', 1),
    ('08:30:00', 1),
    ('09:00:00', 0),
    ('09:30:00', 0),
    ('10:00:00', 0),
    ('10:30:00', 0),
    ('11:00:00', 0),
    ('11:30:00', 0),
    ('12:00:00', 0),
    ('12:30:00', 0),
    ('13:00:00', 0),
    ('13:30:00', 0),
    ('14:00:00', 0),
    ('14:30:00', 0),
    ('15:00:00', 0),
    ('15:30:00', 0),
    ('16:00:00', 0),
    ('16:30:00', 0),
    ('17:00:00', 0),
    ('17:30:00', 0),
    ('18:00:00', 0),
    ('18:30:00', 0),
    ('19:00:00', 1),
    ('19:30:00', 1),
    ('20:00:00', 1),
    ('20:30:00', 1),
    ('21:00:00', 1),
    ('21:30:00', 1),
    ('22:00:00', 1),
    ('22:30:00', 1),
    ('23:00:00', 1),
    ('23:30:00', 1);


-- テーブル：usersを作成
CREATE TABLE users (
    user_id INT(11) AUTO_INCREMENT NOT NULL,
    name VARCHAR(100) NOT NULL,
    kana VARCHAR(100) NOT NULL,
    search VARCHAR(225) NOT NULL,
    tel VARCHAR(11) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    role INT(1) NOT NULL DEFAULT 0,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(255),
    PRIMARY KEY (user_id)
);

-- テーブル：usersにデータ挿入
INSERT INTO users (name, kana, search, tel, email, role, password) VALUES
    ('管理者', 'カンリシャ', '管理者(カンリシャ)', '0956478861', 'manager@email.com', 1, '$2y$10$PdjkdUU3Mix97soyiTG1QOsiPcOgiXCL/X70pD2C4ofuFqTgntT22'),
    ('テストユーザー1', 'テストユーザー1', 'テストユーザー1(テストユーザー1)', '08012345678', 'customer001@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6'),
    ('テストユーザー2', 'テストユーザー2', 'テストユーザー2(テストユーザー2)', '08012345678', 'customer002@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6'),
    ('川島永嗣', 'カワシマエイジ', '川島永嗣(カワシマエイジ)', '08012345678', 'kawashima@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6'),
    ('権田修一', 'ゴンダシュウイチ', '権田修一(ゴンダシュウイチ)','08014345678', 'gonda@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6'),
    ('長友佑都', 'ナガトモユウト', '長友佑都(ナガトモユウト)','08015345678', 'nagatomo@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6'),
    ('吉田麻也', 'ヨシダマヤ', '吉田麻也(ヨシダマヤ)','08016345678', 'yoshida@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6'),
    ('酒井宏樹', 'サカイヒロキ', '酒井宏樹(サカイヒロキ)','08017345678', 'sakai@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6'),
    ('谷口彰悟', 'タニグチショウゴ', '谷口彰悟(タニグチショウゴ)','08018345678', 'taniguchi@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6'),
    ('柴崎岳', 'シバサキガク', '柴崎岳(シバサキガク)','08019345678', 'shibasaki@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6'),
    ('遠藤航', 'エンドウワタル', '遠藤航(エンドウワタル)','08011345678', 'endo@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6'),
    ('伊藤純也', 'イトウジュンヤ', '伊藤純也(イトウジュンヤ)', '08012345678', 'ito@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6'),
    ('山根視来', 'ヤマネミキ', '山根視来(ヤマネミキ)', '08012345678', 'yamane@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6'),
    ('浅野琢磨', 'アサノタクマ', '浅野琢磨(アサノタクマ)', '08012345678', 'asano@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6'),
    ('南野拓実', 'ミナミノタクミ', '南野拓実(ミナミノタクミ)', '08012345678', 'minamino@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6'),
    ('守田英正', 'モリタヒデマサ', '守田英正(モリタヒデマサ)', '08012345678', 'morita@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6'),
    ('鎌田大地', 'カマダダイチ', '鎌田大地(カマダダイチ)', '08012345678', 'kamada@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6'),
    ('板倉滉', 'イタクラコウ', '(イタクラコウ)', '08012345678', 'itakura@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6'),
    ('町野修斗', 'マチノシュウト', '町野修斗(マチノシュウト)', '08012345678', 'machino@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6'),
    ('相馬勇紀', 'ソウマユウキ', '相馬勇紀(ソウマユウキ)', '08012345678', 'soma@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6'),
    ('三苫薫', 'ミトマカオル', '三苫薫(ミトマカオル)', '08012345678', 'mitoma@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6'),
    ('前田大然', 'マエダダイゼン', '前田大然(マエダダイゼン)', '08012345678', 'maeda@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6'),
    ('堂安律', 'ドウアンリツ', '堂安律(ドウアンリツ)', '08012345678', 'doan@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6'),
    ('上田綺世', 'ウエダアヤセ', '上田綺世(ウエダアヤセ)', '08012345678', 'ueda@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6'),
    ('田中碧', 'タナカアオ', '田中碧(タナカアオ)', '08012345678', 'tanaka@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6'),
    ('冨安健洋', 'トミヤスタケヒロ', '冨安健洋(トミヤスタケヒロ)', '08012345678', 'tomiyasu@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6'),
    ('久保建英', 'クボタケフサ', '久保建英(クボタケフサ)', '08012345678', 'kubo@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6'),
    ('本田圭佑', 'ホンダケイスケ', '本田圭佑(ホンダケイスケ)', '08012345678', 'honda@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6'),
    ('中田英寿', 'ナカタヒデトシ', '中田英寿(ナカタヒデトシ)', '08012345678', 'nakata@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6'),
    ('高原直泰', 'タカハラナオヒロ', '高原直泰(タカハラナオヒロ)', '08012345678', 'takahara@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6'),
    ('シュミットダニエル', 'シュミットダニエル', 'シュミットダニエル(シュミットダニエル)', '08012345678', 'schmidt@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6');

-- テーブル：waiting_statusesを作成
CREATE TABLE waiting_statuses (
    id INT(1) AUTO_INCREMENT NOT NULL,
    waiting_number INT(1) NOT NULL,
    waiting_select INT(1) NOT NULL,
    PRIMARY KEY (id)
);

-- テーブル：waiting_statusesにデータ挿入
INSERT INTO waiting_statuses (waiting_number, waiting_select) VALUES
    (0, 1),
    (1, 0),
    (2, 0),
    (3, 0),
    (4, 0),
    (5, 0);
