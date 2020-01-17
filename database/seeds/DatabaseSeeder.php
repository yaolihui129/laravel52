<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
		$this->call(BackUserSeeder::class);
		$this->call(BackRoleSeeder::class);
		$this->call(BackPermissionSeeder::class);
		$this->call(BackRoleUserSeeder::class);
		$this->call(BackPermissionRoleSeeder::class);
    }
}
