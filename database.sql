-- Crear tabla usuario_estado
CREATE TABLE usuario_estado (
    id_usuario_estado SERIAL PRIMARY KEY,
    descripcion VARCHAR(50) NOT NULL
);

-- Crear tabla usuario_rol
CREATE TABLE usuario_rol (
    id_usuario_rol SERIAL PRIMARY KEY,
    descripcion VARCHAR(50) NOT NULL
);

-- Crear tabla estado_ticket
CREATE TABLE estado_ticket (
    id_estado_ticket SERIAL PRIMARY KEY,
    descripcion VARCHAR(50) NOT NULL
);

-- Crear tabla usuario
CREATE TABLE usuario (
    id_usuario SERIAL PRIMARY KEY,
    nick VARCHAR(45) NOT NULL,
    correo VARCHAR(100) NOT NULL,
    contrasenia VARCHAR(45) NOT NULL,
    id_estado INTEGER NOT NULL,
    id_rol INTEGER NOT NULL,
    CONSTRAINT fk_usuario_estado FOREIGN KEY (id_estado) REFERENCES usuario_estado(id_usuario_estado),
    CONSTRAINT fk_usuario_rol FOREIGN KEY (id_rol) REFERENCES usuario_rol(id_usuario_rol)
);

-- Crear tabla ticket
CREATE TABLE ticket (
    id_ticket SERIAL PRIMARY KEY,
    asunto VARCHAR(100) NOT NULL,
    descripcion VARCHAR(1000) NOT NULL,
    usuario_creacion INTEGER NOT NULL,
    fecha_creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    respuesta VARCHAR(1000),
    usuario_respuesta INTEGER,
    fecha_respuesta TIMESTAMP,
    id_estado_ticket INTEGER NOT NULL,
    CONSTRAINT fk_ticket_usuario_creacion FOREIGN KEY (usuario_creacion) REFERENCES usuario(id_usuario),
    CONSTRAINT fk_ticket_usuario_respuesta FOREIGN KEY (usuario_respuesta) REFERENCES usuario(id_usuario),
    CONSTRAINT fk_ticket_estado FOREIGN KEY (id_estado_ticket) REFERENCES estado_ticket(id_estado_ticket)
);

-- Crear tabla log_accion
CREATE TABLE log_accion (
    id_log_accion SERIAL PRIMARY KEY,
    descripcion VARCHAR(50) NOT NULL
);

-- Crear tabla log
CREATE TABLE log (
    id_log SERIAL PRIMARY KEY,
    sql_query VARCHAR(1000) NOT NULL,
    table_name VARCHAR(50) NOT NULL,
    fecha_hora TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    id_log_accion INTEGER NOT NULL,
    id_usuario INTEGER NOT NULL,
    CONSTRAINT fk_log_accion FOREIGN KEY (id_log_accion) REFERENCES log_accion(id_log_accion),
    CONSTRAINT fk_log_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
);

-- Insertar datos en usuario_estado
INSERT INTO usuario_estado (descripcion) 
VALUES 
    ('Activo'),
    ('Inactivo');
	
-- Insertar datos en usuario_rol
INSERT INTO usuario_rol (descripcion)
VALUES
    ('Administrador'),
	('Soporte'),
    ('Usuario');

-- Insertar datos en estado_ticket
INSERT INTO estado_ticket (descripcion)
VALUES
    ('Abierto'),
    ('En Proceso'),
    ('Cerrado'),
    ('Cancelado');

-- Insertar datos en la tabla usuario
INSERT INTO usuario (nick, correo, contrasenia, id_estado, id_rol)
VALUES 
    ('admin', 'admin@mail.com', 'admin', 1, 1),
    ('soporte', 'soporte@mail.com', 'soporte', 1, 2),
    ('usuario1', 'usuario1@mail.com', 'user1', 1, 3),
    ('usuario2', 'usuario2@mail.com', 'user2', 2, 3);

-- Insertar datos en ticket
INSERT INTO ticket (asunto, descripcion, usuario_creacion, id_estado_ticket)
VALUES 
    ('Problema de inicio de sesión', 'No puedo iniciar sesión en mi cuenta', 1, 1),
    ('Error en la plataforma', 'La plataforma muestra un error al cargar', 2, 1),
    ('Ticket cerrado', 'Este ticket ya ha sido cerrado anteriormente', 3, 3);

-- Insertar datos en log_accion
INSERT INTO log_accion (descripcion)
VALUES
    ('Inserción'),
    ('Actualización'),
    ('Eliminación')
