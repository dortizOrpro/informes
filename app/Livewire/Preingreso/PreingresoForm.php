<?php

namespace App\Livewire\Preingreso;

use App\Mail\PreingresoMail;
use App\Services\GenerarPdfPreingresoService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Src\Caja\Application\UseCases\GuardarPreingresoUseCase;
use Src\Calculo\Application\UseCases\CalcularTotalDeudaUseCase;
use Mary\Traits\Toast;
use Src\Calculo\Domain\Enums\TipoCalculo;

class PreingresoForm extends Component
{

    public TipoCalculo $tipoCalculo;
    public $params;
    public $vencimiento;
    public $usuarioId;
    public $deudas;
    public $calculo;
    public $a_pago;
    public $fechaCalculo;
    public $asunto;
    public $para;
    public $emailPreingreso;
    public $copia_nombre;
    public $copia_email;
    public $nota = false;
    public $nota_texto;
    public $motivo;
    public $mostrarCopia = false;

    public $modalPreIngreso = false;

    protected $listeners = ['abrirModal' => 'abrir'];

    public function abrir($data)
    {

        $this->tipoCalculo = TipoCalculo::from((int) $data['tipoCalculo']);;
        $this->params      = $data['params'] ?? null;
        $this->vencimiento = $data['vencimiento'] ?? null;
        $this->usuarioId   = $data['usuarioId'] ?? null;
        $this->deudas      = $data['deudas'] ?? null;
        $this->calculo      = $data['calulo'] ?? null;
        $this->fechaCalculo = $data['fechaCalculo'] ?? null;
        $this->a_pago      = $data['a_pago'] ?? null;


        $this->modalPreIngreso = true;
    }
    public function getEmailIconProperty()
    {
        return $this->emailPreingreso && filter_var($this->emailPreingreso, FILTER_VALIDATE_EMAIL)
            ? 'o-check-circle'
            : null;
    }

    public function pdfPreingreso(GuardarPreingresoUseCase $useCase)
    {

        $uuid = $useCase->run(
            tipoCalculo: $this->tipoCalculo,
            params: $this->params,
            vencimiento: $this->vencimiento,
            fechaCalculo: $this->fechaCalculo,
            usuarioId: 9999,
            deudas: $this->deudas
        );

        $pdf = new GenerarPdfPreingresoService();
        $id_aux = $pdf->pdf($uuid, $this->calculo, $this->a_pago);

        $pdfPath = Storage::disk('pdf')->path("$id_aux.pdf");
        $this->cancel();
        $this->dispatch('preingreso.preingreso-cerrar');
        return response()->download($pdfPath);

        // $this->enviarCorreo($id_aux);
        // $this->cancel();
        // if($correo)
        // {
        //     $this->success('Correo enviado correctamente.', position: 'toast-bottom');
        // }else{
        //     $this->error('Correo no enviado.', position: 'toast-bottom');
        // }
        
    }

    public function enviarCorreo(string $id)
    {
        try {
            
            $pdfPath = Storage::disk('pdf')->path("$id.pdf");

            if (!$this->esCorreoValido($this->emailPreingreso)) {
                return false;
            }

            $mail = Mail::to($this->emailPreingreso);

            if ($this->mostrarCopia && $this->esCorreoValido($this->copia_email)) {
                $mail->cc($this->copia_email);
            }

            $mail->send(new PreingresoMail($id, $pdfPath, $this->a_pago));
            $this->modalPreIngreso = false;

            return true;
        } catch (\Throwable $e) {
            Log::error("Error enviando correo de preingreso: {$e->getMessage()}", [
                'id' => $id,
                'email' => $this->emailPreingreso,
                'stack' => $e->getTraceAsString()
            ]); 

            return false;
        }    
    }

    private function esCorreoValido(?string $correo): bool
    {
        return !empty($correo) && filter_var($correo, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function cancel()
    {
        $this->modalPreIngreso = false;
        $this->para = '';
        $this->emailPreingreso = '';
        $this->copia_nombre = '';
        $this->copia_email = '';
        $this->nota = false;
        $this->nota_texto = '';
        $this->motivo = '';
        $this->mostrarCopia = false;
    }

    public function render()
    {
        return view('livewire.preingreso.form');
    }
}
