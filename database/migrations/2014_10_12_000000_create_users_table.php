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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->string('code')->unique();
            $table->string('password');
            $table->enum('role', ['owner', 'agen'])->default('agen');
            $table->enum('gender', ['L', 'P'])->nullable();
            $table->string('city_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('is_active', ['Y', 'N'])->default('N');
            $table->string('position')->nullable();
            $table->string('caption')->nullable();
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
