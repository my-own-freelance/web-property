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
            $table->longText('web_description')->nullable();
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
