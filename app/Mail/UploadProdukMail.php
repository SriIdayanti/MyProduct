<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UploadProdukMail extends Mailable
{
    use Queueable, SerializesModels;

    public $uploads;

    public function __construct($uploads)
    {
        $this->uploads = $uploads;
    }

    public function build()
    {
        return $this->subject('Laporan Daftar Upload Produk Siswa')
                    ->view('emails.upload-produk');
    }
}
