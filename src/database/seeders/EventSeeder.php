<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('events')->insert([
            [
                'event_id' => 1,
                'category_id' => 1,
                'title' => 'Laravelのもくもく会',
                'date' => '2021-11-07',
                'start_time' => '15:00:00',
                'end_time' => '19:00:00',
                'contents' => 'テスト詳細',
                'entry_fee' => 100,
                'created_at' => '2022-05-05',
                'updated_at' => '2022-05-06',
            ],
            [
                'event_id' => 2,
                'category_id' => 2,
                'title' => 'Javaのもくもく会',
                'date' => '2021-11-07',
                'start_time' => '11:00:00',
                'end_time' => '17:00:00',
                'contents' => 'Javaの詳細',
                'entry_fee' => 500,
                'created_at' => '2022-05-05',
                'updated_at' => '2022-05-06',
            ],
            [
                'event_id' => 3,
                'category_id' => 3,
                'title' => 'TypeScriptのテスト',
                'date' => '2021-11-08',
                'start_time' => '17:00:00',
                'end_time' => '20:00:00',
                'contents' => 'TypeScriptの詳細',
                'entry_fee' => 100,
                'created_at' => '2022-05-05',
                'updated_at' => '2022-05-06',
            ],
        ]);
    }
}
