<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'jabatan', 'jenis_kelamin', 
        'alamat', 'nik', 'image', 'phone', 'tempat_lahir', 'tanggal_lahir', 'nama_lengkap'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relasi dengan tabel Upload (User memiliki banyak Upload)
     */
    public function uploads()
    {
        return $this->hasMany(Upload::class, 'userID', 'id'); 
    }
}
