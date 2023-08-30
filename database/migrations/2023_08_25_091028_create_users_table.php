<?php

use App\Models\Adress;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum("role", ['donateur', 'admin'])->default('donateur');;
            $table->boolean('isActive')->default(true);
            $table->string('name');
            $table->string('firstname')->nullable(true);
            $table->string('lastname')->nullable(true);
            $table->string('phoneNumber')->nullable(true);
            $table->foreignIdFor(Adress::class, 'adress_id');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

