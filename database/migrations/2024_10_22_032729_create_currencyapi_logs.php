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
        Schema::create('currencyapi_logs', function (Blueprint $table) {
            $table->id();
            $table->string('api_name')->index();
            $table->string('end_point')->index();
            $table->string('api_url');
            $table->string('method');
            $table->json('request')->nullable();
            $table->json('response')->nullable();
            $table->string('response_status')->nullable();
            $table->text('exception')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('currencyapi_logs');
    }
};
