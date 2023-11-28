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
        if(!Schema::hasTable("books")) {
            Schema::create('books', function (Blueprint $table) {
                $table->id();
                $table->string('title')->nullable(false);
                $table->string('author')->nullable(false);
                $table->string('isbn', 13)->nullable(false)->unique();
                $table->year('year_published')->nullable(false);
                $table->integer('quantity')->default(0);
                $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->timestamp('updated_at');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
