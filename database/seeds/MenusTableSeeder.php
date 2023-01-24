<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            [
                "name" => "大人カット",
                "price" => "2800",
                "display" => "0",
            ],
            [
                "name" => "高校生カット",
                "price" => "2500",
                "display" => "0",
            ],
            [
                "name" => "中学生カット",
                "price" => "2000",
                "display" => "0",
            ],
            [
                "name" => "小学生カット",
                "price" => "1800",
                "display" => "0",
            ],
            [
                "name" => "パーマ",
                "price" => "6300",
                "display" => "0",
            ],
            [
                "name" => "パンチ",
                "price" => "6300",
                "display" => "0",
            ],
            [
                "name" => "ヘアダイ",
                "price" => "5300",
                "display" => "0",
            ],
        ];

        foreach ($menus as $menu) {
            DB::table('menus')->insert([
                'name' => $menu["name"],
                'price' => $menu["price"],
                'display' => $menu["display"],
            ]);
        }
    }
}
