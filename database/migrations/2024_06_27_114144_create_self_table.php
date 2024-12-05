<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelfTable extends Migration
{
    public function up()
    {
        Schema::create('self', function (Blueprint $table) {
            $table->id();
            $table->string('title_en')->nullable();
            $table->string('title_it')->nullable();
            $table->string('title_es')->nullable();
            $table->string('title_cat')->nullable();
            $table->string('title_gb')->nullable();
            $table->string('title_gr')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('self');
    }
}
