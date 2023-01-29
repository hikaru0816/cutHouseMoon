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
                "doing_time" => "1.0",
                "display" => "0",
            ],
            [
                "name" => "高校生カット",
                "price" => "2500",
                "doing_time" => "1.0",
                "display" => "0",
            ],
            [
                "name" => "中学生カット",
                "price" => "2000",
                "doing_time" => "1.0",
                "display" => "0",
            ],
            [
                "name" => "小学生カット",
                "price" => "1800",
                "doing_time" => "1.0",
                "display" => "0",
            ],
            [
                "name" => "パーマ",
                "price" => "6300",
                "doing_time" => "2.5",
                "display" => "0",
            ],
            [
                "name" => "パンチ",
                "price" => "6300",
                "doing_time" => "3.0",
                "display" => "0",
            ],
            [
                "name" => "ヘアダイ",
                "price" => "5300",
                "doing_time" => "2.0",
                "display" => "0",
            ],
        ];

        foreach ($menus as $menu) {
            DB::table('menus')->insert([
                'name' => $menu["name"],
                'price' => $menu["price"],
                'doing_time' => $menu["doing_time"],
                'display' => $menu["display"],
            ]);
        }
    }
}
