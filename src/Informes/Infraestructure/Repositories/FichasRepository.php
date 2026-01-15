<?php

namespace Src\Informes\Infraestructure\Repositories;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class FichasRepository 
{
    public $cliente;
    public $resolucion;
    public $estado;
    public $tipo;
    public function getById($excel, $datos)
    {
        return $excel->useHeaders(['cobranza_id'])
                     ->getRows()
                     ->pluck('cobranza_id')
                     ->filter(fn($id) => is_numeric($id))
                     ->map(fn($id) => (int) $id)
                     ->unique()
                     ->values()
                     ->all();
    }

    public function getByRutEmpleador($excel, $datos)
    {

        $this->setDatos($datos);

        $ruts = $excel->useHeaders(['rut_empleador'])->getRows()->pluck('rut_empleador')->filter()->unique();
       
        $cobranzas = DB::table('cobranzas.cobranza')
                    ->join('cobranzas.cobranza_estado', 'cobranzas.cobranza.id', '=', 'cobranzas.cobranza_estado.cobranza_id')
                    ->whereIn('cobranza.rut_empleador', $ruts)
                    ->when(
                        $this->resolucion,
                        fn ($q, $r) => $q->where('resolucion', 'LIKE', '%' . $r . '%')
                    )
                    ->when($this->cliente, fn($q, $c) => $q->where('cobranzas.cobranza.cliente', $c))
                    ->when($this->estado, fn($q, $e) => $q->where('cobranzas.cobranza_estado.estado_id', $e))
                    ->when($this->tipo, fn($q, $t) => $q->where('cobranzas.cobranza.categoria_id', $t))
                    ->pluck('id')->unique()->values()->all();
        return $cobranzas;

    }   

    public function getByCliente($excel, $datos)
    {
        
    }

    public function getByResolucion($excel, $datos)
    {
        $this->setDatos($datos);

        if (!$this->cliente) throw new \InvalidArgumentException("Cliente no definido para búsqueda por resolución.");

        $resoluciones = $excel->useHeaders(['resolucion'])->getRows()->pluck('resolucion')->filter()->unique()->all();
        // dd($this->cliente);
        $cobranzas = DB::table('remesas.deuda as d')
        ->join('cobranzas.cobranza_deuda as cd', 'cd.deuda_id', '=', 'd.id')
        ->join('cobranzas.cobranza as c', 'c.id', '=', 'cd.cobranza_id')
        ->when($this->cliente, fn($q, $c) => $q->where('c.cliente', $c))
        ->where(function ($q) use ($resoluciones) {
            foreach ($resoluciones as $r) {
                $q->orWhere('d.resolucion', 'LIKE', '%' . $r . '%');
            }
        })
        ->pluck('c.id')->unique()->values()->all();

        return $cobranzas;
    }

    public function getByRitJuzgado($excel, $datos)
    {
        $this->setDatos($datos);

        $rits = $excel->useHeaders(['rit', 'cod_tribunal'])->getRows()
            ->map(fn($r) => ['rit' => $r['rit'], 'cod_tribunal' => $r['cod_tribunal']])
            ->filter(fn($r) => $r['rit'] && $r['cod_tribunal'])
            ->unique(fn($r) => "{$r['rit']}-{$r['cod_tribunal']}")
            ->values()->all();

        $cobranzas = DB::table('cobranzas.cobranza as c')
        ->join('cobranzas.cobranza_causa as cc', 'c.id', '=', 'cc.cobranza_id')
        ->join('pjud.causa as c2', 'cc.causa_id', '=', 'c2.id')
        ->where(function ($q) use ($rits) {
            foreach ($rits as $r) {
                $q->orWhere(function ($sub) use ($r) {
                    $sub->where('c2.rit', $r['rit'])
                        ->where('c2.tribunal_id', $r['cod_tribunal']);
                });
            }
        })
        ->distinct()
        ->pluck('c.id')
        ->all();

         return $cobranzas;
    }

    private function setDatos($datos)
    {
        $this->cliente    = null;
        $this->resolucion = null;
        $this->estado     = null;
        $this->tipo       = null;

        $this->cliente = $datos['cliente'] === '-' ? null : $datos['cliente'];
        $this->resolucion = $datos['resolucion'];
        $this->estado = $datos['estado'] === 'Todas' ? null : $datos['estado'];
        $this->tipo = $datos['tipo'] === 'Todas' ? null : $datos['tipo'];
    }

}
