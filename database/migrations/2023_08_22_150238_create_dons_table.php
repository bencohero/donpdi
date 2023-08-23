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
        Schema::create('dons', function (Blueprint $table) {
            $table->id();
            $table->string('numeroTransaction');
            $table->double('montant');
            $table->tinyText('token');
            $table->enum('status', ['pending', 'completed', 'canceled', 'failed'])->default('pending');
            $table->foreignId('id_donateur')->constrained(table: 'users', indexName: 'dons_users_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dons');
    }
};
