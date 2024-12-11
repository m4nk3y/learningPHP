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
        Schema::create('libraries', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("address");
            $table->string("contact_number");

        });

        Schema::create('books', function (Blueprint $table) {
            $table->id()->primary();
            $table->string("title");
            $table->string("author");
            $table->year("publication_year");
            $table->string("genre");
            $table->unsignedBigInteger("library_id");

            //constraint
            $table->foreign("library_id")->references("id")->on("libraries")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libraries');
        Schema::dropIfExists('books');
    }
};
