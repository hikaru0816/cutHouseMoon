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
    display INT(1) NOT NULL,
    PRIMARY KEY (id)
);

-- テーブル：menusにデータ挿入
INSERT INTO menus (name, price, display) VALUES
    ('大人カット', 2800, 0),
    ('高校生カット', 2500, 0),
    ('中学生カット', 2000, 0),
    ('小学生カット', 1800, 0),
    ('パーマ', 6300, 0),
    ('パンチ', 6300, 0),
    ('ヘアダイ', 5300, 0);

-- テーブル：reservationsを作成
CREATE TABLE reservations (
    id INT(11) AUTO_INCREMENT NOT NULL,
    user_id INT(11) NOT NULL,
    menu_id INT(11) NOT NULL,
    date DATE NOT NULL,
    start_time_id INT(11) NOT NULL,
    status INT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

-- テーブル：start_timesを作成
CREATE TABLE start_times (
    id INT(11) AUTO_INCREMENT NOT NULL,
    time TIME NOT NULL UNIQUE,
    PRIMARY KEY (id)
);

-- テーブル：start_timesにデータ挿入
INSERT INTO start_times (time) VALUES
    ('09:00:00'),
    ('09:30:00'),
    ('10:00:00'),
    ('10:30:00'),
    ('11:00:00'),
    ('11:30:00'),
    ('12:00:00'),
    ('12:30:00'),
    ('13:00:00'),
    ('13:30:00'),
    ('14:00:00'),
    ('14:30:00'),
    ('15:00:00'),
    ('15:30:00'),
    ('16:00:00'),
    ('16:30:00'),
    ('17:00:00'),
    ('17:30:00'),
    ('18:00:00');

-- テーブル：usersを作成
CREATE TABLE users (
    user_id INT(11) AUTO_INCREMENT NOT NULL,
    name VARCHAR(100) NOT NULL,
    kana VARCHAR(100) NOT NULL,
    tel VARCHAR(11) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    role INT(1) NOT NULL DEFAULT 0,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(255),
    PRIMARY KEY (user_id)
);

-- テーブル：usersにデータ挿入
INSERT INTO users (name, kana, tel, email, role, password) VALUES
    ('管理者', 'カンリシャ', '0956478861', 'manager@email.com', 1, '$2y$10$PdjkdUU3Mix97soyiTG1QOsiPcOgiXCL/X70pD2C4ofuFqTgntT22'),
    ('テストユーザー1', 'テストユーザー1', '08012345678', 'customer001@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6'),
    ('テストユーザー2', 'テストユーザー2', '08012345678', 'customer002@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6');
    ('テストユーザー3', 'テストユーザー3', '08012345678', 'customer003@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6');
    ('テストユーザー4', 'テストユーザー4', '08014345678', 'customer004@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6');
    ('テストユーザー5', 'テストユーザー5', '08015345678', 'customer005@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6');
    ('テストユーザー6', 'テストユーザー6', '08016345678', 'customer006@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6');
    ('テストユーザー7', 'テストユーザー7', '08017345678', 'customer007@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6');
    ('テストユーザー8', 'テストユーザー8', '08018345678', 'customer008@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6');
    ('テストユーザー9', 'テストユーザー9', '08019345678', 'customer009@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6');
    ('テストユーザー10', 'テストユーザー10', '08011345678', 'customer010@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6');
    ('テストユーザー11', 'テストユーザー11', '08012345678', 'customer011@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6');
    ('テストユーザー12', 'テストユーザー12', '08012345678', 'customer012@email.com', 0, '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6');

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
