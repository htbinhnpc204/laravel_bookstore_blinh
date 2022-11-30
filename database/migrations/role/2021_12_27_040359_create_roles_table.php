<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('roleName');
            $table->timestamps();
        });

        DB::table('roles')->insert(
            array(
                'roleName' => 'Admin'
            )
        );
        DB::table('roles')->insert(
            array(
                'roleName' => 'Employee'
            )
        );
        DB::table('roles')->insert(
            array(
                'roleName' => 'User'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('roles');
    }
}
