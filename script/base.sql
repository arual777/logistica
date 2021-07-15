drop database Logistica;
	create database Logistica;
	use Logistica;

CREATE TABLE Tipo_Licencia( id_tipoLicencia int not null auto_increment primary key,
                            descripcion varchar (30) not null);

CREATE TABLE Rol(  id_Rol int not null auto_increment,
                   descripcion varchar(30) not null,
                   primary key (id_Rol));

CREATE TABLE Usuario(   id_Usuario int not null auto_increment,
                        id_Rol int,
                        id_Licencia int not null,
                        mail varchar (30),
                        clave varchar (40),
                        activo bool,
                        nombre varchar (80) not null,
                        apellido varchar (80) not null,
                        dni int not null,
                        fecha_nac date,
                        codigo_licencia varchar (20) null,
                        primary key (id_Usuario),
                        foreign key (id_Licencia) references Tipo_Licencia (id_tipoLicencia),
                        foreign key (id_Rol) references Rol (id_Rol));


CREATE TABLE Seccion(
                        id_Seccion int,
                        descripcion varchar (80),
                        primary key(id_Seccion));

CREATE TABLE Rol_Seccion(
                            id_Rol int not null,
                            id_Seccion int not null,
                            alta int not null,
                            baja int not null,
                            modificacion int not null,
                            lectura int not null,
                            foreign key (id_Rol) references Rol (id_Rol),
                            foreign key (id_Seccion) references Seccion (id_Seccion)
);

CREATE TABLE Tipo_Vehiculo(
                              id_TipoVehiculo int not null auto_increment,
                              descripcion varchar (30) not null,
                              primary key (id_TipoVehiculo));

CREATE TABLE Tipo_Semi(
                          id_Tipo int not null auto_increment,
                          descripcion varchar (30) not null,
                          primary key(id_Tipo));

CREATE TABLE Vehiculo (
                          id_Vehiculo int not null auto_increment,
                          id_Tipo int not null,
                          id_TipoSemi int null,
                          marca varchar (40) null,
                          modelo varchar (50) null,
                          patente varchar(50) not null,
                          motor int null,
                          chasis varchar (80) null,
                          anio_fabricacion date null,
                          kilometraje int null,
                          estado varchar (50) not null,
                          primary key (id_Vehiculo),
                          foreign key (id_Tipo) references Tipo_Vehiculo (id_TipoVehiculo),
                          foreign key (id_TipoSemi) references Tipo_Semi (id_Tipo));

CREATE TABLE Tipo_Service(
                             id_service int not null auto_increment,
                             descripcion varchar (30) not null,
                             primary key (id_service));

CREATE TABLE Service(
                        id_Service int not null auto_increment,
                        id_Vehiculo int not null,
                        id_Usuario int not null,
                        id_TipoService int not null,
                        fecha date not null,
                        kilometraje int not null,
                        detalle varchar (1000) not null ,
                        repuestos_cambiados varchar (1000) not null,
                        primary key (id_Service),
                        foreign key (id_Vehiculo) references Vehiculo(id_Vehiculo),
                        foreign key (id_Usuario) references Usuario (id_Usuario),
                        foreign key (id_TipoService) references Tipo_Service (id_Service));

CREATE table Tipo_Gasto (
                            id_Gasto int not null,
                            descripcion varchar (40),
                            primary key (id_Gasto)
);

CREATE TABLE Tipo_Carga(
                           id_TipoCarga int not null auto_increment,
                           descripcion varchar (80) not null,
                           primary key (id_TipoCarga)
);

CREATE TABLE Tipo_Hazard ( id_TipoHazard int not null auto_increment,
                           descripcion varchar (50) not null,
                           primary Key (id_TipoHazard));


CREATE TABLE Carga(   id_Carga int not null auto_increment,
                      id_TipoCarga int not null,
                      id_TipoHazard int not null,
                      refrigeracion int not null,
                      graduacion int null,
                      peso decimal not null,
                      primary key (id_Carga),
                      foreign key (id_TipoCarga) references Tipo_Carga (id_TipoCarga),
                      foreign key (id_TipoHazard) references Tipo_Hazard (id_TipoHazard)
);
CREATE TABLE Viaje(
                      id_viaje int not null auto_increment,
                      id_usuario int not null,
                      id_vehiculo int not null,
                      id_arrastre int not null,
                      id_carga int not null,
                      origen varchar (30) not null,
                      destino varchar (30) not null,
                      fecha_carga date,
                      tiempo_estimadoLlegada date,
                      codigo_qr text null,
                      primary key (id_viaje),
                      foreign key (id_usuario) references Usuario(id_Usuario),
                      foreign key (id_carga) references Carga (id_Carga),
                      foreign key (id_vehiculo) references Vehiculo(id_Vehiculo),
                      foreign key (id_arrastre) references Vehiculo (id_Vehiculo));

CREATE TABLE Viaje_Detalle(
                              id_Viaje_Detalle int not null auto_increment,
                              id_viaje int not null,
                              kilometraje int not null,
                              latitud decimal not null,
                              longitud decimal not null,
                              fecha date not null,
                              combustibleCargado decimal not null,
                              peajes decimal not null,
                              extras decimal not null,
                              primary key(id_Viaje_Detalle),
                              foreign key (id_viaje) references Viaje (id_viaje));

CREATE TABLE Proforma(
                         id_factura int not null auto_increment,
                         id_viaje int not null,
                         fecha date not null,
                         denominacion_cliente varchar (80) not null,
                         cuit int not null,
                         telefono varchar(45) not null,
                         mail varchar (30) null,
                         contacto varchar(45) not null,
                         kilometros_estimados decimal not null,
                         combustible_litros_estimados decimal not null,
                         costo_peajes decimal not null,
                         costo_viaticos decimal not null,
                         costo_peligroso decimal null,
                         costo_refrigeracion decimal null,
                         tarifa decimal not null,
                         primary key (id_factura),
                         foreign key (id_viaje) references Viaje (id_Viaje));

/*******DATOS********/
INSERT INTO Rol (descripcion)
VALUES ('Sin rol'),
       ('Administrador'),
       ('Supervisor'),
       ('Chofer'),
       ('Mecanico');

insert into tipo_licencia(descripcion) values ('sin licencia');
insert into tipo_licencia(descripcion) values ('A');
insert into tipo_licencia(descripcion) values ('B');
insert into tipo_licencia(descripcion) values ('C');
insert into tipo_licencia(descripcion) values ('D');
insert into tipo_licencia(descripcion) values ('E');
insert into tipo_licencia(descripcion) values ('F');


/**
test@gmail/testclave
super@gmail.com/123456
admin@gmail.com/252423
chofer@gmail.com/344654
mecanico@gmail.com/261158
**/
INSERT INTO Usuario (id_Usuario,id_Rol, id_Licencia, mail, clave, activo, nombre, apellido, dni, fecha_nac, codigo_licencia)
VALUES (1,2,1, 'test@gmail.com', '3f9406b114126f9f05c3fdf78012ae79', true, 'jorge', 'perez', 34343434, '1980-05-05', 'cde333');
INSERT INTO Usuario VALUES (3,3 ,1,'super@gmail.com', '3f9406b114126f9f05c3fdf78012ae79', true, 'Antonio', 'Gonzalez', 34563234, '1990-07-01', 'hjs123');
INSERT INTO Usuario VALUES (2,2 ,1,'admin@gmail.com', '3f9406b114126f9f05c3fdf78012ae79', true, 'Jose', 'fernandez', 35663234, '1990-07-01', 'pes123');
INSERT INTO Usuario VALUES (4,4 ,1,'chofer@gmail.com', '3f9406b114126f9f05c3fdf78012ae79', true, 'Martin', 'Robertoz', 35568234, '1978-07-02', 'fif153');
INSERT INTO Usuario VALUES (5,5 ,1,'mecanico@gmail.com', '3f9406b114126f9f05c3fdf78012ae79', true, 'Pablo', 'Lopez', 45673234, '1997-10-03', 'pjh783');

INSERT INTO Seccion VALUES(1, 'Usuarios');
INSERT INTO Seccion VALUES(2, 'Viajes');
INSERT INTO Seccion VALUES(3, 'Vehiculos');
INSERT INTO Seccion VALUES(4, 'Services');
INSERT INTO Seccion VALUES(5, 'Proformas');

/*permisos rol administrador*/
INSERT INTO Rol_Seccion(id_Rol,id_Seccion,alta,baja,modificacion,lectura)
VALUES (2,1,1,1,1,1);
INSERT INTO Rol_Seccion VALUES(2,2,1,1,1,1);
INSERT INTO Rol_Seccion VALUES(2,3,1,1,1,1);
INSERT INTO Rol_Seccion VALUES(2,4,1,1,1,1);
INSERT INTO Rol_Seccion VALUES(2,5,1,1,1,1);

/*permisos rol supervisor*/
INSERT INTO Rol_Seccion(id_Rol,id_Seccion,alta,baja,modificacion,lectura)
VALUES (3,1,0,0,0,1);
INSERT INTO Rol_Seccion VALUES(3,2,1,1,1,1);
INSERT INTO Rol_Seccion VALUES(3,3,1,1,1,1);
INSERT INTO Rol_Seccion VALUES(3,4,1,1,1,1);
INSERT INTO Rol_Seccion VALUES(3,5,1,1,1,1);

/*permisos rol chofer*/
INSERT INTO Rol_Seccion(id_Rol,id_Seccion,alta,baja,modificacion,lectura)
VALUES (4,1,0,0,0,1);
INSERT INTO Rol_Seccion VALUES(4,2,0,0,1,1);
INSERT INTO Rol_Seccion VALUES(4,3,0,0,1,1);
INSERT INTO Rol_Seccion VALUES(4,4,0,0,0,1);
INSERT INTO Rol_Seccion VALUES(4,5,0,0,0,0);

INSERT INTO Tipo_Vehiculo(id_TipoVehiculo,descripcion)  VALUES (1, 'Arrastre');
INSERT INTO Tipo_Vehiculo(id_TipoVehiculo,descripcion) VALUES (2,'Tractor');
INSERT INTO Tipo_Vehiculo(id_TipoVehiculo,descripcion) VALUES (3, 'Camion');
INSERT INTO Tipo_Vehiculo(id_TipoVehiculo,descripcion) VALUES (4, 'Nada');

INSERT INTO Tipo_Semi(id_Tipo, descripcion)  VALUES (1, 'No Aplica');
INSERT INTO Tipo_Semi(id_Tipo, descripcion)  VALUES (2, 'Araña');
INSERT INTO Tipo_Semi (id_Tipo, descripcion) VALUES (3,'Jaula');
INSERT INTO Tipo_Semi (id_Tipo, descripcion) VALUES (4,'Tanque');
INSERT INTO Tipo_Semi (id_Tipo, descripcion) VALUES (5,'CarCarrier');

INSERT INTO Vehiculo(id_Tipo, id_TipoSemi, marca, modelo, patente, motor, chasis, anio_fabricacion, kilometraje, estado)
VALUES (2,1,'Iveco','','ABC123',1,'FKE345','20190320',850,'Usado');
INSERT INTO Vehiculo(id_Tipo, id_TipoSemi, marca, modelo, patente, motor, chasis, anio_fabricacion, kilometraje, estado)
VALUES (3,1, 'Iveco','' ,'JKE2034', 2 , 'hjks2345', '20180913', 1800, 'Bien');

INSERT INTO Vehiculo(id_Tipo, id_TipoSemi, marca, modelo, patente, motor, chasis, anio_fabricacion, kilometraje, estado)
VALUES (1,2, 'Iveco','Araña' ,'JKE2034', null , null, '20180913', null, 'Bien');
INSERT INTO Vehiculo(id_Tipo, id_TipoSemi, marca, modelo, patente, motor, chasis, anio_fabricacion, kilometraje, estado)
VALUES (1,2, 'Scania','Spider' ,'JKE7777', null , null, '20180914', null, 'Bien');


INSERT INTO Tipo_Service(id_service, descripcion) VALUES (1,'Revision motor');
INSERT INTO Tipo_Service VALUES (2, 'Revision interna');
INSERT INTO Tipo_Service VALUES (3, 'Revision paragolpe');


INSERT INTO Service (id_Service,id_Vehiculo,id_Usuario,id_TipoService,fecha, kilometraje,detalle,repuestos_cambiados)
VALUES (1,1,4,1,'20210403', 1900, 'Cambio de motor', 'Motor');
INSERT INTO Service VALUES (4,1,1,3,'20210402', 0, 'Verificación paragolpe', 'Daño Paragolpe'); 

INSERT INTO Tipo_Carga(id_TipoCarga, descripcion) VALUES (222, 'Granel');
INSERT INTO Tipo_Carga VALUES (333, 'Refrigerado');

INSERT INTO Tipo_Hazard ( descripcion )
VALUES ('Sin riesgo'),
       ('Explosivos'),
       ('Gases'),
       ('Líquidos inflamables'),
       ('Sustancias tóxicas');

INSERT INTO Carga(id_TipoCarga,id_TipoHazard,refrigeracion, graduacion ,peso)
VALUES(222, 1, 5, 10, 8500.0)
     ,(333, 2, 1, 15, 15000.0);

INSERT INTO Viaje(id_usuario,id_vehiculo,id_arrastre,id_carga,origen,destino,fecha_carga ,tiempo_estimadoLlegada ,codigo_qr)
VALUES(4,1,1,1,'Buenos Aires', 'Paraná', '20210520', '20210522', null)
     ,     (4,2,2,2,'La Plata', 'Río de Janeiro', '20210607', '20210612', null)
     ,     (4,2,1,1,'Río Gallegos', 'Rosario', '20210704', '20210710', null);


INSERT INTO Viaje_Detalle(id_Viaje_Detalle, id_viaje , kilometraje, latitud, longitud, fecha, combustibleCargado, peajes, extras)
VALUES (1,1, 1500, 0.0 , 0.0 ,'20210522', 1800.0, 3500.0, 1000.0)
     ,(2,2, 4500, 0.0, 0.0, '20210611', 30000.0, 10000.0, 5000.0)
     ,(3,3, 2400, 0.0, 0.0, '20210706', 7000.0, 2000.0, 100.0);

INSERT INTO Usuario (id_Usuario,id_Rol, id_Licencia, mail, clave, activo, nombre, apellido, dni, fecha_nac, codigo_licencia)
VALUES (6,4,1,'chofer2@gmail.com', '3f9406b114126f9f05c3fdf78012ae79', false, 'Pedro', 'Juarez', 30405050, '1980-07-02', 'gol153');
