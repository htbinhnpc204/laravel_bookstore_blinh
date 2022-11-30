<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories = [
            ['category_name' => 'Tiểu thuyết'],
            ['category_name' => 'Ngôn tình'],
            ['category_name' => 'Kinh tế'],
            ['category_name' => 'Chính trị'],
            ['category_name' => 'Tâm lý'],
        ];

        DB::table('categories')->insert($categories);
    }
}
