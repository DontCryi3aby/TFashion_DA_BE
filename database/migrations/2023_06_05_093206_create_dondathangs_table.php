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
        Schema::create('dondathangs', function (Blueprint $table) {
            $table->id();
            $table->string('hovaten');
            $table->string('diachi');
            $table->string('tinh');
            $table->string('quanhuyen');
            $table->string('phuongxa');
            $table->integer('sdt');
            $table->string('thongtinbosung');
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
        Schema::dropIfExists('dondathangs');
    }
};
