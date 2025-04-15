<?php
namespace App\Mail;

use App\Models\Upload;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UploadNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $upload;

    public function __construct(Upload $upload)
    {
        \Log::info('Mailable Data: ', $upload->toArray());
        $this->upload = $upload;
    }
    

    public function build()
    {
        return $this->subject('Notifikasi Produk Baru')
                    ->view('emails.uploadNotification');  // Memastikan ini menggunakan HTML view
    }
    
}
