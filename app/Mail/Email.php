<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class Email extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;
    public $pdfPath;

    /**
     * Create a new message instance.
     */
    public function __construct($mailData, $pdfPath)
    {
        $this->mailData = $mailData;
        $this->pdfPath = $pdfPath;
    }

    public function build()
    {
        return $this->subject('Surat Penetapan Lokasi PPL')
            ->view('admin.surat.email')
            ->attach($this->pdfPath, [
                'as' => 'surat_ppl.pdf',
                'mime' => 'application/pdf',
            ]);
    }
}
