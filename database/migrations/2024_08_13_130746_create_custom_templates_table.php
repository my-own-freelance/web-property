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
        Schema::create('custom_templates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('logo_header_color')->nullable();
            $table->string('topbar_color')->nullable();
            $table->string('sidebar_color')->nullable();
            $table->string('bg_color')->nullable();
            $table->string('web_title')->nullable();
            $table->string('web_logo')->nullable();
            $table->string('web_logo_white')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->longText('web_description')->nullable();
            $table->longText('maps_location')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_templates');
    }
};
