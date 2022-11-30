<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = [
            ['role_id' => 1, 'email' => 'hoyen@gmail.com', 'name' => 'Hồ Yên', 'user' => 'hoyen', 'password' => bcrypt('admin')],
            ['role_id' => 3, 'email' => 'binhho@gmail.com', 'name' => 'Bình Hồ', 'user' => 'binhho', 'password' => bcrypt('asddsa')],
        ];
        DB::table('users')->insert($users);
    }
}
