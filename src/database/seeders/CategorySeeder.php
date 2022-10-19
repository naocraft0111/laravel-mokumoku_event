<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'category_id' => 1,
                'category_name' => 'Laravel',
                'created_at' => '2022-05-05',
                'updated_at' => '2022-05-06',
            ],
            [
                'category_id' => 2,
                'category_name' => 'Java',
                'created_at' => '2022-05-05',
                'updated_at' => '2022-05-06',
            ],
            [
                'category_id' => 3,
                'category_name' => 'TypeScript',
                'created_at' => '2022-05-05',
                'updated_at' => '2022-05-06',
            ],
        ]);
    }
}
