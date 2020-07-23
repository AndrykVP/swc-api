<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scanner_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('entry_id');
            $table->unsignedBigInteger('user_id');
            $table->string('old_type')->nullable();
            $table->string('new_type')->nullable();
            $table->string('old_name')->nullable();
            $table->string('new_name')->nullable();
            $table->string('old_owner')->nullable();
            $table->string('new_owner')->nullable();
            $table->json('old_position')->nullable();
            $table->json('new_position')->nullable();
            $table->timestamp('previously_seen')->nullable();
            $table->timestamp('recently_seen')->nullable();
            $table->timestamp('updated_at')->nullable();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('entry_id')->references('id')->on('scanner_entries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scanner_logs');
    }
}
