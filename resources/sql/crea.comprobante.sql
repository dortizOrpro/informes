INSERT INTO recaudacion.comprobante (pago_id, cobranza_id, apago, honorarios, gastos)
select
    p.id,
    cd.cobranza_id,
    sum(pd.apago) as pago,
    0 as honorarios,
    0 as gastos
from recaudacion.pago p,
     recaudacion.preingreso_detalle pd,
     cobranzas.cobranza_deuda cd
where p.id = :PAGO_ID
  and p.preingreso_id = pd.preingreso_id
  and cd.deuda_id = pd.deuda_id
group by p.id, cd.cobranza_id
