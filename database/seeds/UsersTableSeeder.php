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
