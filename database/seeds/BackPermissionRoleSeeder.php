<?php

use Illuminate\Database\Seeder;

class BackPermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('back_permission_role')->insert([
			['role_id'=>1,'permission_id'=>1,],
			['role_id'=>1,'permission_id'=>2,],
			['role_id'=>1,'permission_id'=>3,],
			['role_id'=>1,'permission_id'=>4,],
		]);
    }
}
