-- Crear base de datos
CREATE DATABASE IF NOT EXISTS jagua360;
USE jagua360;

-- =========================
-- TABLA USUARIOS
-- =========================
CREATE TABLE usuarios (
    id_usuario VARCHAR(20) PRIMARY KEY,
    nombre_completo VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    tipo_usuario ENUM('persona_natural','empresa','aspirante','administrador') NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    razon_social VARCHAR(150),
    direccion VARCHAR(150),
    hoja_vida TEXT,
    experiencia TEXT,
    permisos TEXT
);

-- Insert ejemplos (hashed passwords are placeholders)
INSERT INTO usuarios (id_usuario, nombre_completo, correo, usuario, contrasena, tipo_usuario, telefono) VALUES
('1001','Carlos Pérez','carlos@mail.com','cperez','$2y$10$w8mF3g9...', 'persona_natural','3001112222');

-- SERVICIOS
CREATE TABLE servicios (
    id_servicio INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario VARCHAR(20),
    nombre_servicio VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10,2),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

-- VACANTES
CREATE TABLE vacantes (
    id_vacante INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario VARCHAR(20),
    titulo VARCHAR(100) NOT NULL,
    descripcion TEXT,
    salario DECIMAL(10,2),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

-- POSTULACIONES
CREATE TABLE postulaciones (
    id_postulacion INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario VARCHAR(20),
    id_vacante INT,
    fecha DATE,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_vacante) REFERENCES vacantes(id_vacante)
);
