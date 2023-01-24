<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WaitingStatuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [
                "number" => 0,
                "select" => 0,
            ],
            [
                "number" => 1,
                "select" => 1,
            ],
            [
                "number" => 2,
                "select" => 0,
            ],
            [
                "number" => 3,
                "select" => 0,
            ],
            [
                "number" => 4,
                "select" => 0,
            ],
            [
                "number" => 5,
                "select" => 0,
            ],
        ];

        foreach ($statuses as $status) {
            DB::table('waiting_statuses')->insert([
                'waiting_number' => $status['number'],
                'waiting_select' => $status['select'],
            ]);
        }
    }
}
