-- Crear la base de datos SistemaPeliculas
CREATE DATABASE SistemaPeliculas;

-- Usar la base de datos
USE SistemaPeliculas;

CREATE TABLE cliente (
    id_cliente INT(10) NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(150),
    apellido VARCHAR(150),
    direccion VARCHAR(300),
    usuario VARCHAR(50) NOT NULL,
    password VARCHAR(120) NOT NULL,
    estatus INT(1) NOT NULL,
    PRIMARY KEY (id_cliente)
);
insert into cliente values (0,"Juan","Martinez","Calle Campana #98","juan.martinez@gmail.com",MD5('Hola,123'),1);

insert into administrador values (2,"Fatima","Lopez","fatricia@gmail.com",md5('Hola.123'),1,1);

CREATE TABLE Administrador (
    id_administrador INT(10) NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(150) NOT NULL,
    apellido VARCHAR(150) NOT NULL,
    usuario VARCHAR(50) NOT NULL,
    password VARCHAR(120) NOT NULL,
    privilegio INT(1) NOT NULL,
    estatus INT(1) NOT NULL,
    PRIMARY KEY (id_administrador)
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
i

alter table productos add estatus int(1) not null;
alter table productos add disponibles int(10) not null;

CREATE TABLE productos (id int auto_increment not null,
marca varchar(30) NOT NULL, 
modelo varchar(30) NOT NULL,
descripcion text NOT NULL,
color varchar(30) NOT NULL,
precio double NOT NULL,
imagen VARCHAR(100) NOT NULL,
PRIMARY KEY (id));

INSERT INTO productos VALUES 
(0, "Xiaomi", "Redmi Note 8", 
"Tiene una cámara cuádruple con sensor principal de 48 megapíxeles, con un gran angular de 8 megapíxeles un sensor macro de 2 megapíxeles y un último sensor de 2 megapíxeles para el modo retrato"
, "Negro", 3000, "imágen de prueba");

alter table productos
drop column disponibles;

create table inventario(
    id_inventario INT(10) NOT NULL AUTO_INCREMENT,
    disponibles int,
    id_producto int,
    id_sucursal int,
    PRIMARY KEY (id_inventario),
    FOREIGN KEY (id_sucursal) REFERENCES sucursales(id_sucursal),
    FOREIGN KEY (id_producto) REFERENCES productos(id)
);

create table venta (id int auto_increment not null,
id_cliente int,
monto_total double,
fecha date,
tasa_iva double,
PRIMARY KEY (id),
CONSTRAINT venta_fk1 FOREIGN KEY (id_cliente)
REFERENCES cliente (id_cliente));

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

///////////////////////////////////////////////////////////////////////////////////

-- Tabla: forma_pago
CREATE TABLE forma_pago (
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

DELIMITER ;


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

DELIMITER ;