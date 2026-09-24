SELECT
    e.cobranza_id AS "Cobranza",
    t.tipo AS "Escrito",
    e.rit AS "RIT",
    e.tribunal_id AS "Tribunal_Codigo",
    t2.tribunal AS "Tribunal",
    CONCAT(
        t3.usuario_nombres, ' ',
        t3.usuario_appaterno, ' ',
        t3.usuario_apmaterno
    ) AS "Usuario",
    t2.agencia_id AS "Agencia",
    TO_CHAR(e.created_at, 'YYYY-MM-DD') AS "Fecha_Escrito"
FROM escritos.escrito e
JOIN escritos.tipo t
    ON t.id = e.tipo_id
JOIN gui.tribunal t2
    ON t2.id = e.tribunal_id
JOIN gui.tblusuario t3
    ON t3.usuario_rut = e.usuario_id
WHERE e.created_at BETWEEN :fecha_ini AND :fecha_fin
ORDER BY e.created_at;