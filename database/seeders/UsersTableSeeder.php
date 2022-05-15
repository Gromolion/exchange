<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['name' => 'Админ', 'email' => 'admin@admin.com', 'password' => bcrypt('admin'), 'is_admin' => 1],
            ['name' => 'test', 'email' => 'test@test.com', 'password' => bcrypt('20035363'), 'is_admin' => 0],
            ['name' => 'gromolion', 'email' => 'gromolion@gromolion.com', 'password' => bcrypt('20035363'), 'is_admin' => 0]
        ]);
    }
}
