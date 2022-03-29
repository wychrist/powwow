<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCevEmailPendingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cev_email_pending', function (Blueprint $table) {
            $table->id();
            $table->string('token');
            $table->string('email');
            $table->string('callback', 512);
            $table->json('payload')->nullable();
            $table->dateTime('expire_at');

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
        Schema::dropIfExists('cev_email_pending');
    }
}
