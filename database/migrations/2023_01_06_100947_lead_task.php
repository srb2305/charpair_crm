<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LeadTask extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('lead_task', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->date('date_from')->nullable();
            $table->date('date_to')->nullable();
            $table->integer('lead_from')->nullable();
            $table->integer('lead_to')->nullable();
            $table->integer('status')->nullable();
            $table->string('description')->nullable();
            $table->date('task_start_date')->nullable();
            $table->date('task_end_date')->nullable();
            $table->string('assign_by')->nullable();
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
        Schema::dropIfExists('lead_task');

    }
}
