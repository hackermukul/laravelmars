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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name',250);
            $table->string('slug',250);
            $table->string('image', 2048)->nullable();
            $table->text('content')->nullable();
            $table->integer('position')->length(11)->nullable();
            $table->boolean('status')->default(0);
            $table->foreignId('added_by')->nullable()->index();
            $table->integer('updated_by')->length(11)->nullable();
            //$table->timestamp('updated_on')->nullable(); 
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
        Schema::dropIfExists('categories');
    }
};
