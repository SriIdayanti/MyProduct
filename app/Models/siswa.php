<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswas'; // Nama tabel
    protected $primaryKey = 'siswaID'; // Menentukan primary key
    public $incrementing = true; // Jika menggunakan bigIncrements
    protected $keyType = 'int'; // Tipe data primary key, bisa 'int' atau 'string' tergantung pada jenis primary key Anda
    
    protected $fillable = [
      
        'name',
        'jeniskelamin',
        'image',
        'tanggallahir',
        'alamat',
        'email',
        'nisn',
    ];

    protected $dates = ['tanggallahir']; // Menentukan kolom tanggal

    
}