<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblNinjavan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ninjavan', function (Blueprint $table) {
            $table->bigIncrements('ninjavan_id');
            $table->integer('seller_id');
            $table->string('ninja_client_name', 191);
            $table->string('ninja_client_id', 191);
            $table->string('ninja_client_secret', 191);
            $table->tinyInteger('ninja_active')->default(1);
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
        Schema::dropIfExists('ninjavan');
    }
}
