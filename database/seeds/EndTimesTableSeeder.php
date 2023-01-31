<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EndTimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "time" => "00:00:00",
                "status" => 1,
            ],
            [
                "time" => "00:30:00",
                "status" => 1,
            ],
            [
                "time" => "01:00:00",
                "status" => 1,
            ],
            [
                "time" => "01:30:00",
                "status" => 1,
            ],
            [
                "time" => "02:00:00",
                "status" => 1,
            ],
            [
                "time" => "02:30:00",
                "status" => 1,
            ],
            [
                "time" => "03:00:00",
                "status" => 1,
            ],
            [
                "time" => "03:30:00",
                "status" => 1,
            ],
            [
                "time" => "04:00:00",
                "status" => 1,
            ],
            [
                "time" => "04:30:00",
                "status" => 1,
            ],
            [
                "time" => "05:00:00",
                "status" => 1,
            ],
            [
                "time" => "05:30:00",
                "status" => 1,
            ],
            [
                "time" => "06:00:00",
                "status" => 1,
            ],
            [
                "time" => "06:30:00",
                "status" => 1,
            ],
            [
                "time" => "07:00:00",
                "status" => 1,
            ],
            [
                "time" => "07:30:00",
                "status" => 1,
            ],
            [
                "time" => "08:00:00",
                "status" => 1,
            ],
            [
                "time" => "08:30:00",
                "status" => 1,
            ],
            [
                "time" => "09:00:00",
                "status" => 0,
            ],
            [
                "time" => "09:30:00",
                "status" => 0,
            ],
            [
                "time" => "10:00:00",
                "status" => 0,
            ],
            [
                "time" => "10:30:00",
                "status" => 0,
            ],
            [
                "time" => "11:00:00",
                "status" => 0,
            ],
            [
                "time" => "11:30:00",
                "status" => 0,
            ],
            [
                "time" => "12:00:00",
                "status" => 0,
            ],
            [
                "time" => "12:30:00",
                "status" => 0,
            ],
            [
                "time" => "13:00:00",
                "status" => 0,
            ],
            [
                "time" => "13:30:00",
                "status" => 0,
            ],
            [
                "time" => "14:00:00",
                "status" => 0,
            ],
            [
                "time" => "14:30:00",
                "status" => 0,
            ],
            [
                "time" => "15:00:00",
                "status" => 0,
            ],
            [
                "time" => "15:30:00",
                "status" => 0,
            ],
            [
                "time" => "16:00:00",
                "status" => 0,
            ],
            [
                "time" => "16:30:00",
                "status" => 0,
            ],
            [
                "time" => "17:00:00",
                "status" => 0,
            ],
            [
                "time" => "17:30:00",
                "status" => 0,
            ],
            [
                "time" => "18:00:00",
                "status" => 0,
            ],
            [
                "time" => "18:30:00",
                "status" => 0,
            ],
            [
                "time" => "19:00:00",
                "status" => 0,
            ],
            [
                "time" => "19:30:00",
                "status" => 0,
            ],
            [
                "time" => "20:00:00",
                "status" => 1,
            ],
            [
                "time" => "20:30:00",
                "status" => 1,
            ],
            [
                "time" => "21:00:00",
                "status" => 1,
            ],
            [
                "time" => "21:30:00",
                "status" => 1,
            ],
            [
                "time" => "22:00:00",
                "status" => 1,
            ],
            [
                "time" => "22:30:00",
                "status" => 1,
            ],
            [
                "time" => "23:00:00",
                "status" => 1,
            ],
            [
                "time" => "23:30:00",
                "status" => 1,
            ],
        ];

        foreach ($data as $time) {
            DB::table('end_times')->insert([
                'time' => $time["time"],
                'status' => $time["status"],
            ]);
        }
    }
}
