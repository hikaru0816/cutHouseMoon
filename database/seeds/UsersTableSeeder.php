<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => '管理者',
                'kana' => 'カンリシャ',
                'tel' => '0956478861',
                'email' => 'manager@email.com',
                'role' => 1,
                'password' => '$2y$10$PdjkdUU3Mix97soyiTG1QOsiPcOgiXCL/X70pD2C4ofuFqTgntT22',
            ],
            [
                'name' => 'テストユーザー1',
                'kana' => 'テストユーザー1',
                'tel' => '08012345678',
                'email' => 'customer001@email.com',
                'role' => 0,
                'password' => '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6',
            ],
            [
                'name' => 'テストユーザー2',
                'kana' => 'テストユーザー2',
                'tel' => '08012345678',
                'email' => 'customer002@email.com',
                'role' => 0,
                'password' => '$2y$10$drjeaLhzJN7Y/c4RGX2H0uB.Qz.SyA2O76ko4jlxfdaZ98ZOg2Bk6',
            ],
            [
                'name' => '川島永嗣',
                'kana' => 'カワシマエイジ',
                'tel' => '00000000000',
                'email' => 'kawashima@email.com',
                'role' => 0,
                'password' => '$2y$10$PdjkdUU3Mix97soyiTG1QOsiPcOgiXCL/X70pD2C4ofuFqTgntT22',
            ],
            [
                'name' => '権田修一',
                'kana' => 'ゴンダシュウイチ',
                'tel' => '00000000000',
                'email' => 'gonda@email.com',
                'role' => 0,
                'password' => '$2y$10$PdjkdUU3Mix97soyiTG1QOsiPcOgiXCL/X70pD2C4ofuFqTgntT22',
            ],
            [
                'name' => '長友佑都',
                'kana' => 'ナガトモユウト',
                'tel' => '00000000000',
                'email' => 'nagatomo@email.com',
                'role' => 0,
                'password' => '$2y$10$PdjkdUU3Mix97soyiTG1QOsiPcOgiXCL/X70pD2C4ofuFqTgntT22',
            ],
            [
                'name' => '吉田麻也',
                'kana' => 'ヨシダマヤ',
                'tel' => '00000000000',
                'email' => 'yoshida@email.com',
                'role' => 0,
                'password' => '$2y$10$PdjkdUU3Mix97soyiTG1QOsiPcOgiXCL/X70pD2C4ofuFqTgntT22',
            ],
            [
                'name' => '酒井宏樹',
                'kana' => 'サカイヒロキ',
                'tel' => '00000000000',
                'email' => 'sakai@email.com',
                'role' => 0,
                'password' => '$2y$10$PdjkdUU3Mix97soyiTG1QOsiPcOgiXCL/X70pD2C4ofuFqTgntT22',
            ],
            [
                'name' => '谷口彰悟',
                'kana' => 'タニグチショウゴ',
                'tel' => '00000000000',
                'email' => 'taniguchi@email.com',
                'role' => 0,
                'password' => '$2y$10$PdjkdUU3Mix97soyiTG1QOsiPcOgiXCL/X70pD2C4ofuFqTgntT22',
            ],
            [
                'name' => '柴崎岳',
                'kana' => 'シバサキガク',
                'tel' => '00000000000',
                'email' => 'shibasaki@email.com',
                'role' => 0,
                'password' => '$2y$10$PdjkdUU3Mix97soyiTG1QOsiPcOgiXCL/X70pD2C4ofuFqTgntT22',
            ],
            [
                'name' => '遠藤航',
                'kana' => 'エンドウワタル',
                'tel' => '00000000000',
                'email' => 'endo@email.com',
                'role' => 0,
                'password' => '$2y$10$PdjkdUU3Mix97soyiTG1QOsiPcOgiXCL/X70pD2C4ofuFqTgntT22',
            ],
            [
                'name' => '伊藤純也',
                'kana' => 'イトウジュンヤ',
                'tel' => '00000000000',
                'email' => 'ito@email.com',
                'role' => 0,
                'password' => '$2y$10$PdjkdUU3Mix97soyiTG1QOsiPcOgiXCL/X70pD2C4ofuFqTgntT22',
            ],
            [
                'name' => '山根視来',
                'kana' => 'ヤマネミキ',
                'tel' => '00000000000',
                'email' => 'yamane@email.com',
                'role' => 0,
                'password' => '$2y$10$PdjkdUU3Mix97soyiTG1QOsiPcOgiXCL/X70pD2C4ofuFqTgntT22',
            ],
            [
                'name' => '浅野琢磨',
                'kana' => 'アサノタクマ',
                'tel' => '00000000000',
                'email' => 'asano@email.com',
                'role' => 0,
                'password' => '$2y$10$PdjkdUU3Mix97soyiTG1QOsiPcOgiXCL/X70pD2C4ofuFqTgntT22',
            ],
            [
                'name' => '南野拓実',
                'kana' => 'ミナミノタクミ',
                'tel' => '00000000000',
                'email' => 'minamino@email.com',
                'role' => 0,
                'password' => '$2y$10$PdjkdUU3Mix97soyiTG1QOsiPcOgiXCL/X70pD2C4ofuFqTgntT22',
            ],
            [
                'name' => '守田英正',
                'kana' => 'モリタヒデマサ',
                'tel' => '00000000000',
                'email' => 'morita@email.com',
                'role' => 0,
                'password' => '$2y$10$PdjkdUU3Mix97soyiTG1QOsiPcOgiXCL/X70pD2C4ofuFqTgntT22',
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'name' => $user['name'],
                'kana' => $user['kana'],
                'tel' => $user['tel'],
                'email' => $user['email'],
                'role' => $user['role'],
                'password' => $user['password'],
            ]);
        }
    }
}
