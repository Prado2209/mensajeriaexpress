CREATE DATABASE mensajeria;
USE mensajeria;

CREATE TABLE clientes (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) UNIQUE NOT NULL,
    telefono VARCHAR(20),
    direccion TEXT
);

CREATE TABLE paquetes (
    id_paquete INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    descripcion VARCHAR(255),
    peso DECIMAL(5,2),
    estado ENUM('En tránsito','Entregado','Devuelto') DEFAULT 'En tránsito',
    fecha_envio DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente)
);

CREATE TABLE envios (
    id_envio INT AUTO_INCREMENT PRIMARY KEY,
    id_paquete INT NOT NULL,
    origen VARCHAR(150),
    destino VARCHAR(150),
    fecha_entrega DATETIME,
    observaciones TEXT,
    FOREIGN KEY (id_paquete) REFERENCES paquetes(id_paquete)
);