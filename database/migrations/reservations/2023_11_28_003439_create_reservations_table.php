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
    {//'user_id', 'book_id', 'reservation_date', 'expiration_date', 'status'
        if(!Schema::hasTable("reservations")) {
            Schema::create('reservations', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('book_id')->constrained()->onDelete('cascade');
                $table->timestamp('reservation_date')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->timestamp('expiration_date')->nullable();
                $table->enum('status', ['active', 'expired', 'canceled'])->default('active');
                $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->timestamp('updated_at')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
