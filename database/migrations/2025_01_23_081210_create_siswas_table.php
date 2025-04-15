<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->bigIncrements('siswaID');
            $table->string('nisn');
            $table->string('name');
            $table->string('jeniskelamin');
            $table->string('image')->nullable();
            $table->date('tanggallahir'); // Tanggal lahir
            $table->text('alamat'); // Alamat
            $table->string('email'); // Email

            $table->timestamps(); // Pastikan ini ada untuk kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswas');
    }
}