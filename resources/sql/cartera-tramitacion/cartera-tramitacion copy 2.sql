WITH

/* =============================================================
   ACTIVIDADES AGRUPADAS
   Se procesa actividades.actividad una sola vez para
   las actividades específicas requeridas.
   ============================================================= */
actividades_agg AS (
    SELECT
        a.cobranza_id,

        /* =====================================================
           ÚLTIMA ACTIVIDAD PRE
           ===================================================== */
        (
            ARRAY_AGG(
                a.codigo_id
                ORDER BY a.fecha DESC NULLS LAST,
                         a.codigo_id DESC
            ) FILTER (
                WHERE a.codigo_id IN (
                    1100,
                    1180,
                    1181,
                    1190,
                    1240,
                    1252,
                    1330,
                    1332,
                    1333,
                    1335,
                    1436,
                    1437,
                    1443,
                    1448,
                    1449,
                    1641,
                    1700,
                    1730,
                    1732,
                    1805,
                    1830
                )
            )
        )[1] AS ultima_actividad_pre,

        (
            ARRAY_AGG(
                a.fecha
                ORDER BY a.fecha DESC NULLS LAST,
                         a.codigo_id DESC
            ) FILTER (
                WHERE a.codigo_id IN (
                    1100,
                    1180,
                    1181,
                    1190,
                    1240,
                    1252,
                    1330,
                    1332,
                    1333,
                    1335,
                    1436,
                    1437,
                    1443,
                    1448,
                    1449,
                    1641,
                    1700,
                    1730,
                    1732,
                    1805,
                    1830
                )
            )
        )[1] AS fecha_ultima_actividad_pre,


        /* =====================================================
           205 - INGRESO DEMANDA
           ===================================================== */
        MAX(a.fecha) FILTER (
            WHERE a.codigo_id = 1205
        ) AS ingreso_demanda,


        /* =====================================================
           206 / 210 - DEMANDA PROVEIDA
           ===================================================== */
        MAX(a.fecha) FILTER (
            WHERE a.codigo_id IN (1206, 1210)
        ) AS demanda_proveida,


        /* =====================================================
           NOTIFICACIÓN POSITIVA
           ===================================================== */
        MAX(a.fecha) FILTER (
            WHERE a.codigo_id IN (
                1401,
                1303,
                1469,
                1642,
                1400,
                1309,
                1397,
                1399,
                1398,
                1766
            )
        ) AS notificacion_positiva,


        /* =====================================================
           NOTIFICACIÓN NEGATIVA
           ===================================================== */
        MAX(a.fecha) FILTER (
            WHERE a.codigo_id IN (
                1334,
                1381
            )
        ) AS notificacion_negativa,


        /* =====================================================
           EMBARGO POSITIVO
           ===================================================== */
        MAX(a.fecha) FILTER (
            WHERE a.codigo_id IN (
                1403,
                1021,
                1600,
                1406
            )
        ) AS embargo_positivo,


        /* =====================================================
           RESULTADO OFICIO
           ===================================================== */
        MAX(a.fecha) FILTER (
            WHERE a.codigo_id = 1002
        ) AS resultado_oficio,


        /* =====================================================
           EMBARGO / RETIRO NO VIVIR
           ===================================================== */
        MAX(a.fecha) FILTER (
            WHERE a.codigo_id IN (
                1404,
                1415
            )
        ) AS embargo_retiro_no_vivir,


        /* =====================================================
           EMBARGO / RETIRO SIN BIENES
           ===================================================== */
        MAX(a.fecha) FILTER (
            WHERE a.codigo_id IN (
                1816,
                1817,
                1469
            )
        ) AS embargo_retiro_sin_bienes,


        /* =====================================================
           SOLICITUD ARRESTO
           ===================================================== */
        MAX(a.fecha) FILTER (
            WHERE a.codigo_id = 1450
        ) AS fecha_solicitud_arresto,


        /* =====================================================
           AUTORIZACIÓN ARRESTO
           ===================================================== */
        MAX(a.fecha) FILTER (
            WHERE a.codigo_id = 1610
        ) AS fecha_autorizacion_arresto,


        /* =====================================================
           ACTIVIDAD 718
           ===================================================== */
        MAX(a.fecha) FILTER (
            WHERE a.codigo_id = 1718
        ) AS act_718_revision,


        /* =====================================================
           ACTIVIDAD 713
           ===================================================== */
        MAX(a.fecha) FILTER (
            WHERE a.codigo_id = 1713
        ) AS fecha_713,


        /* =====================================================
           ACTIVIDAD 052
           ===================================================== */
        MAX(a.fecha) FILTER (
            WHERE a.codigo_id = 1052
        ) AS fecha_052

    FROM actividades.actividad a

    WHERE a.codigo_id IN (
        /* Actividades PRE */
        1100,
        1180,
        1181,
        1190,
        1240,
        1252,
        1330,
        1332,
        1333,
        1335,
        1436,
        1437,
        1443,
        1448,
        1449,
        1641,
        1700,
        1730,
        1732,
        1805,
        1830,

        /* 205 */
        1205,

        /* 206 / 210 */
        1206,
        1210,

        /* Notificación positiva */
        1401,
        1303,
        1469,
        1642,
        1400,
        1309,
        1397,
        1399,
        1398,
        1766,

        /* Notificación negativa */
        1334,
        1381,

        /* Embargo positivo */
        1403,
        1021,
        1600,
        1406,

        /* Oficio */
        1002,

        /* No vivir */
        1404,
        1415,

        /* Sin bienes */
        1816,
        1817,

        /* Arresto */
        1450,
        1610,

        /* Otras */
        1718,
        1713,
        1052
    )

    GROUP BY a.cobranza_id
),


/* =============================================================
   ÚLTIMA ACTIVIDAD JUDICIAL
   ============================================================= */
ultima_actividad AS (
    SELECT DISTINCT ON (a.cobranza_id)
        a.cobranza_id,
        a.codigo_id,
        a.fecha
    FROM actividades.actividad a
    ORDER BY
        a.cobranza_id,
        a.fecha DESC NULLS LAST,
        a.codigo_id DESC
),


/* =============================================================
   DEUDA
   Se calcula una sola vez por resolución.
   ============================================================= */
deuda AS (
    SELECT
        d.resolucion,
        MAX(d.periodo) AS periodo,
        SUM(d.monto) AS monto_resolucion
    FROM remesas.deuda d
    GROUP BY d.resolucion
),


/* =============================================================
   CAUSA
   Se mantiene una sola causa por demandado.
   ============================================================= */
causa AS (
    SELECT DISTINCT ON (c.demandado_id)
        c.demandado_id,
        c.id,
        c.rit,
        c.tribunal_id
    FROM causas.causa c
    ORDER BY
        c.demandado_id,
        c.id
),


/* =============================================================
   BASE
   ============================================================= */
base AS (
    SELECT

        c.id AS cobranza,

        c.resolucion,

        ca.agencia_id AS agencia,

        de.periodo AS mes,

        c.producto_id AS institucion,

        'SUCC' AS cliente,

        ec.estado AS estado_id,

        0 AS envio_acreditacion,

        0 AS documento_no_acredita,

        ed.estado AS estado_documento,

        COALESCE(de.monto_resolucion, 0) AS monto_resolucion,

        0 AS rango,

        em.rut,

        em.dv,

        em.razon_social,

        cau.rit,

        cau.tribunal_id,

        tr.tribunal AS juzgado_orpro,

        c.producto_id AS codigo_cliente,

        'SUCC' AS nombre_cliente,


        /* =====================================================
           ÚLTIMA ACTIVIDAD JUDICIAL
           ===================================================== */

        ua.codigo_id - 1000 AS cod_ultima_act_judicial,

        ua.fecha AS fecha_ultima_act_judicial,


        /* =====================================================
           GLOSA
           ===================================================== */

        acc.codigo AS glosa,


        /* =====================================================
           ÚLTIMA ACTIVIDAD PRE

           Se resta 1000 igual que en la query original.
           ===================================================== */

        aa.ultima_actividad_pre - 1000 AS ultima_actividad_pre,

        aa.fecha_ultima_actividad_pre,


        /* =====================================================
           ÚLTIMO MOVIMIENTO
           ===================================================== */

        mov_ultimo.tipo_movimiento AS tipo_movimiento_ultimo,

        mov_ultimo.glosa AS glosa_movimiento_ultimo,

        mov_ultimo.fecha AS fecha_ultimo_movimiento,


        /* =====================================================
           ACTIVIDADES
           ===================================================== */

        aa.ingreso_demanda,

        aa.demanda_proveida,

        aa.notificacion_positiva,

        aa.notificacion_negativa,

        aa.embargo_positivo,

        aa.resultado_oficio,

        aa.embargo_retiro_no_vivir,

        aa.embargo_retiro_sin_bienes,

        aa.fecha_solicitud_arresto,

        aa.fecha_autorizacion_arresto,

        aa.act_718_revision,

        aa.fecha_713,

        aa.fecha_052,


        /* =====================================================
           OPERADOR / RRLL
           ===================================================== */

        'proceso' AS cod_operador,

        r.rut AS rut_rrll,

        r.dv AS dv_rrll,

        r.nombre,

        r.ap_paterno,

        r.ap_materno,

        0 AS telefono,

        0 AS correo,


        /* =====================================================
           CONTROL DUPLICADOS
           ===================================================== */

        ROW_NUMBER() OVER (
            PARTITION BY c.id, c.resolucion
            ORDER BY
                aa.fecha_ultima_actividad_pre DESC NULLS LAST,
                ua.fecha DESC NULLS LAST
        ) AS rn


    FROM cobranzas.cobranza c


    /* =========================================================
       AGENCIA
       Se mantiene el LIMIT 1 original.
       ========================================================= */

    LEFT JOIN LATERAL (
        SELECT
            ca.agencia_id
        FROM cobranzas.cobranza_agencia ca
        WHERE ca.cobranza_id = c.id
        LIMIT 1
    ) ca ON TRUE


    /* =========================================================
       DEUDA
       ========================================================= */

    LEFT JOIN deuda de
        ON de.resolucion = c.resolucion


    /* =========================================================
       ESTADO COBRANZA     
       ========================================================= */

    LEFT JOIN LATERAL (
        SELECT
            ce.estado_id
        FROM cobranzas.cobranza_estado ce
        WHERE ce.cobranza_id = c.id
        LIMIT 1
    ) ce ON TRUE

    LEFT JOIN gui.estado_cobranza ec
        ON ec.id = ce.estado_id


    /* =========================================================
       EMPLEADOR
       ========================================================= */

    LEFT JOIN remesas.empleador em
        ON em.rut = c.rut_empleador


    /* =========================================================
       CAUSA
       ========================================================= */

    LEFT JOIN causa cau
        ON cau.demandado_id = c.rut_empleador


    /* =========================================================
       TRIBUNAL
       ========================================================= */

    LEFT JOIN gui.tribunal tr
        ON tr.id = cau.tribunal_id


    /* =========================================================
       RRLL
       Se mantiene LIMIT 1 original.
       ========================================================= */

    LEFT JOIN LATERAL (
        SELECT
            r.rut,
            r.dv,
            r.nombre,
            r.ap_paterno,
            r.ap_materno
        FROM remesas.rrll r
        WHERE r.rut_empleador = c.rut_empleador
        LIMIT 1
    ) r ON TRUE


    /* =========================================================
       ESTADO DOCUMENTO
       Se mantiene LIMIT 1 original.
       ========================================================= */

    LEFT JOIN LATERAL (
        SELECT
            de_estado.estado_id
        FROM recaudacion.deuda_estado de_estado

        INNER JOIN remesas.deuda d
            ON d.id = de_estado.deuda_id

        WHERE d.resolucion = c.resolucion

        LIMIT 1
    ) deuda_estado ON TRUE


    LEFT JOIN gui.estado_documento ed
        ON ed.id = deuda_estado.estado_id


    /* =========================================================
       ÚLTIMA ACTIVIDAD JUDICIAL
       ========================================================= */

    LEFT JOIN ultima_actividad ua
        ON ua.cobranza_id = c.id


    /* =========================================================
       GLOSA
       ========================================================= */

    LEFT JOIN actividades.codigo acc
        ON acc.id = ua.codigo_id


    /* =========================================================
       ACTIVIDADES AGRUPADAS
       ========================================================= */

    LEFT JOIN actividades_agg aa
        ON aa.cobranza_id = c.id


    /* =========================================================
       ÚLTIMO MOVIMIENTO
       ========================================================= */

    LEFT JOIN LATERAL (
        SELECT
            tm.tipo_movimiento,
            g.glosa,
            m.fecha

        FROM causas.movimiento m

        LEFT JOIN causas.tipo_movimiento tm
            ON tm.id = m.tipo_movimiento_id

        LEFT JOIN causas.glosa g
            ON g.id = m.glosa_id

        WHERE m.causa_id = cau.id

        ORDER BY
            m.fecha DESC NULLS LAST

        LIMIT 1

    ) mov_ultimo ON TRUE

    WHERE c.producto_id = 'IPS'
      AND (
          CAST(:fecha_ini AS timestamp) IS NULL
          OR CAST(:fecha_fin AS timestamp) IS NULL
          OR c.fecha BETWEEN
              CAST(:fecha_ini AS timestamp)
              AND CAST(:fecha_fin AS timestamp)
      )
)


/* =============================================================
   SELECT FINAL
   ============================================================= */

SELECT

    agencia AS "Agencia",

    cobranza AS "Cobranza",

    rut AS "Rut",

    dv AS "dv",

    razon_social AS "Nombre",

    tribunal_id AS "Codigo Sp",

    juzgado_orpro AS "Nombre Juzgado",

    rit AS "Rit",

    monto_resolucion AS "Monto",

    codigo_cliente AS "cod Ciente",

    'DNP' AS
        "Origen de deuda (DNP-DNPA-Dda laboral-Reclamo)",

    cod_ultima_act_judicial AS
        "Cod Ult. Act Judicial",

    glosa AS
        "Glosa",

    fecha_ultima_act_judicial AS
        "Fecha",

    ingreso_demanda AS
        "Ingreso Demanda (205)",

    demanda_proveida AS
        "Demanda Proveida (206 ó 210)",

    notificacion_positiva AS
        "Notificación positiva (401-303-469-642-400-309-397-399-398-766)",

    notificacion_negativa AS
        "Notificación negativa (334-381)",

    embargo_positivo AS
        "Embargo positivo (403-21-600-406)",

    resultado_oficio AS
        "Resultado oficio (002)",

    embargo_retiro_no_vivir AS
        "Embargo / retiro frustrado por no vivir (404-415)",

    embargo_retiro_sin_bienes AS
        "Embargo / retiro frustrado sin bienes (816-817-469)",

    fecha_solicitud_arresto AS
        "Fecha solicitud arresto(450)",

    fecha_autorizacion_arresto AS
        "Fecha autorización arresto (610)",

    tipo_movimiento_ultimo AS
        "Cod. EEPP O ACTUACION RECEPTOR",

    glosa_movimiento_ultimo AS
        "Glosa EEPP o ACTUACION RECEPTOR",

    fecha_ultimo_movimiento AS
        "Fecha EEPP O ACTUACION RECEPTOR",

    estado_id AS
        "Estado cobranza (vigente-suspendida-incobrable-terminada)",

    NULL AS
        "Estado Cuaderno ppal",

    NULL AS
        "Estado cuaderno apremio",

    'Ricardo Alamos' AS
        "Abogado",

    NULL AS
        "Activa/inactiva",

    act_718_revision AS
        "Act 718 en revisión",

    fecha_713 AS
        "Fecha 713",

    fecha_052 AS
        "Fecha 052",

    NULL AS
        "Juicio > 2 años",

    NULL AS
        "Prioritaria",

    NULL AS
        "Defensa activa",

    NULL AS
        "Estado Prioridad"

FROM base

WHERE rn = 1

ORDER BY cobranza;