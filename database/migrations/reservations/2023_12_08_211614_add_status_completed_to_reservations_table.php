<?php

use Illuminate\Database\Events\StatementPrepared;
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
        // Usando SQL bruto para MySQL no Migration
        DB::statement("ALTER TABLE reservations MODIFY COLUMN status ENUM('active', 'expired', 'canceled', 'completed') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverter a coluna status para o estado anterior
        DB::statement("ALTER TABLE reservations MODIFY COLUMN status ENUM('active', 'expired', 'canceled') NOT NULL");
    }
};
