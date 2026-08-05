WITH cronologia AS (
    SELECT
        codigo_id,
        cronologia_id
    FROM actividades.cronologia
    WHERE cliente_id = 1100
)
SELECT
    1 AS tipo_archivo,
    lpad(c.id::text,10,'0')  AS cobranza,
    lpad(c.rut_empleador::text,9,'0')              AS rut,
    digito_verificador(c.rut_empleador::text)      AS digito,
    lpad('0',3,'0')                                AS afp,
    lpad('55',3,'0')                               AS abogado,
    repeat('0',8)                                  AS correlativo,
    lpad(split_part(cr.rit,'-',2),5,'0')           AS rol,
    split_part(cr.rit,'-',3)                       AS era,
    cr.tribunal_sp                                 AS tribunal,
    repeat('0',4)                                  AS numero,
    repeat('0',5)                                  AS ubicacion,
    repeat('0',10)                                 AS relacion,
    repeat('0',8)                                  AS demanda,
    '01'                                           AS origen,
    'YYYYMMDD'                                     AS fecha,
    lpad(coalesce(c.resolucion::text,'0'),11,'0')  AS resolucion,
    cro.cronologia_id                              AS actividad,
    to_char(a.digitado,'YYYYMMDD')                 AS fecha_inicio,
    to_char(a.digitado,'YYYYMMDD')                 AS fecha_termino,
    ' '                                            AS espacios
FROM actividades.actividad a
JOIN cobranzas.cobranza c
    ON c.id = a.cobranza_id
JOIN cobranzas.cobranza_rit cr
    ON cr.cobranza_id = c.id
JOIN cronologia cro
    ON cro.codigo_id = a.codigo_id
WHERE c.cliente = 78236399
    AND a.digitado BETWEEN :fecha_ini AND :fecha_fin
    AND cro.cronologia_id = 316
ORDER BY
    a.cobranza_id,
    a.digitado;