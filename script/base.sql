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
                          chasis varchar (80) not null,
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

CREATE TABLE Carga(
                      id_Carga int not null auto_increment,
                      id_TipoCarga int not null,
                      refrigeracion int not null,
                      graduacion int null,
                      primary key (id_Carga),
                      foreign key (id_TipoCarga) references Tipo_Carga (id_TipoCarga)
);

CREATE TABLE Viaje(
                      id_viaje int not null auto_increment,
                      id_usuario int not null,
                      id_vehiculo int not null,
                      id_carga int not null,
                      origen varchar (30) not null,
                      destino varchar (30) not null,
                      fecha_carga date,
                      fecha_viaje date,
                      tiempo_estimadoLlegada date,
                      tiempo_estimadoDeSalida date,
                      codigo_qr text,
                      primary key (id_viaje),
                      foreign key (id_usuario) references Usuario(id_Usuario),
                      foreign key (id_carga) references Carga (id_Carga),
                      foreign key (id_vehiculo) references Vehiculo(id_Vehiculo));

CREATE TABLE Costo_Real(
                           id_CostoReal int not null auto_increment,
                           id_Viaje int not null,
                           id_TipoGasto int not null,
                           importe decimal not null,
                           cantidad int not null,
                           kilometraje int not null,
                           latitud decimal not null,
                           longitud decimal not null,
                           fecha date,
                           primary key (id_CostoReal),
                           foreign key (id_TipoGasto) references Tipo_Gasto (id_Gasto),
                           foreign key (id_Viaje) references Viaje (id_Viaje));

CREATE TABLE Costo_Estimado(
                               id_CostoEstimado int not null auto_increment,
                               id_Viaje int not null,
                               id_TipoGasto int not null,
                               importe decimal not null,
                               cantidad int not null,
                               kilometraje int not null,
                               fecha date,
                               primary key (id_CostoEstimado),
                               foreign key (id_TipoGasto) references Tipo_Gasto (id_Gasto),
                               foreign key (id_Viaje) references Viaje (id_Viaje));

CREATE TABLE Posicion_Viaje(
                               id_Posicion int not null auto_increment,
                               id_viaje int not null,
                               latitud decimal not null,
                               longitud decimal not null,
                               fecha date,
                               primary key (id_Posicion),
                               foreign key (id_viaje) references Viaje(id_Viaje));

CREATE TABLE Cliente(
                        id_Cliente int not null auto_increment,
                        nombre varchar (40) not null,
                        apellido varchar (40) not null,
                        CUIT int not null,
                        primary key(id_Cliente)
);

CREATE TABLE Proforma(
                         id_factura int not null auto_increment,
                         id_costoReal int not null,
                         id_cliente int not null,
                         numero int not null,
                         nombre varchar (30) not null,
                         importe decimal not null,
                         primary key (id_factura),
                         foreign key (id_costoReal) references Costo_Real (id_CostoReal),
                         foreign key (id_cliente) references Cliente (id_Cliente)
);

/*******DATOS********/
INSERT INTO Rol (descripcion)
VALUES ('sin rol'),
       ('administrador'),
       ('supervisor'),
       ('chofer'),
       ('mecanico');

insert into tipo_licencia(descripcion) values ('sin licencia');

/**
test@gmail/testclave
super@gmail.com/123456
admin@gmail.com/252423
chofer@gmail.com/344654
mecanico@gmail.com/261158
**/
INSERT INTO Usuario (id_Usuario,id_Rol, id_Licencia, mail, clave, activo, nombre, apellido, dni, fecha_nac, codigo_licencia)
VALUES (1,1, 1, 'test@gmail.com', '3f9406b114126f9f05c3fdf78012ae79', 1, 'jorge', 'perez', 34343434, '1980-05-05', 'cde333');
INSERT INTO Usuario VALUES (3,3 ,1,'super@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, 'Antonio', 'Gonzalez', 34563234, '1990-07-01', 'hjs123');
INSERT INTO Usuario VALUES (2,2 ,1,'admin@gmail.com', '0fd1604be5660d917f837442fcaeca49', 1, 'Jose', 'fernandez', 35663234, '1990-07-01', 'pes123');
INSERT INTO Usuario VALUES (4,4 ,1,'chofer@gmail.com', 'c06397df996adb426b5d43f33b95c2df', 1, 'Martin', 'Robertoz', 35568234, '1978-07-02', 'fif153');
INSERT INTO Usuario VALUES (5,5 ,1,'mecanico@gmail.com', 'f2bb07ee54b82f34f3f9f301115ffdf4', 1, 'Pablo', 'Lopez', 45673234, '1997-10-03', 'pjh783');

INSERT INTO Seccion VALUES(1, 'Usuarios');
INSERT INTO Seccion VALUES(2, 'Viajes');
INSERT INTO Seccion VALUES(3, 'Vehiculos');
INSERT INTO Seccion VALUES(4, 'Services');

INSERT INTO Rol_Seccion(id_Rol,id_Seccion,alta,baja,modificacion,lectura)
VALUES (1,1,0,0,0,0);
INSERT INTO Rol_Seccion VALUES(2,1,1,1,1,1);
INSERT INTO Rol_Seccion VALUES(3,1,0,0,1,1);
INSERT INTO Rol_Seccion VALUES(4,1,0,0,1,1);
INSERT INTO Rol_Seccion VALUES(5,1,0,0,1,1);


INSERT INTO Tipo_Vehiculo(id_TipoVehiculo,descripcion) VALUES (1,'Tractor');
INSERT INTO Tipo_Vehiculo VALUES (2, 'Camion');

INSERT INTO Tipo_Semi(id_Tipo,descripcion) VALUES (1, 'Semiremolque');
INSERT INTO Tipo_Semi VALUES (2,'Acoplado');

INSERT INTO Vehiculo(id_Vehiculo, id_Tipo, id_TipoSemi, marca, modelo, patente, motor, chasis, anio_fabricacion, kilometraje, estado)
VALUES (1,1,1,'Iveco','','ABC123',1,'FKE345','20190320',850,'Usado');
INSERT INTO Vehiculo VALUES (2,2,2, 'Iveco','' ,'JKE2034', 2 , 'hjks2345', '20180913', 1800, 'Bien');

INSERT INTO Tipo_Service(id_service, descripcion) VALUES (1,'Revision motor');
INSERT INTO Tipo_Service VALUES (2, 'Revision interna');
INSERT INTO Tipo_Service VALUES (3, 'Revision paragolpe');

INSERT INTO Service(id_Service, id_Vehiculo, id_Usuario, id_TipoService, fecha, kilometraje, detalle, repuestos_cambiados)
VALUES (1,1,4,1,'20210618', 850, 'Funciona ok', 'Motor');
INSERT INTO Service VALUES (2,2,4,2,'20210601',1900,'Reparación valvulas', 'Valvula nueva');

INSERT INTO Tipo_Gasto(id_Gasto, descripcion) VALUES (123,'Estimado');
INSERT INTO Tipo_Gasto(id_Gasto,descripcion) VALUES (234, 'Real');

INSERT INTO Tipo_Carga(id_TipoCarga, descripcion) VALUES (222, 'Granel');
INSERT INTO Tipo_Carga VALUES (333, 'Refrigerado');

INSERT INTO Carga (id_Carga, id_TipoCarga, refrigeracion, graduacion)
VALUES (1,222, 1, 2);
INSERT INTO Carga VALUES (2,333, 2,3);

INSERT INTO Viaje(id_viaje, id_usuario, id_vehiculo, id_carga, origen, destino, fecha_carga, fecha_viaje, tiempo_estimadoLlegada, tiempo_estimadoDeSalida, codigo_qr)
VALUES (1,1,1,1,'Buenos Aires', 'Parana', '20210304','20210305','20210307', '20210308','');
INSERT INTO Viaje VALUES (2,2,2,2,'La Pampa','Rio de Janeiro', '20210501', '20210503', '20210515',  '20210518','');

INSERT INTO Costo_Real(id_CostoReal, id_Viaje, id_TipoGasto, importe, cantidad, kilometraje, latitud, longitud, fecha)
VALUES (1,2,234, 80000.0, 1000,1300,80.0,20.0,'20210307');

INSERT INTO Costo_Estimado(id_CostoEstimado, id_Viaje, id_TipoGasto, importe, cantidad, kilometraje, fecha)
VALUES (2,1,123, 9000.0, 2340,1400,'20210308');

INSERT INTO Posicion_Viaje (id_Posicion, id_viaje, latitud, longitud, fecha)
VALUES (1,1,54.0,23.0,'20210308');
INSERT INTO Posicion_Viaje VALUES (2,2,67.0,24.0,'20210501');

INSERT INTO Cliente (id_Cliente, nombre, apellido, CUIT) VALUES (1, 'Roberto', 'Gonzalez', 234567654);
INSERT INTO Cliente VALUES (2,'Esteban', 'Longchamps', 23465436);

INSERT INTO Proforma (id_factura, id_costoReal, id_cliente, numero, nombre, importe)
VALUES (1,1,1,5,'Roberto', 9000.0);
INSERT INTO Proforma VALUES (2,1,2,6,'Esteban', 15000.0);
