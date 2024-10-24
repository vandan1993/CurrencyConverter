<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_report_request', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users','id')->onDelete('cascade'); // Foreign key
            $table->string('currency');
            $table->string('source');
            $table->string('report_name');
            $table->string('report_interval');
            $table->dateTime('report_request_time');
            $table->string('report_status')->default('pending');
            $table->dateTime('report_processing_time')->nullable();
            $table->json('quote_data')->nullable();
            $table->string('reason')->nullable();
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
        Schema::dropIfExists('user_report_request');
    }
};
