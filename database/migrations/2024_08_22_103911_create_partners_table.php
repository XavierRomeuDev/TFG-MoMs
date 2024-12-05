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
        Schema::create('partners', function (Blueprint $table) {
            $table->id(); // Creates an auto-incrementing UNSIGNED BIGINT (primary key)
            $table->string('name'); // Name of the partner
            $table->string('image'); // URL or path to the image
            $table->string('country'); // Country of the partner
            $table->string('website'); // Website URL of the partner
            $table->text('description_en'); // Description in English
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
