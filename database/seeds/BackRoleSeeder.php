<?php

use Illuminate\Database\Seeder;

class BackRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('back_roles')->insert([
			['name'=>'admin','description'=>'超级管理员'],
			['name'=>'guest','description'=>'游客'],
		]);
    }
}
