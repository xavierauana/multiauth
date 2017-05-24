<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('administrators', function (Blueprint $table) {
            $table->increments('id');

            foreach (config('admin.table') as $item) {
                $method = $item['type'];
                $query = $table->$method($item['name']);

                if (isset($item['unique']) and $item['unique']) {
                    $query = $query->unique();
                }
                if (isset($item['index']) and $item['index']) {
                    $query = $query->index();
                }
                if (isset($item['default']) and $item['default']) {
                    $query = $query->default($item['default']);
                }
                if (isset($item['nullable']) and $item['nullable']) {
                    $query = $query->nullable();
                }

            }
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('administrators');
    }
}
