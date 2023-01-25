<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StartTimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $times = [
            '09:00:00',
            '09:30:00',
            '10:00:00',
            '10:30:00',
            '11:00:00',
            '11:30:00',
            '12:00:00',
            '12:30:00',
            '13:00:00',
            '13:30:00',
            '14:00:00',
            '14:30:00',
            '15:00:00',
            '15:30:00',
            '16:00:00',
            '16:30:00',
            '17:00:00',
            '17:30:00',
            '18:00:00',
        ];
        foreach ($times as $time) {
            DB::table('start_times')->insert([
                'time' => $time,
            ]);
        }
    }
}
