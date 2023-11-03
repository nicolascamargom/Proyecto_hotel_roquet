-- Insertar datos en la tabla `usuario`
INSERT INTO hotel_roquet.usuario (identificacion, nom_usuario, edad,direccion, telefono) VALUES
(1, 'Usuario1', 25, 'Dirección1', 123456789),
(2, 'Usuario2', 30, 'Dirección2', 987654321),
(3, 'Usuario3', 22, 'Dirección3', 555555555);

-- Insertar datos en la tabla `habitacion`
INSERT INTO hotel_roquet.habitacion (num_habit, tipo_habit, precio_noche, estado_habit, usuario_identificacion) VALUES
(101, 'Individual', 100, 'Disponible', 1),
(102, 'Doble', 150, 'Ocupada', 2),
(103, 'Suite', 250, 'Disponible', 3);

-- Insertar datos en la tabla `reserva`
INSERT INTO hotel_roquet.reserva (num_reserva, fecha_ini, fecha_fin, dias_reserv, estado, habitacion_num_habit) VALUES
(1, '2023-10-10', '2023-10-15', 5, 'Confirmada', 101),
(2, '2023-11-05', '2023-11-10', 5, 'Pendiente', 102),
(3, '2023-12-20', '2023-12-27', 7, 'Confirmada', 103);

-- Insertar datos en la tabla `producto`
INSERT INTO hotel_roquet.producto (cod_product, precio, nombre) VALUES
(1, 10.99, 'Producto1'),
(2, 5.99, 'Producto2'),
(3, 15.99, 'Producto3');

-- Insertar datos en la tabla `servicio`
INSERT INTO hotel_roquet.servicio (cod_servic, duracion, nombre_servicio) VALUES
(1, '1 hora', 'Servicio1'),
(2, '30 minutos', 'Servicio2'),
(3, '2 horas', 'Servicio3');

-- Insertar datos en la tabla `Consumo`
INSERT INTO hotel_roquet.Consumo (cod_consum, producto_cod_product, servicio_cod_servic, habitacion_num_habit) VALUES
(1, 1, 2, 101),
(2, 2, 1, 102),
(3, 3, 3, 103);

-- Insertar datos en la tabla `consu_factu`
INSERT INTO hotel_roquet.consu_factu (prec_consumo, num_veces_adqui, prec_acom, id, Consumo_cod_consum) VALUES
(20, 2, 30, 'Factura1', 1),
(15, 1, 10, 'Factura2', 2),
(40, 3, 20, 'Factura3', 3);

-- Insertar datos en la tabla `Factura`
INSERT INTO hotel_roquet.Factura (num_factu, prec_total, consu_factu_id, usuario_identificacion) VALUES
(101, 80, 'Factura1', 1),
(102, 25, 'Factura2', 2),
(103, 130, 'Factura3', 3);