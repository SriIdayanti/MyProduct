<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UploadNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $upload; // Gantilah dari fileName ke upload (satu objek)

    /**
     * Create a new message instance.
     */
    public function __construct($upload)
    {
        $this->upload = $upload; // Simpan semua data upload ke variabel $upload
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Notifikasi Upload Berhasil')
                    ->view('emails.uploadNotification')
                    ->with([
                        'upload' => $this->upload, // Kirim semua data upload ke Blade
                    ]);
    }
}
