/*CREATE DATABASE essensis;

USE essensis;*/

CREATE TABLE usuario (
    id_usuario INT(10) NOT NULL AUTO_INCREMENT,
    usuario VARCHAR(50) NOT NULL,
    password VARCHAR(120) NOT NULL,
    tipo INT(1) NOT NULL, /*1 = Admin | 2 = Cliente*/
    estatus INT(1) NOT NULL,
    PRIMARY KEY (id_usuario)
);

INSERT INTO Usuario VALUES (
    0,
    "juan.martinez@gmail.com",
    MD5('Hola.123'),
    2,
    1
), 
(
    0,
    "pedro.ramirez@gmail.com",
    MD5('Hola.123'),
    1,
    1
),
(
    0,
    "ricardo@gmail.com",
    MD5('Hola.123'),
    2,
    1
);



CREATE TABLE cliente (
    id_cliente INT(10) NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(150) NOT NULL,
    apellido VARCHAR(150) NOT NULL,
    direccion VARCHAR(300) NOT NULL,
    id_usuario INT(10) NOT NULL,
    PRIMARY KEY (id_cliente),
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
);

INSERT INTO Cliente VALUES
(
    0,
    "Juan",
    "Martinez",
    "Calle Campana #98",
    1
),
(
    0,
    "Ricardo",
    "Mendoza",
    "Calle Mexico 20, San José de los Olvera, Corregidora, Querétaro",
    3
);



CREATE TABLE administrador (
    id_administrador INT(10) NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(150) NOT NULL,
    apellido VARCHAR(150) NOT NULL,
    id_usuario INT(10) NOT NULL,
    PRIMARY KEY (id_administrador),
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
);

INSERT INTO Administrador VALUES
(
    0,
    "Pedro",
    "Ramirez",
    2
);



CREATE TABLE sucursales (
    id_sucursal INT(10) NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(150) NOT NULL,
    estado VARCHAR(150) NOT NULL,
    municipio VARCHAR(150) NOT NULL,
    direccion VARCHAR(150) NOT NULL,
    telefono VARCHAR(150) NOT NULL,
    estatus INT(1) NOT NULL,
    imagen VARCHAR(100) NOT NULL,
    PRIMARY KEY (id_sucursal)
);

INSERT INTO sucursales VALUES
(
    0,
    "Essensis Queretaro",
    "Queretaro",
    "Corregidora",
    "Av Paseo Constituyentes 531, Corregidora, Queretaro",
    "4425854512",
    1,
    "/Essensis/Images/Productos/1.png"
);



CREATE TABLE productos (
    id int auto_increment not null,
    marca varchar(30) NOT NULL, 
    modelo varchar(30) NOT NULL,
    descripcion text NOT NULL,
    color varchar(30) NOT NULL,
    precio double NOT NULL,
    imagen VARCHAR(100) NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO productos VALUES 
(
    0,
    "Apple",
    "Ipad", 
    "Tiene una cámara cuádruple con sensor principal de 48 megapíxeles, con un gran angular de 8 megapíxeles un sensor macro de 2 megapíxeles y un último sensor de 2 megapíxeles para el modo retrato",
    "Rosa",
    15000,
    "/Essensis/Images/Productos/Ipad.jpeg"
),
(
    0,
    "Apple",
    "Iphone 14", 
    "Tiene una cámara cuádruple con sensor principal de 48 megapíxeles, con un gran angular de 8 megapíxeles un sensor macro de 2 megapíxeles y un último sensor de 2 megapíxeles para el modo retrato",
    "Blanco",
    12000,
    "/Essensis/Images/Productos/Iphone_1.png"
),
(
    0,
    "Motorola",
    "Moto G42", 
    "Tiene una cámara cuádruple con sensor principal de 48 megapíxeles, con un gran angular de 8 megapíxeles un sensor macro de 2 megapíxeles y un último sensor de 2 megapíxeles para el modo retrato",
    "Azul celeste",
    4000,
    "/Essensis/Images/Productos/Motog42.jpg"
),
(
    0,
    "Motorola",
    "Moto 1", 
    "Tiene una cámara cuádruple con sensor principal de 48 megapíxeles, con un gran angular de 8 megapíxeles un sensor macro de 2 megapíxeles y un último sensor de 2 megapíxeles para el modo retrato",
    "Azul celeste",
    5000,
    "/Essensis/Images/Productos/Motorola_1.png"
),
(
    0,
    "Poco",
    "PocoPhone", 
    "Tiene una cámara cuádruple con sensor principal de 48 megapíxeles, con un gran angular de 8 megapíxeles un sensor macro de 2 megapíxeles y un último sensor de 2 megapíxeles para el modo retrato",
    "Azul celeste",
    5000,
    "/Essensis/Images/Productos/PocoPhone_1.png"
),
(
    0,
    "Xiaomi",
    "Redmi Note 8", 
    "Tiene una cámara cuádruple con sensor principal de 48 megapíxeles, con un gran angular de 8 megapíxeles un sensor macro de 2 megapíxeles y un último sensor de 2 megapíxeles para el modo retrato",
    "Negro",
    4500,
    "/Essensis/Images/Productos/Redminote8.jpg"
),
(
    0,
    "Samsung",
    "Galaxy Z Flip", 
    "Tiene una cámara cuádruple con sensor principal de 48 megapíxeles, con un gran angular de 8 megapíxeles un sensor macro de 2 megapíxeles y un último sensor de 2 megapíxeles para el modo retrato",
    "Negro",
    15000,
    "/Essensis/Images/Productos/Samsung_1.png"
);



CREATE TABLE inventario(
    id_inventario INT(10) NOT NULL AUTO_INCREMENT,
    disponibles int,
    id_producto int,
    id_sucursal int,
    PRIMARY KEY (id_inventario),
    FOREIGN KEY (id_sucursal) REFERENCES sucursales(id_sucursal),
    FOREIGN KEY (id_producto) REFERENCES productos(id)
);

INSERT INTO inventario VALUES (
    0,
    500,
    1,
    1
),
(
    0,
    500,
    2,
    1
),
(
    0,
    500,
    3,
    1
),
(
    0,
    500,
    4,
    1
),
(
    0,
    500,
    5,
    1
),
(
    0,
    500,
    6,
    1
),
(
    0,
    500,
    7,
    1
);

CREATE TABLE venta (
    id int auto_increment not null,
    id_cliente int,
    monto_total double,
    fecha date,
    tasa_iva double,
    PRIMARY KEY (id),
    CONSTRAINT venta_fk1 FOREIGN KEY (id_cliente)
    REFERENCES cliente (id_cliente)
);



CREATE TABLE detalle_venta (
    id_detalle INT PRIMARY KEY AUTO_INCREMENT,
    id_venta INT,
    id_inventario INT,
    cantidad INT,
    precio_unitario DOUBLE,
    subtotal DOUBLE,
    FOREIGN KEY (id_inventario) REFERENCES inventario(id_inventario),
    FOREIGN KEY (id_venta) REFERENCES venta(id)
);

-- Tabla: forma_pago
/*CREATE TABLE forma_pago (
    id_forma_pago INT(10) NOT NULL AUTO_INCREMENT,
    tipo VARCHAR(70) NOT NULL,
    terminacion INT(4) NOT NULL,
    PRIMARY KEY (id_forma_pago)
);


DELIMITER //
CREATE TRIGGER after_insert_venta
AFTER INSERT ON detalle_venta
FOR EACH ROW
BEGIN
    UPDATE inventario
    SET disponibles = disponibles - NEW.cantidad
    WHERE id_inventario = NEW.id_inventario;
END;
//

DELIMITER ;

SELECT venta.id,cliente.nombre,cliente.apellido,venta.fecha FROM venta 
inner join cliente on (venta.id_cliente=cliente.id_cliente);

DELIMITER //

CREATE TRIGGER after_insert_venta
AFTER INSERT ON detalle_venta
FOR EACH ROW
BEGIN
    DECLARE cantidad_venta INT;
    DECLARE id_inventario_producto INT;

    SELECT cantidad, id_inventario INTO cantidad_venta, id_inventario_producto
    FROM detalle_venta
    WHERE id_venta = NEW.id_venta;

    UPDATE inventario
    SET disponibles = (disponibles - cantidad_venta)
    WHERE id_inventario = id_inventario_producto;
END;
//

DELIMITER ;*/


/************/

DELIMITER //

CREATE TRIGGER after_insert_venta
AFTER INSERT ON detalle_venta
FOR EACH ROW
BEGIN
    UPDATE inventario
    SET disponibles = (disponibles - new.cantidad)
    WHERE id_inventario = new.id_inventario;
END;
//

DELIMITER ;