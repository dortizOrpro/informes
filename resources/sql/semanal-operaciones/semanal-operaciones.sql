SELECT
    c.id AS cobranza,
    c.fecha AS fecha_remesa,
    ca.agencia_id AS agencia,
    0 AS grupo,
    em.rut,
    em.dv AS dig,
    em.razon_social AS nombre,
    cau.rit AS rol,
    tr.tribunal AS juzgado,
    COALESCE(de.monto_resolucion, 0) AS monto,
    c.producto_id AS codigo_cliente,

    -- FECHAS DE ACTIVIDADES
    act.fecha_2,
    act.fecha_17,
    act.fecha_18,
    act.fecha_21,
    act.fecha_26,
    act.fecha_29,
    act.fecha_39,
    act.fecha_44,
    act.fecha_52,
    act.fecha_82,
    act.fecha_114,
    act.fecha_142,
    act.fecha_144,
    act.fecha_149,
    act.fecha_150,
    act.fecha_171,
    act.fecha_172,
    act.fecha_173,
    act.fecha_197,
    act.fecha_205,
    act.fecha_206,
    act.fecha_207,
    act.fecha_209,
    act.fecha_210,
    act.fecha_211,
    act.fecha_212,
    act.fecha_231,
    act.fecha_234,
    act.fecha_311,
    act.fecha_313,
    act.fecha_321,
    act.fecha_325,
    act.fecha_326,
    act.fecha_334,
    act.fecha_339,
    act.fecha_340,
    act.fecha_381,
    act.fecha_398,
    act.fecha_399,
    act.fecha_401_303_469_642_400_309_397,
    act.fecha_403,
    act.fecha_404,
    act.fecha_406,
    act.fecha_413,
    act.fecha_415,
    act.fecha_430,
    act.fecha_450,
    act.fecha_451,
    act.fecha_470,
    act.fecha_499,
    act.fecha_500,
    act.fecha_600,
    act.fecha_603,
    act.fecha_610,
    act.fecha_612,
    act.fecha_630,
    act.fecha_668,
    act.fecha_681,
    act.fecha_686,
    act.fecha_703,
    act.fecha_708,
    act.fecha_713,
    act.fecha_718,
    act.fecha_726,
    act.fecha_746,
    act.fecha_762,
    act.fecha_766,
    act.fecha_802,
    act.fecha_803,
    act.fecha_805_830,
    act.fecha_806,
    act.fecha_807,
    act.fecha_811,
    act.fecha_813,
    act.fecha_816,
    act.fecha_833,
    act.fecha_837,
    act.fecha_921,
    act.fecha_994,
    act.fecha_997,

    -- ÚLTIMA ACTIVIDAD
    ult.codigo_ultima_actividad,
    ult.glosa_ultima_actividad,
    ult.fecha_ultima_actividad,

    -- PENÚLTIMA ACTIVIDAD
    ult.codigo_penultima_actividad,
    ult.glosa_penultima_actividad,
    ult.fecha_penultima_actividad

FROM cobranzas.cobranza c


-- ============================================================
-- AGENCIA
-- ============================================================
LEFT JOIN LATERAL (
    SELECT
        ca.agencia_id
    FROM cobranzas.cobranza_agencia ca
    WHERE ca.cobranza_id = c.id
    LIMIT 1
) ca ON TRUE


-- ============================================================
-- EMPLEADOR
-- ============================================================
LEFT JOIN remesas.empleador em
    ON em.rut = c.rut_empleador


-- ============================================================
-- CAUSA / ROL
-- ============================================================
LEFT JOIN LATERAL (
    SELECT
        cau.rit,
        cau.tribunal_id
    FROM causas.causa cau
    WHERE cau.demandado_id = c.rut_empleador
    LIMIT 1
) cau ON TRUE


-- ============================================================
-- TRIBUNAL / JUZGADO
-- ============================================================
LEFT JOIN gui.tribunal tr
    ON tr.id = cau.tribunal_id


-- ============================================================
-- MONTO RESOLUCIÓN
-- ============================================================
LEFT JOIN LATERAL (
    SELECT
        SUM(d.monto) AS monto_resolucion
    FROM remesas.deuda d
    WHERE d.resolucion = c.resolucion
) de ON TRUE


-- ============================================================
-- FECHAS DE ACTIVIDADES
-- ============================================================
LEFT JOIN LATERAL (
    SELECT
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1002) AS fecha_2,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1017) AS fecha_17,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1018) AS fecha_18,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1021) AS fecha_21,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1026) AS fecha_26,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1029) AS fecha_29,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1039) AS fecha_39,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1044) AS fecha_44,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1052) AS fecha_52,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1082) AS fecha_82,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1114) AS fecha_114,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1142) AS fecha_142,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1144) AS fecha_144,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1149) AS fecha_149,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1150) AS fecha_150,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1171) AS fecha_171,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1172) AS fecha_172,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1173) AS fecha_173,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1197) AS fecha_197,

        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1205) AS fecha_205,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1206) AS fecha_206,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1207) AS fecha_207,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1209) AS fecha_209,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1210) AS fecha_210,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1211) AS fecha_211,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1212) AS fecha_212,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1231) AS fecha_231,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1234) AS fecha_234,

        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1311) AS fecha_311,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1313) AS fecha_313,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1321) AS fecha_321,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1325) AS fecha_325,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1326) AS fecha_326,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1334) AS fecha_334,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1339) AS fecha_339,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1340) AS fecha_340,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1381) AS fecha_381,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1398) AS fecha_398,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1399) AS fecha_399,

        -- Fecha 401 o 303 o 469 o 642 o 400 o 309 u 397
        MAX(a.fecha) FILTER (
            WHERE a.codigo_id IN (
                1401,
                1303,
                1469,
                1642,
                1400,
                1309,
                1397
            )
        ) AS fecha_401_303_469_642_400_309_397,

        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1403) AS fecha_403,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1404) AS fecha_404,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1406) AS fecha_406,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1413) AS fecha_413,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1415) AS fecha_415,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1430) AS fecha_430,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1450) AS fecha_450,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1451) AS fecha_451,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1470) AS fecha_470,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1499) AS fecha_499,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1500) AS fecha_500,

        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1600) AS fecha_600,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1603) AS fecha_603,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1610) AS fecha_610,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1612) AS fecha_612,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1630) AS fecha_630,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1668) AS fecha_668,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1681) AS fecha_681,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1686) AS fecha_686,

        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1703) AS fecha_703,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1708) AS fecha_708,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1713) AS fecha_713,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1718) AS fecha_718,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1726) AS fecha_726,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1746) AS fecha_746,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1762) AS fecha_762,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1766) AS fecha_766,

        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1802) AS fecha_802,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1803) AS fecha_803,

        -- Fecha 805 u 830
        MAX(a.fecha) FILTER (
            WHERE a.codigo_id IN (1805, 1830)
        ) AS fecha_805_830,

        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1806) AS fecha_806,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1807) AS fecha_807,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1811) AS fecha_811,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1813) AS fecha_813,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1816) AS fecha_816,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1833) AS fecha_833,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1837) AS fecha_837,

        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1921) AS fecha_921,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1994) AS fecha_994,
        MAX(a.fecha) FILTER (WHERE a.codigo_id = 1997) AS fecha_997

    FROM actividades.actividad a

    WHERE a.cobranza_id = c.id
      AND a.codigo_id BETWEEN 1000 AND 1999

) act ON TRUE


-- ============================================================
-- ÚLTIMA Y PENÚLTIMA ACTIVIDAD
-- ============================================================
LEFT JOIN LATERAL (
    SELECT

        MAX(
            CASE
                WHEN x.rn = 1
                THEN x.codigo_id - 1000
            END
        ) AS codigo_ultima_actividad,

        MAX(
            CASE
                WHEN x.rn = 1
                THEN x.glosa
            END
        ) AS glosa_ultima_actividad,

        MAX(
            CASE
                WHEN x.rn = 1
                THEN x.fecha
            END
        ) AS fecha_ultima_actividad,

        MAX(
            CASE
                WHEN x.rn = 2
                THEN x.codigo_id - 1000
            END
        ) AS codigo_penultima_actividad,

        MAX(
            CASE
                WHEN x.rn = 2
                THEN x.glosa
            END
        ) AS glosa_penultima_actividad,

        MAX(
            CASE
                WHEN x.rn = 2
                THEN x.fecha
            END
        ) AS fecha_penultima_actividad

    FROM (
        SELECT
            a.codigo_id,
            ac.codigo AS glosa,
            a.fecha,

            ROW_NUMBER() OVER (
                ORDER BY
                    a.fecha DESC,
                    a.id DESC
            ) AS rn

        FROM actividades.actividad a

        LEFT JOIN actividades.codigo ac
            ON ac.id = a.codigo_id

        WHERE a.cobranza_id = c.id
          AND a.codigo_id BETWEEN 1000 AND 1999

    ) x

    WHERE x.rn <= 2

) ult ON TRUE

WHERE c.producto_id = 'IPS'
  AND (
        CAST(:fecha_ini AS timestamp) IS NULL
        OR CAST(:fecha_fin AS timestamp) IS NULL
        OR c.fecha BETWEEN
            CAST(:fecha_ini AS timestamp)
            AND CAST(:fecha_fin AS timestamp)
      )

ORDER BY c.id;