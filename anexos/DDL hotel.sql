CREATE DATABASE hotel_roquet;
USE hotel_roquet;
select * from usuario;
-- Definir una tabla llamada "usuario" con columnas.
CREATE TABLE usuario (
  identificacion INT NOT NULL,
  nom_usuario VARCHAR(45) NOT NULL,
  edad INT NOT NULL,
  direccion VARCHAR(45) NOT NULL,
  telefono INT NOT NULL,
  PRIMARY KEY (identificacion)
);
-- procesos almacenados de la tabla usuario
-- insertar usuario
call hotel_roquet.InsertarUsuario(); 
-- actualizar usuario
call hotel_roquet.ActualizarUsuario();
-- eliminar usuario
call hotel_roquet.EliminarUsuario();
-- consultar usuarios
call hotel_roquet.SeleccionarUsuarios(); 
-- procesos almacenados de la tabla habitacion
-- insertar habitacion
call hotel_roquet.InsertarHabitacion();
-- actualizar habitacion
call hotel_roquet.ActualizarHabitacion();
-- eliminar habitacion
call hotel_roquet.EliminararHabitacion();
-- consultar habitacion
 call hotel_roquet.SeleccionarHabitacion();
-- Definir una tabla llamada "habitacion" con columnas y una clave foránea.
CREATE TABLE habitacion (
  num_habit INT NOT NULL,
  tipo_habit VARCHAR(45) NOT NULL,
  precio_noche INT NOT NULL,
  estado_habit VARCHAR(45) NOT NULL,
  usuario_identificacion INT NOT NULL,
  PRIMARY KEY (num_habit, usuario_identificacion),
  FOREIGN KEY (usuario_identificacion) REFERENCES usuario (identificacion)
);

-- Definir una tabla llamada "reserva" con columnas y una clave foránea.
CREATE TABLE reserva (
  num_reserva INT NOT NULL,
  fecha_ini DATE NOT NULL,
  fecha_fin DATE NOT NULL,
  dias_reserv INT NOT NULL,
  estado VARCHAR(45) NOT NULL,
  habitacion_num_habit INT NOT NULL,
  PRIMARY KEY (num_reserva, habitacion_num_habit),
  FOREIGN KEY (habitacion_num_habit) REFERENCES habitacion (num_habit)
);

-- Definir una tabla llamada "producto" con columnas.
CREATE TABLE producto (
  cod_product INT NOT NULL,
  precio FLOAT NOT NULL,
  nombre VARCHAR(45) NULL,
  PRIMARY KEY (cod_product)
);

-- Definir una tabla llamada "servicio" con columnas.
CREATE TABLE servicio (
  cod_servic INT NOT NULL,
  duracion VARCHAR(45) NOT NULL,
  nombre_servicio VARCHAR(45) NOT NULL,
  PRIMARY KEY (cod_servic)
);

-- Definir una tabla llamada "Consumo" con columnas y claves foráneas.
CREATE TABLE Consumo (
  cod_consum INT NOT NULL,
  producto_cod_product INT NOT NULL,
  servicio_cod_servic INT NOT NULL,
  habitacion_num_habit INT NOT NULL,
  PRIMARY KEY (cod_consum, producto_cod_product, servicio_cod_servic, habitacion_num_habit),
  FOREIGN KEY (producto_cod_product) REFERENCES producto (cod_product),
  FOREIGN KEY (servicio_cod_servic) REFERENCES servicio (cod_servic),
  FOREIGN KEY (habitacion_num_habit) REFERENCES habitacion (num_habit)
);

-- Definir una tabla llamada "consu_factu" con columnas y una clave foránea.
CREATE TABLE consu_factu (
  prec_consumo INT NOT NULL,
  num_veces_adqui INT NOT NULL,
  prec_acom INT NOT NULL,
  id VARCHAR(45) NOT NULL,
  Consumo_cod_consum INT NOT NULL,
  PRIMARY KEY (id,Consumo_cod_consum),
  FOREIGN KEY (Consumo_cod_consum) REFERENCES Consumo (cod_consum)
);

-- Definir una tabla llamada "Factura" con columnas y claves foráneas.
CREATE TABLE Factura (
  num_factu INT NOT NULL,
  prec_total INT NOT NULL,
  consu_factu_id VARCHAR(45) NOT NULL,
  usuario_identificacion INT NOT NULL,
  PRIMARY KEY (num_factu, consu_factu_id, usuario_identificacion),
  FOREIGN KEY (consu_factu_id) REFERENCES consu_factu (id),
  FOREIGN KEY (usuario_identificacion) REFERENCES usuario (identificacion)
);