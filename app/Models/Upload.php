<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;
    protected $primaryKey = 'uploadID'; 
    protected $table = 'upload';
    protected $fillable = [
        'name', 
        'descriptionproduk', 
        'image', 
        'status', 
     
        'userID',
        'tanggaldibuat',
        'namaproduk',
        'kategoriproduk',
        'tanggapanproduk',
        'link'
        
    ];

   // app/Models/Upload.php
public function penilaians()
{
    return $this->hasMany(Penilaian::class, 'uploadID');
}


public function name()
{
    return $this->belongsTo(User::class, 'name', 'name');
}
public function user()
{
    return $this->belongsTo(User::class, 'userID', 'id');
}



 
    
    
}
