-- AUTOMATIZACIÓN DE ESTADO DE RESERVA

DELIMITER //
CREATE TRIGGER tr_actualizar_estado_reserva_asignada
AFTER INSERT ON xserv_asignaciones
FOR EACH ROW
BEGIN
    UPDATE xserv_reservas 
    SET estado = 'asignada' 
    WHERE id = NEW.reserva_id;
END //
DELIMITER ;


-- VALIDACIÓN DE CONFLICTO DE ASIGNACIÓN
DELIMITER //
CREATE TRIGGER tr_validar_conflicto_asignacion
BEFORE INSERT ON xserv_asignaciones
FOR EACH ROW
BEGIN
    DECLARE conflicto INT;

    -- Verificar si el vehículo o el chofer ya están ocupados
    SELECT COUNT(*) INTO conflicto
    FROM xserv_asignaciones
    WHERE (vehiculo_id = NEW.vehiculo_id OR chofer_id = NEW.chofer_id)
      AND estado_asignacion IN ('programada', 'en_curso')
      AND (
          (NEW.fecha_inicio_pactada BETWEEN fecha_inicio_pactada AND fecha_fin_pactada)
          OR (NEW.fecha_fin_pactada BETWEEN fecha_inicio_pactada AND fecha_fin_pactada)
      );

    IF conflicto > 0 THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Error: El chofer o vehículo ya tiene una asignación en este rango de tiempo.';
    END IF;
END //
DELIMITER ;

-- LOG DE CAMBIOS EN ESTADO DE RESERVA
DELIMITER //
CREATE TRIGGER tr_log_cambio_estado_reserva
AFTER UPDATE ON xserv_reservas
FOR EACH ROW
BEGIN
    IF OLD.estado <> NEW.estado THEN
        INSERT INTO xserv_reservas_logs (reserva_id, usuario_id, accion_realizada, estado_anterior, estado_nuevo)
        VALUES (NEW.id, 1, 'Cambio de estado automático', OLD.estado, NEW.estado);
        -- Nota: El usuario_id 1 es el admin por defecto para procesos automáticos
    END IF;
END //
DELIMITER ;