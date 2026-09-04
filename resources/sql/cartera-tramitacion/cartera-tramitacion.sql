WITH base AS (
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

        act_ultima.codigo_id - 1000 AS cod_ultima_act_judicial,
        act_ultima.fecha AS fecha_ultima_act_judicial,


        /* =====================================================
           ÚLTIMA ACTIVIDAD PRE
           ===================================================== */

        act_pre.codigo_id - 1000 AS ultima_actividad_pre,
        act_pre.fecha AS fecha_ultima_actividad_pre,


        /* =====================================================
           ACTIVIDADES
           ===================================================== */

        act_205.fecha AS ingreso_demanda,

        act_206_210.fecha AS demanda_proveida,

        act_notif_pos.fecha AS notificacion_positiva,

        act_notif_neg.fecha AS notificacion_negativa,

        act_emb_pos.fecha AS embargo_positivo,

        act_oficio.fecha AS resultado_oficio,

        act_no_vivir.fecha AS embargo_retiro_no_vivir,

        act_sin_bienes.fecha AS embargo_retiro_sin_bienes,

        act_450.fecha AS fecha_solicitud_arresto,

        act_610.fecha AS fecha_autorizacion_arresto,

        act_718.fecha AS act_718_revision,

        act_713.fecha AS fecha_713,

        act_052.fecha AS fecha_052,


        /* =====================================================
           GLOSA
           ===================================================== */

        ac.codigo AS glosa,

        'proceso' AS cod_operador,

        r.rut AS rut_rrll,
        r.dv AS dv_rrll,
        r.nombre,
        r.ap_paterno,
        r.ap_materno,

        0 AS telefono,
        0 AS correo,


        ROW_NUMBER() OVER (
            PARTITION BY c.id, c.resolucion
            ORDER BY
                act_pre.fecha DESC NULLS LAST,
                act_ultima.fecha DESC NULLS LAST
        ) AS rn


    FROM cobranzas.cobranza c


    /* =========================================================
       AGENCIA
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

    LEFT JOIN LATERAL (
        SELECT
            MAX(d.periodo) AS periodo,
            SUM(d.monto) AS monto_resolucion
        FROM remesas.deuda d
        WHERE d.resolucion = c.resolucion
    ) de ON TRUE


    /* =========================================================
       ESTADO DE COBRANZA
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

    LEFT JOIN LATERAL (
        SELECT
            cau.rit,
            cau.tribunal_id
        FROM causas.causa cau
        WHERE cau.demandado_id = c.rut_empleador
        LIMIT 1
    ) cau ON TRUE


    /* =========================================================
       TRIBUNAL
       ========================================================= */

    LEFT JOIN gui.tribunal tr
        ON tr.id = cau.tribunal_id


    /* =========================================================
       RRLL
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
       ESTADO DE LA DEUDA
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


    /* =========================================================
       ESTADO DOCUMENTO
       ========================================================= */

    LEFT JOIN gui.estado_documento ed
        ON ed.id = deuda_estado.estado_id


    /* =========================================================
       ÚLTIMA ACTIVIDAD JUDICIAL
       
       Los códigos se almacenan en BD con +1000.
       ========================================================= */

    LEFT JOIN LATERAL (
        SELECT
            a.codigo_id,
            a.fecha
        FROM actividades.actividad a
        WHERE a.cobranza_id = c.id
        ORDER BY
            a.fecha DESC,
            a.codigo_id DESC
        LIMIT 1
    ) act_ultima ON TRUE


    /* =========================================================
       ÚLTIMA ACTIVIDAD PRE
       ========================================================= */

    LEFT JOIN LATERAL (
        SELECT
            a.codigo_id,
            a.fecha
        FROM actividades.actividad a
        WHERE a.cobranza_id = c.id
          AND a.codigo_id IN (
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
        ORDER BY
            a.fecha DESC,
            a.codigo_id DESC
        LIMIT 1
    ) act_pre ON TRUE


    /* =========================================================
       205 - INGRESO DEMANDA
       BD = 1205
       ========================================================= */

    LEFT JOIN LATERAL (
        SELECT
            MAX(a.fecha) AS fecha
        FROM actividades.actividad a
        WHERE a.cobranza_id = c.id
          AND a.codigo_id = 1205
    ) act_205 ON TRUE


    /* =========================================================
       206 / 210 - DEMANDA PROVEÍDA
       BD = 1206 / 1210
       ========================================================= */

    LEFT JOIN LATERAL (
        SELECT
            MAX(a.fecha) AS fecha
        FROM actividades.actividad a
        WHERE a.cobranza_id = c.id
          AND a.codigo_id IN (
                1206,
                1210
          )
    ) act_206_210 ON TRUE


    /* =========================================================
       NOTIFICACIÓN POSITIVA
       BD = 1401,1303,1469,1642,1400,
            1309,1397,1399,1398
       ========================================================= */

    LEFT JOIN LATERAL (
        SELECT
            MAX(a.fecha) AS fecha
        FROM actividades.actividad a
        WHERE a.cobranza_id = c.id
          AND a.codigo_id IN (
                1401,
                1303,
                1469,
                1642,
                1400,
                1309,
                1397,
                1399,
                1398
          )
    ) act_notif_pos ON TRUE


    /* =========================================================
       NOTIFICACIÓN NEGATIVA
       BD = 1334 / 1381
       ========================================================= */

    LEFT JOIN LATERAL (
        SELECT
            MAX(a.fecha) AS fecha
        FROM actividades.actividad a
        WHERE a.cobranza_id = c.id
          AND a.codigo_id IN (
                1334,
                1381
          )
    ) act_notif_neg ON TRUE


    /* =========================================================
       EMBARGO POSITIVO
       BD = 1403 / 1021 / 1600 / 1406
       ========================================================= */

    LEFT JOIN LATERAL (
        SELECT
            MAX(a.fecha) AS fecha
        FROM actividades.actividad a
        WHERE a.cobranza_id = c.id
          AND a.codigo_id IN (
                1403,
                1021,
                1600,
                1406
          )
    ) act_emb_pos ON TRUE


    /* =========================================================
       RESULTADO OFICIO
       002 -> BD 1002
       ========================================================= */

    LEFT JOIN LATERAL (
        SELECT
            MAX(a.fecha) AS fecha
        FROM actividades.actividad a
        WHERE a.cobranza_id = c.id
          AND a.codigo_id = 1002
    ) act_oficio ON TRUE


    /* =========================================================
       EMBARGO / RETIRO FRUSTRADO - NO VIVIR
       BD = 1404 / 1415
       ========================================================= */

    LEFT JOIN LATERAL (
        SELECT
            MAX(a.fecha) AS fecha
        FROM actividades.actividad a
        WHERE a.cobranza_id = c.id
          AND a.codigo_id IN (
                1404,
                1415
          )
    ) act_no_vivir ON TRUE


    /* =========================================================
       EMBARGO / RETIRO FRUSTRADO - SIN BIENES
       BD = 1816 / 1817 / 1469
       ========================================================= */

    LEFT JOIN LATERAL (
        SELECT
            MAX(a.fecha) AS fecha
        FROM actividades.actividad a
        WHERE a.cobranza_id = c.id
          AND a.codigo_id IN (
                1816,
                1817,
                1469
          )
    ) act_sin_bienes ON TRUE


    /* =========================================================
       SOLICITUD ARRESTO
       450 -> BD 1450
       ========================================================= */

    LEFT JOIN LATERAL (
        SELECT
            MAX(a.fecha) AS fecha
        FROM actividades.actividad a
        WHERE a.cobranza_id = c.id
          AND a.codigo_id = 1450
    ) act_450 ON TRUE


    /* =========================================================
       AUTORIZACIÓN ARRESTO
       610 -> BD 1610
       ========================================================= */

    LEFT JOIN LATERAL (
        SELECT
            MAX(a.fecha) AS fecha
        FROM actividades.actividad a
        WHERE a.cobranza_id = c.id
          AND a.codigo_id = 1610
    ) act_610 ON TRUE


    /* =========================================================
       ACTIVIDAD 718
       BD = 1718
       ========================================================= */

    LEFT JOIN LATERAL (
        SELECT
            MAX(a.fecha) AS fecha
        FROM actividades.actividad a
        WHERE a.cobranza_id = c.id
          AND a.codigo_id = 1718
    ) act_718 ON TRUE


    /* =========================================================
       ACTIVIDAD 713
       BD = 1713
       ========================================================= */

    LEFT JOIN LATERAL (
        SELECT
            MAX(a.fecha) AS fecha
        FROM actividades.actividad a
        WHERE a.cobranza_id = c.id
          AND a.codigo_id = 1713
    ) act_713 ON TRUE


    /* =========================================================
       ACTIVIDAD 052
       BD = 1052
       ========================================================= */

    LEFT JOIN LATERAL (
        SELECT
            MAX(a.fecha) AS fecha
        FROM actividades.actividad a
        WHERE a.cobranza_id = c.id
          AND a.codigo_id = 1052
    ) act_052 ON TRUE


    /* =========================================================
       CÓDIGO / GLOSA
       ========================================================= */

    LEFT JOIN actividades.codigo ac
        ON ac.id = act_pre.codigo_id

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

    glosa AS "Glosa",

    fecha_ultima_act_judicial AS "Fecha",

    ingreso_demanda AS
        "Ingreso Demanda (205)",

    demanda_proveida AS
        "Demanda Proveida (206 ó 210)",

    notificacion_positiva AS
        "Notificación positiva (401-303-469-642-400-309-397-399-398)",

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

    NULL AS
        "Cod. EEPP O ACTUACION RECEPTOR",

    NULL AS
        "Glosa EEPP o ACTUACION RECEPTOR",

    NULL AS
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