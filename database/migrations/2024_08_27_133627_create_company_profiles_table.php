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
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->integer('id')->primary()->index();
            $table->string('name',250);
            $table->string('unique_name',250)->nullable();
            $table->string('email')->unique();
            $table->string('website',250)->nullable();
            $table->string('header_image',250)->nullable();
            $table->string('first_name',250)->nullable();
            $table->string('last_name',250)->nullable();
            $table->string('logo',250)->nullable();
            $table->text('address1')->nullable();
            $table->string('header_color',250)->nullable();
            $table->string('footer_color',250)->nullable();
            $table->string('pincode',50)->nullable();
            $table->string('mobile_no',50)->nullable();
            $table->string('alt_mobile_no',50)->nullable();
            $table->text('short_description')->nullable();
            $table->string('is_display')->default(1);;
            $table->string('slug',250);
            $table->integer('position')->length(11)->nullable();
            $table->boolean('status')->default(0);
            $table->foreignId('added_by')->nullable()->index();
            $table->integer('updated_by')->length(11)->nullable();
            $table->tinyInteger('is_deleted')->default(0); // `birth_day` tinyint(3)
            $table->integer('is_deleted_by')->length(11)->nullable();
            $table->timestamp('is_deleted_on')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->integer('country_id')->length(11)->nullable();
            $table->integer('state_id')->length(11)->nullable();
            $table->integer('city_id')->length(11)->nullable();
            $table->timestamps();
        });
    }

   
};
