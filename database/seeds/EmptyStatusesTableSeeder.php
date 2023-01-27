<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmptyStatusesTableSeeder extends Seeder
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
                "select" => 1,
            ],
            [
                "number" => 1,
                "select" => 0,
            ],
            [
                "number" => 2,
                "select" => 0,
            ],
        ];

        foreach ($statuses as $status) {
            DB::table('empty_statuses')->insert([
                'empty_number' => $status['number'],
                'empty_select' => $status['select'],
            ]);
        }
    }
}
