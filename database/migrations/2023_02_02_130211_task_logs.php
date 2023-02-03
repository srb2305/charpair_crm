<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaskLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('task_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('task_id')->nullable();
            $table->string('title')->nullable();
            $table->text('old_value')->nullable();
            $table->text('new_value')->nullable();
            $table->integer('added_by')->nullable();
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
         Schema::dropIfExists('task_logs');
    }
}
