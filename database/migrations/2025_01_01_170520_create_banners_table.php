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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // name
            $table->string('image')->nullable(); // image
            $table->string('link')->nullable(); // link
            $table->string('title1')->nullable(); // title1
            $table->string('title2')->nullable(); // title2
            $table->string('title3')->nullable(); // title3
            $table->string('title4')->nullable(); // title4
            $table->timestamp('added_on')->nullable(); // added_on
            $table->unsignedBigInteger('added_by')->nullable(); // added_by
            $table->timestamp('updated_on')->nullable(); // updated_on
            $table->unsignedBigInteger('updated_by')->nullable(); // updated_by
            $table->boolean('is_deleted')->default(false); // is_deleted
            $table->timestamp('is_deleted_on')->nullable(); // is_deleted_on
            $table->unsignedBigInteger('is_deleted_by')->nullable(); // is_deleted_by
            $table->string('banner_for')->nullable(); // banner_for
            $table->boolean('status')->default(true); // status
            $table->integer('position')->default(0); // position

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
