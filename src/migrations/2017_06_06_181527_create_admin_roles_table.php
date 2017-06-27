<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create("admin_roles", function (Blueprint $table) {
            $table->increments('id');
            $table->string("label");
            $table->string("code")->unique;
            $table->timestamps();
        });
        Schema::create("admin_admin_role", function (Blueprint $table) {
            $table->integer('admin_role_id')->unsigned();
            $table->foreign('admin_role_id')->references('id')->on('admin_roles')->onDelete('cascade');

            $table->integer('admin_id')->unsigned();
            $table->foreign('admin_id')->references('id')->on('administrators')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('admin_admin_role');
        Schema::dropIfExists('admin_roles');
    }
}
