<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Add if using factories

class Penilaian extends Model
{
    use HasFactory; // Use HasFactory if you're using model factories

    protected $primaryKey = 'penilaianID'; 
    protected $table = 'penilaians'; // Ensure the table name matches the migration

    protected $fillable = ['uploadID', 'rating', 'komentar','tanggal']; // Add fillable fields

    // Relationship with Upload
    public function upload()
    {
        return $this->belongsTo(Upload::class, 'uploadID');
    }

    // Event to handle status update
    protected static function booted()
    {
        static::created(function ($penilaian) {
            // Access related Upload data
            $upload = $penilaian->upload;

            // Update status automatically if upload exists
            if ($upload) {
                $upload->update(['status' => 'Dilihat']);
            }
        });
    }
    // Model Upload.php
public function penilaians()
{
    return $this->hasMany(Penilaian::class);
}

}
