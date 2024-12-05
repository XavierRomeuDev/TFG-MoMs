<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('self_questions', function (Blueprint $table) {
            $table->dropColumn('question_it');
            $table->dropColumn('question_es');
            $table->dropColumn('question_cat');
            $table->dropColumn('question_bg');
            $table->dropColumn('question_gr');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
