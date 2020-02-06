<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionAndRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 角色表
		Schema::create('back_roles', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name', 30)->default('');
			$table->string('description', 100)->default('');
			$table->timestamps();
		});

		// // 权限表
		// Schema::create('back_permissions', function (Blueprint $table) {
		// 	$table->increments('id');
		// 	$table->string('name', 30)->default('');
		// 	$table->string('description', 100)->default('');
		// 	$table->timestamps();
		// });

		// 权限角色
		Schema::create('back_permission_role', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('role_id');
			$table->integer('permission_id');
			$table->timestamps();
		});

		// 用户角色表
		Schema::create('back_role_user', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('role_id');
			$table->integer('user_id');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('back_roles');
		Schema::drop('back_permissions');
		Schema::drop('back_permission_role');
		Schema::drop('back_role_user');
    }
}
