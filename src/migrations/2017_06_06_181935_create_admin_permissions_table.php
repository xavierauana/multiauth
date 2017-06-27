<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create("admin_permissions", function (Blueprint $table) {
            $table->increments('id');
            $table->string("label");
            $table->string("code")->unique;
            $table->timestamps();
        });
        Schema::create("admin_permission_admin_role", function (Blueprint $table) {
            $table->integer('admin_role_id')->unsigned();
            $table->foreign('admin_role_id')->references('id')->on('admin_roles')->onDelete('cascade');

            $table->integer('admin_permission_id')->unsigned();
            $table->foreign('admin_permission_id')->references('id')->on('admin_permissions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('admin_permission_admin_role');
        Schema::dropIfExists('admin_permissions');
    }
}
