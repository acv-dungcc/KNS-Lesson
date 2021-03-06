<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserThematicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_thematics', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('thematic_id');

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('thematic_id')->references('id')->on('thematics')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'thematic_id']);
             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_thematics');
    }
}
