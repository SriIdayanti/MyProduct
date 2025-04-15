<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload', function (Blueprint $table) {
            $table->bigIncrements('uploadID');        
            $table->string('name');
            $table->unsignedBigInteger('user_id'); // Sesuaikan posisi kolom
            $table->text('descriptionproduct');
            $table->string('image')->nullable();
            $table->string('status')->default('Belum di lihat');
            $table->date('tanggaldibuat'); // Date of the incident
            $table->string('namaproduk'); // Phone number
            $table->string('link'); // Phone number
            $table->string('kategoriproduk'); // Complaint category
            $table->text('komentar')->nullable(); // Response to the complaint
            $table->timestamps(); // Ensure this is inside the create closure
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('upload');
    }
}
