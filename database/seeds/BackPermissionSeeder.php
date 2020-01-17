<?php

use Illuminate\Database\Seeder;

class BackPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('back_permissions')->insert([
        	['name'=>'system','description'=>'系统管理'],
        	['name'=>'post','description'=>'文档管理'],
			['name'=>'topic','description'=>'专题管理'],
			['name'=>'notice','description'=>'通知管理'],
        ]);
    }
}
