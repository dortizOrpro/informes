<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use ZipArchive;

class RendicionesPreviredService
{
    /**
     * Genera un archivo de texto plano con el contenido recibido.
     *
     * @param array $lineas
     * @return string Ruta del archivo
     */
    // public function generarArchivo(): string
    // {
    //     $lineas = [];

    //     $rendiciones = DB::table('paso.rendicion')->get();

    //     foreach ($rendiciones as $index => $rendicion) {
    //         if ($index === 0) continue; // si quieres omitir el primer registro

    //         $lineas[] = $this->generarHeader($rendicion);
    //         $lineas[] = $this->generarAntecedentes($rendicion);

    //         $afiliados = DB::table('paso.rendicion_detalle')
    //             ->where('letra', $rendicion->letra_comp)
    //             ->where('folio_ingreso', $rendicion->folio_ingreso)
    //             ->get();

    //         foreach ($afiliados as $afiliado) {
    //             $lineas[] = $this->generarDetalle($afiliado);
    //         }

    //         $lineas[] = $this->generarResumen($rendicion, $afiliados);
    //     }

    //     // Ruta y nombre del archivo
    //     $filePath = storage_path('app/public/rendiciones.txt');

    //     // Crear o sobrescribir el archivo
    //     $file = fopen($filePath, 'w');

    //     foreach ($lineas as $linea) {
    //         fwrite($file, $linea . "\r\n"); // agrega salto de línea
    //     }

    //     fclose($file);

    //     return $filePath; // retorna la ruta del archivo generado
    // }

    public function generarArchivo(): string    
    {
        $lineasDetalle = [];
        $lineasAbonos = [];

        $rendiciones = [];
        $fecha = Carbon::now()->format('Ymd');
        $hora = Carbon::now()->format('Hi');
        //todo 
         $lineasAbonos[] = $this->primeraLineaAbonosAgrupados($rendiciones); 


        $lineasDetalle[] = $this->generarHeader($rendiciones);
        $lineasDetalle[] = $this->generarAntecedentes($rendiciones);

        // $afiliados = DB::table('paso.rendicion_detalle')
        //                 ->where('letra', $rendicion->letra_comp)
        //                 ->where('folio_ingreso', $rendicion->folio_ingreso)
        //                 ->get();

        $afiliado = [];
        $lineasDetalle[] = $this->generarDetalle($afiliado);

        $lineasDetalle[] = $this->generarResumen($rendiciones, $afiliado);
        $lineasAbonos[] = $this->detalleAbonosAgrupados($rendiciones); 
        

        $filePathDetalle = storage_path('app/public/rendiciones_detalle.txt');
        //todo 
        $filePathAbonos  = storage_path('app/public/abonos_agrupados.txt');

        file_put_contents($filePathDetalle, implode("\r\n", $lineasDetalle));
        //todo 
        file_put_contents($filePathAbonos, implode("\r\n", $lineasAbonos));

        

        $zipPath = storage_path('app/public/rendiciones.zip');
        $zip = new ZipArchive();
        $zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        $zip->addFile($filePathDetalle, 'PDREC_'.$fecha.'_'.$hora.'.txt');
        //todo 
        $zip->addFile($filePathAbonos, 'CDBCO_'.$fecha.'_'.$hora.'.txt');

        $zip->close();

        if (file_exists($filePathDetalle)) unlink($filePathDetalle);
        //todo 
        if (file_exists($filePathAbonos)) unlink($filePathAbonos);

        return $zipPath;

        // return [
        //     'detalle' => $filePathDetalle,
        //     'abonos'  => $filePathAbonos
        // ];
    }


    /**
     * Descarga un archivo previamente generado.
     *
     * @param string $ruta
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    // public function descargarArchivo(string $ruta)
    // {
    //     return Storage::disk('public')->download($ruta);
    // }


    public function generarHeader($rendicion): string
    {

        [$rutNumero, $dv] = explode('-', '76973037-0');
        $rutNumero = ltrim($rutNumero, '0'); // elimina ceros a la izquierda
        $anioPago = '2025';
        $tipoRegistro   = '1'; // siempre 1
        $folio          = str_pad('16474', 12, '0', STR_PAD_LEFT);
        $nombreTransfer = str_pad(substr('HOGARDELARGAE', 0, 50), 50, ' '); 
        $tipoPago       = '1'; // por definir: 1,2,3
        $declaracionForzada= '1'; // 1 = NO 
        $fechaOperacion = Carbon::parse('20251003')->format('Ymd'); 
        $horaOperacion  = '140000';
        $codigoAFP      = str_pad(1033, 4, '0', STR_PAD_LEFT);
        $rut            = str_pad($rutNumero, 9, '0', STR_PAD_LEFT);
        $dvPagador      = $dv;
        $tipoPagador    = str_pad( '01', 2, '0', STR_PAD_LEFT);
        $correoPagador  = str_pad('', 50, ' ');
        $tipoPlanilla   = '02'; // default normal
        $estadoDeuda    = '01'; // default Pre Judicial
        $tipoDeuda      = '00'; // default Saldo Neto TI
        $filler         = str_pad('', 425, ' ');


        $linea  = $tipoRegistro;
        $linea .= $anioPago;
        $linea .= $folio;
        $linea .= $nombreTransfer;
        $linea .= $tipoPago;
        $linea .= $declaracionForzada;
        $linea .= $fechaOperacion;
        $linea .= $horaOperacion;
        $linea .= $codigoAFP;
        $linea .= $rut;
        $linea .= $dvPagador;
        $linea .= $tipoPagador;
        $linea .= $correoPagador;
        $linea .= $tipoPlanilla;
        $linea .= $estadoDeuda;
        $linea .= $tipoDeuda;
        $linea .= $filler;

        return $linea;
    }

    function generarAntecedentes($rendicion) {
        $rutPartes = explode('-', '76973037-0');
        $rutNum = str_pad($rutPartes[0], 9, '0', STR_PAD_LEFT);
        $rutDv = $rutPartes[1] ?? '0';

        $codigoActividad = str_pad('', 6, ' '); // Código actividad económica
        $direccionCalle = str_pad('AVENIDA PRESIDENTE IBANEZ', 50, ' ');
        $direccionNum = str_pad('724', 10, ' ');
        $direccionDepto = str_pad('', 20, ' ');
        $direccionComuna = str_pad('LINARES', 30, ' ');
        $direccionCiudad = str_pad('LINARES', 30, ' ');
        $direccionRegion = str_pad('07', 2, '0');
        $telefono = str_pad('', 20, ' ');
        $repNombre = str_pad('REVECO ZUNIGA VICTOR HUGO', 50, ' ');
        $repRutNum = str_pad('11372645', 9, '0');
        $repRutDv = '8';
        $cambioRep = '2'; // 1 = cambio, 2 = sin cambio
        $numTrabajadores = str_pad('1', 12, '0', STR_PAD_LEFT);
        $origenFondosCodigo = str_pad('0', 2, '0');
        $origenFondosTexto = str_pad('', 50, ' ');
        $paisOrigen = str_pad('152', 3, '0');
        $folioOriginal = str_pad('0000000004513458', 16, '0');
        $idDeuda = str_pad('56988971', 16, ' ');
        $rit = str_pad('P-298-2025', 12, ' ');
        $tribunal = str_pad('7025', 6, '0');
        $estudio = str_pad('2201', 8, '0');
        $rutEmpresaMandante = str_pad('0', 9, '0');
        $mailAutorizado = '0';
        $filler = str_pad('', 155, ' ');
        
        $linea = '2' .
            str_pad(substr('HOGAR DE LARGA ESTADIA SAGRADA FAMILIA S',0,50),50,' ') .
            $rutNum .
            $rutDv .
            $codigoActividad .
            $direccionCalle .
            $direccionNum .
            $direccionDepto .
            $direccionComuna .
            $direccionCiudad .
            $direccionRegion .
            $telefono .
            $repNombre .
            $repRutNum .
            $repRutDv .
            $cambioRep .
            $numTrabajadores .
            $origenFondosCodigo .
            $origenFondosTexto .
            $paisOrigen .
            $folioOriginal .
            $idDeuda .
            $rit .
            $tribunal .
            $estudio .
            $rutEmpresaMandante .
            $mailAutorizado .
            $filler;

        return $linea;
    }

    function generarDetalle($detalle): string
    {
        $num = fn($value, $length) => str_pad(preg_replace('/\D/', '', $value ?? ''), $length, '0', STR_PAD_LEFT);

        $char = fn($value, $length) => str_pad(substr($value ?? '', 0, $length), $length, ' ', STR_PAD_RIGHT);

        $rutCompleto = '15569919-1' ?? '';
        $rutPartes = explode('-', $rutCompleto);
        $rutNum = $rutPartes[0] ?? '';
        $rutDv = $rutPartes[1] ?? '';

        $linea = '';
        $linea .= '3';
        $linea .= $num($rutNum, 9); // 2-10
        $linea .= $char($rutDv, 1); // 11
        $linea .= $char($this->normalizarTexto('PEREZ' ?? ''), 30);
        $linea .= $char($this->normalizarTexto('SILVA' ?? ''), 30);
        $linea .= $char($this->normalizarTexto('VANESSA YESSENIA' ?? ''), 30);
        $linea .= $num('0', 1); // Nacionalidad, 102
        $linea .= $num(500000 ?? 0, 12); // 103-114
        $linea .= $num(15253 ?? 0, 12); // Cotización Obligatoria, 115-126
        $linea .= $num(7500 ?? 0, 12); // Seguro Invalidez y Sobrevivencia, 127-138
        $linea .= $num( 0, 12); // Cotización Voluntaria Trabajador, 139-150
        $linea .= $num( 0, 12); // Cotización Voluntaria Régimen B, 151-162
        $linea .= $char('', 20); // Nº Contrato APVI, 163-182
        $linea .= $num( 0, 12); // Cuenta de ahorro voluntario, 183-194
        $linea .= $num('1', 12); // Tipo régimen tributario, 195-206
        $linea .= $num('0', 12); // Cotización salud independientes, 207-218
        $linea .= $num('0', 2);  // Código de movimiento de personal, 219-220
        $linea .= $char('0', 8);   // Fecha inicio movimiento, 221-228
        $linea .= $char('0', 8);   // Fecha término movimiento, 229-236
        $linea .= $num('0', 9);   // Rut entidad pagadora subsidios, 237-245
        $linea .= $char('0', 1);   // DV entidad, 246
        $linea .= $num(500000, 12);  // Remuneración trabajador, 247-258
        $linea .= $num('0', 12);  // Monto imponible diario, 259-270
        $linea .= $num('0', 4);   // Total días cubiertos subsidio, 271-274
        $linea .= $num('0', 12);  // Renta imponible sustitutiva, 275-286
        $linea .= $num('0', 12);  // Depósito convenido, 287-298
        $linea .= $num('0', 5);   // Régimen provisional trabajador, 299-303
        $linea .= $num('0', 5);   // Tasa pactada indemnización, 304-308
        $linea .= $num('0', 12);  // Aporte indemnización sustitutiva, 309-320
        $linea .= $num('0', 12);  // Aporte indemnización obligatoria, 321-332
        $linea .= $num('1', 5);   // Número de periodos, 333-337
        $linea .= $char('', 8);   // Periodos desde, 338-345
        $linea .= $char('', 8);   // Periodos hasta, 346-353
        $linea .= $char('', 50);  // Nombre puesto de trabajo, 354-403
        $linea .= $num('0', 3);   // Porcentaje de cotización, 404-406
        $linea .= $num('0', 12);  // Cotización por trabajos pesados, 407-418
        $linea .= $num('0', 12);  // Renta imponible SC, 419-430
        $linea .= $num('0', 12);  // Aporte Trabajadores SC, 431-442
        $linea .= $num('0', 12);  // Aporte Empleadores SC, 443-454
        $linea .= $num('0', 12);  // APV Colectivo Empleador, 455-466
        $linea .= $num('0', 12);  // APV Colectivo Trabajador, 467-478
        $linea .= $char('', 20);  // Nº Contrato APVC, 479-498
        $linea .= $num('0', 2);   // Código movimiento personal APVC, 499-500
        $linea .= $char('', 8);   // Fecha inicio, 501-508
        $linea .= $char('', 8);   // Fecha término, 509-516
        $linea .= $num('0', 16);  // Folio original Deuda AFP, 517-532
        $linea .= $num('0', 8);   // Número de resolución, 533-540
        $linea .= $num('8560', 12);  // Monto por reajuste e intereses, 541-552
        $linea .= $num('0', 12);  // Monto por recargo, 553-564
        $linea .= $num('0', 2);   // Días trabajados, 565-566
        $linea .= $num('0', 2);   // Jornada laboral, 567-568
        $linea .= $num('500000', 12);  // Renta imponible mes anterior, 569-580
    
        return str_pad(substr($linea, 0, 580), 580, ' ');
    }


    function generarResumen($rendicion, $afiliados): string
    {
        $num = fn($value, $length) => str_pad(preg_replace('/\D/', '', $value ?? '0'), $length, '0', STR_PAD_LEFT);
        $char = fn($value, $length) => str_pad(substr($value ?? '', 0, $length), $length, ' ', STR_PAD_RIGHT);
    
        // Sumar totales de rendicion_detalle
        $totalCotObligatoria = 0;
        $totalCotVolAPVI = 0;
        $totalDepositoConvenido = 0;
        $totalAhorroVol = 0;
        $totalIndemnSust = 0;
        $totalIndemnOblig = 0;
        $totalCotPesados = 0;
        $totalCotVolAPVI_B = 0;
        $totalAPVEmp = 0;
        $totalAPVTrab = 0;
        $totalAfiliadoVol = 0;
        $totalSIS = 0;
        $totalFondoPensiones = 0;
    
        foreach ($afiliados as $d) {
            $totalCotObligatoria += $d->total_fondo ?? 0;
            $totalCotVolAPVI += $d->cotvol_monto1 ?? 0;
            $totalCotVolAPVI_B += $d->cotvol_monto2 ?? 0;
            $totalDepositoConvenido += $d->depcon_monto1 ?? 0;
            $totalAhorroVol += $d->ahorro_monto1 ?? 0;
            $totalIndemnSust += $d->indemn_monto1 ?? 0;
            $totalIndemnOblig += $d->indemn_monto2 ?? 0;
            $totalCotPesados += $d->trapesado_monto1 ?? 0;
            $totalAPVEmp += $d->apvctr_monto1 ?? 0;
            $totalAPVTrab += $d->apvctr_monto2 ?? 0;
            $totalSIS += $d->sis_monto1 ?? 0;
            $totalFondoPensiones += ($d->total_fondo ?? 0) + ($d->cotvol_monto1 ?? 0) + ($d->cotvol_monto2 ?? 0);
            if (!empty($d->afivol_monto1)) $totalAfiliadoVol++;
        }



        $periodoFormateado = Carbon::createFromFormat('d/m/Y', '01' . substr('01/12/2024', 2))
        ->format('Ym');

        $linea = '';
        $linea .= '5'; // Tipo Registro
        $linea .= $num(15253, 12);          // 2-13
        $linea .= $num(0, 12);             // 14-25
        $linea .= $num(0, 12);      // 26-37
        $linea .= $num(0, 12);              // 38-49
        $linea .= $num(0, 12);                            // Uso Futuro 50-61
        $linea .= $num(0, 12);             // 62-73
        $linea .= $num(0, 12);            // 74-85
        $linea .= $num(0, 12);             // 86-97
        $linea .= $num(0, 12);           // 98-109
        $linea .= $num(0, 12);                 // 110-121
        $linea .= $num(0, 12);                // 122-133
        $linea .= $num(0, 12);                            // Total Capitalización voluntaria Afiliado Voluntario 134-145
        $linea .= $num(0, 12);                            // Total depósitos ahorro voluntario Afiliado Voluntario 146-157
        $linea .= $num(7500, 12);                    // Total SIS 158-169
        $linea .= $num(22753, 12);         // Total Fondo de Pensiones 170-181
        $linea .= $num(0, 12);                            // Reajustes fondo de pensiones 182-193
        $linea .= $num(0, 12);                            // Intereses fondo pensiones 194-205
        $linea .= $num(0, 12);                            // Recargos 206-217
        $linea .= $num(0, 12);                            // Costas cobranza 218-229
        $linea .= $num(31313, 12);                            // Fondo pensiones c/intereses 230-241
        $linea .= $num(0, 12);                            // Cotización salud independientes 242-253
        $linea .= $num(0, 12);                            // Total a pagar AFP solo salud independientes 254-265
        $linea .= 'C';                                                   // Tipo ingreso 266
        $linea .= $char($periodoFormateado, 6);           // Periodo 267-272
        $linea .= $num(500000, 12);                            // Total remuneraciones (60 UF) 273-284
        $linea .= $num(0, 12);                            // Total remuneraciones (90 UF) 285-296
        $linea .= $num(0, 12);                            // Total gratificaciones 297-308
        $linea .= $num(0, 12);                            // Total subsidios 309-320
        $linea .= $char('', 6);                           // Periodo desde 321-326
        $linea .= $char('', 6);                           // Periodo hasta 327-332
        $linea .= $num(1, 7);      // Número de afiliados informados (Trabajadores) 333-339
        $linea .= $num(1, 7);            // Número de afiliados informados (Afiliado Voluntario) 340-346
        $linea .= $num(0, 7);                            // Número de afiliados informados APVC 347-353
        $linea .= $char('20251003', 8);         // Fecha de pago 354-361
        $linea .= $num(0, 12);                           // Total renta imponible SC 362-373
        $linea .= $num(0, 12);                           // Total aporte trabajadores SC 374-385
        $linea .= $num(0, 12);                           // Total aporte empleadores SC 386-397
        $linea .= $num(0, 12);                           // Total aporte SC 398-409
        $linea .= $num(0, 12);                           // Reajuste Fondo Cesantía 410-421
        $linea .= $num(0, 12);                           // Intereses Fondo Cesantía 422-433
        $linea .= $num(0, 12);                           // Total a pagar fondo cesantía con interés y reajuste 434-445
        $linea .= $num(0, 12);                           // Costas procesales 446-457
        $linea .= $num(8560, 12);                           // Total Monto Reajuste Intereses 458-469
        $linea .= $num(0, 12);                           // Total Recargos 470-481
        $linea .= $char('', 98);                         // Filler 482-580
    
        return str_pad(substr($linea, 0, 580), 580, ' ');
    }


    function normalizarTexto(string $nombre): string {
        $acentos = [
            'Á'=>'A','É'=>'E','Í'=>'I','Ó'=>'O','Ú'=>'U',
            'á'=>'a','é'=>'e','í'=>'i','ó'=>'o','ú'=>'u',
            'À'=>'A','È'=>'E','Ì'=>'I','Ò'=>'O','Ù'=>'U',
            'à'=>'a','è'=>'e','ì'=>'i','ò'=>'o','ù'=>'u',
            'Ä'=>'A','Ë'=>'E','Ï'=>'I','Ö'=>'O','Ü'=>'U',
            'ä'=>'a','ë'=>'e','ï'=>'i','ö'=>'o','ü'=>'u',
            'Ñ'=>'N','ñ'=>'n'
        ];
        return strtr($nombre, $acentos);
    }


    function primeraLineaAbonosAgrupados($rendiciones)
    {

        $totalFondo       = 31313;   // Fondo
        $totalInstitucion = 0;   // Institución
        $totalAfc         = 0;  // AFC

        $fechaAbono = '20251003';
        // $fechaAbono = $fechaAbono ? Carbon::parse($fechaAbono)->format('Ymd') : '';

        $numeroPlanillas = 1;



        //Datos faltantes segun capital
        $identificador_iip  = '008'; // Identificador de IIP (3)
        $cuenta_fondo       = '2551974400'; // Cta.Cte Fondo
        $cuenta_institucion = ''; // Cta.Cte Institución
        $cuenta_afc         = ''; // Cta.Cte AFC
        $banco              = 'CASA MATRIZ II'; // Nombre Banco
        $codigo_banco       = '523'; // Código Banco dueño de cuentas
        $codigo_recaudador  = '523'; // Código recaudador
        $glosa              = ''; // Glosa Recaudador

        $linea = '';

        $linea .= str_pad(1, 1, '0', STR_PAD_LEFT);                         // Tipo de Registro (1) → pos 1–1
        $linea .= str_pad($identificador_iip, 3, '0', STR_PAD_LEFT);        // Identificador de IIP (3) → pos 2–4
        $linea .= str_pad($totalFondo, 12, '0', STR_PAD_LEFT);              // Total abonado Fondo (12) → pos 5–16
        $linea .= str_pad($totalInstitucion, 12, '0', STR_PAD_LEFT);        // Total abonado Institución (12) → pos 17–28
        $linea .= str_pad($totalAfc, 12, '0', STR_PAD_LEFT);                // Total abonado AFC (12) → pos 29–40
        $linea .= str_pad($cuenta_fondo, 30, ' ', STR_PAD_RIGHT);           // Cuenta Fondo (30) → pos 41–70
        $linea .= str_pad($cuenta_institucion, 30, ' ', STR_PAD_RIGHT);     // Cuenta Institución (30) → pos 71–100
        $linea .= str_pad($cuenta_afc, 30, ' ', STR_PAD_RIGHT);             // Cuenta AFC (30) → pos 101–130
        $linea .= str_pad($banco, 30, ' ', STR_PAD_RIGHT);                  // Identificación Banco (30) → pos 131–160
        $linea .= str_pad($codigo_banco, 3, '0', STR_PAD_LEFT);             // Código Banco (3) → pos 161–163
        $linea .= str_pad($fechaAbono, 8, '0', STR_PAD_LEFT);               // Fecha abono (aaaammdd) (8) → pos 164–171
        $linea .= str_pad($codigo_recaudador, 3, '0', STR_PAD_LEFT);        // Código Recaudador (3) → pos 172–174
        $linea .= str_pad($glosa, 27, ' ', STR_PAD_RIGHT);                  // Glosa Recaudador (27) → pos 175–201
        $linea .= str_pad($numeroPlanillas, 4, '0', STR_PAD_LEFT);          // Número Planillas (4) → pos 202–205

        return $linea;
    }

    function detalleAbonosAgrupados($rendicion)
    {
        
        $linea  = str_pad('2', 1);   
        $linea .= '2025';                                                                     // Tipo de Registro 1-1
        $linea .= str_pad(16474, 12, '0', STR_PAD_LEFT);  // Número de folio 2-17
        $linea .= str_pad(31313, 12, '0', STR_PAD_LEFT);  // Monto abonado Fondo 18-29
        $linea .= str_pad(0, 12, '0', STR_PAD_LEFT);  // Monto institución 30-41
        $linea .= str_pad(0, 12, '0', STR_PAD_LEFT); // Monto AFC 42-53

        $rutLimpio = preg_replace('/[^0-9kK]/', '', '76973037-0' );
        $dv = strtoupper(substr($rutLimpio, -1));
        $rut = substr($rutLimpio, 0, -1);

        $linea .= str_pad($rut, 9, '0', STR_PAD_LEFT);                               // Rut Empleador 54-62
        $linea .= str_pad($dv, 1);                                                                         // Dígito verificador 63-63

        $linea .= str_pad('202412', 6, '0', STR_PAD_LEFT);          // Período 64-69 (aaaamm)
        $linea .= str_pad('20251003', 8, '0', STR_PAD_LEFT);       // Fecha Pago 70-77 (aaaammdd)
        $linea .= str_pad('', 9);                                                                          // Lote 78-86
        $linea .= str_pad('', 4);                                            // Sucursal 87-90

            

        return $linea;
    }


}
