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
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->string('short_title');
            $table->text('long_title');
            $table->string('slug');
            $table->bigInteger('price');
            $table->bigInteger('price_per_meter')->nullable();
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->integer('land_sale_area')->nullable();
            $table->integer('building_sale_area')->nullable();
            $table->text('facilities')->nullable();
            $table->enum('water', ['PDAM', 'SUMUR', 'SUMUR BOR', 'OTHER'])->nullable();
            $table->integer('electricity')->nullable();
            $table->enum('warranty', ['Y', 'N'])->nullable();
            $table->string('floor_material')->nullable();
            $table->string('building_material')->nullable();
            $table->string('orientation')->nullable();
            $table->date('listed_on')->nullable();
            $table->longText('description')->nullable();
            $table->enum('is_publish', ['N', 'Y'])->default('N');
            $table->enum('admin_approval', ['PENDING', 'APPROVED', 'REJECTED'])->default('PENDING');
            $table->enum('is_available', ['N', 'Y'])->default('Y');
            $table->string('youtube_code')->nullable();
            $table->integer('views')->default(0);
            $table->longText('maps_location')->nullable();
            $table->string('image');
            $table->unsignedBigInteger('agen_id');
            $table->unsignedBigInteger('property_transaction_id');
            $table->unsignedBigInteger('property_type_id');
            $table->unsignedBigInteger('property_certificate_id');
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('sub_district_id');
            $table->string('address')->nullable();

            $table->foreign('agen_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade');
            $table->foreign('property_transaction_id')
                ->references('id')
                ->on('property_transactions')
                ->onUpdate('cascade');
            $table->foreign('property_type_id')
                ->references('id')
                ->on('property_types')
                ->onUpdate('cascade');
            $table->foreign('property_certificate_id')
                ->references('id')
                ->on('property_certificates')
                ->onUpdate('cascade');
            $table->foreign('province_id')
                ->references('id')
                ->on('provinces')
                ->onUpdate('cascade');
            $table->foreign('district_id')
                ->references('id')
                ->on('districts')
                ->onUpdate('cascade');
            $table->foreign('sub_district_id')
                ->references('id')
                ->on('sub_districts')
                ->onUpdate('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
