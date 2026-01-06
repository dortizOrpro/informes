<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PreingresoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $preingreso;
    public $pdfPath;
    public $deudor;
    public $total;
    public $uuid;
    public $nota;
    public $a_pago;

    public function __construct($preingreso, $pdfPath, $a_pago)
    {
        $this->preingreso = $preingreso;
        $this->pdfPath = $pdfPath;
        $this->a_pago = $a_pago;
    }

    public function build()
    {
        return $this->subject("Liquidación Deuda Previsional N° {$this->preingreso}")
                    ->view('emails.preingreso')
                    ->attach($this->pdfPath, [
                        'as' => "liquidacion-{$this->preingreso}.pdf",
                        'mime' => 'application/pdf',
                    ]);
    }
}
