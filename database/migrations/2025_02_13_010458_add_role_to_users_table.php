<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoleToUsersTable extends Migration

{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'petugas', 'user'])->default('user');
            $table->string('jabatan')->nullable()->after('role');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan'])->nullable()->after('jabatan');
            $table->string('alamat')->nullable()->after('jenis_kelamin');
            $table->string('nik')->unique()->nullable()->after('alamat');
            $table->string('image')->nullable();
            $table->string('phone')->nullable()->after('nik');
            $table->string('tempat_lahir')->nullable()->after('phone');
            $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            $table->string('nama_lengkap')->nullable()->after('tanggal_lahir');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role','jabatan', 'jenis_kelamin', 'alamat','nik','image','phone','tempat_lahir','tanggal_lahir','nama_lengkap']);
        });
    }
}
