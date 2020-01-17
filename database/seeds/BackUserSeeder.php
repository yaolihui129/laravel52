<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BackUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('back_users')->insert([
            'name'=>'admin',
            'password'=>bcrypt('admin'),
        ]);
    }
}
