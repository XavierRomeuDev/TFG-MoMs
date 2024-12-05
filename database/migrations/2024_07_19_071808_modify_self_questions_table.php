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
            $table->string('answer')->required();
            $table->string('options')->required();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('self_questions', function (Blueprint $table) {
            $table->dropColumn('answer');
            $table->dropColumn('options');
        });
    }
};
