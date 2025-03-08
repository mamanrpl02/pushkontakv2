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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('noHp', 15);
            $table->string('email');
            $table->string('password');
            $table->string('tokenAkun');
            $table->string('gambar')->nullable();
            $table->timestamps(); // Pastikan ini ada
            $table->rememberToken();
        });

        if (!Schema::hasTable('sessions')) {
            Schema::create('sessions', function (Blueprint $table) {
                $table->string('id')->primary();
                $table->unsignedBigInteger('members_id')->nullable();
                $table->string('ip_address', 45)->nullable();
                $table->text('members_agent')->nullable();
                $table->longText('payload');
                $table->integer('last_activity');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
