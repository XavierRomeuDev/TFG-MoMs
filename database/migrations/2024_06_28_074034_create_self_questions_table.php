<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelfQuestionsTable extends Migration
{
    public function up()
    {
        Schema::create('self_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('self_id')->constrained('self')->onDelete('cascade');
            $table->string('question_en')->nullable();
            $table->string('question_it')->nullable();
            $table->string('question_es')->nullable();
            $table->string('question_cat')->nullable();
            $table->string('question_bg')->nullable();
            $table->string('question_gr')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('self_questions');
    }
}
