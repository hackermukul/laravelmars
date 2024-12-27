<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrievanceRepliesTable extends Migration
{
    public function up()
    {
        Schema::create('grievance_replies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grievance_id');
            $table->unsignedBigInteger('registrations_id'); // Reference to users table            
            $table->integer('management_id')->length(11)->nullable();
            $table->longText('reply');
            $table->string('attachment')->nullable(); // For file attachments
            $table->boolean('status')->default(0)->nullable();
            $table->foreignId('added_by')->nullable()->index();
            $table->integer('updated_by')->length(11)->nullable();
            $table->tinyInteger('is_deleted')->default(0)->nullable();
            $table->integer('is_deleted_by')->length(11)->nullable();
            $table->timestamp('is_deleted_on')->nullable();
            $table->timestamps();
            $table->foreign('grievance_id')->references('id')->on('grievances')->onDelete('cascade');
            $table->foreign('registrations_id')->references('id')->on('registrations')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('grievance_replies');
    }
}
