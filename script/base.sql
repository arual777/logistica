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
                      id_carga int not null,
                      origen varchar (30) not null,
                      destino varchar (30) not null,
                      fecha_carga date,
                      tiempo_estimadoLlegada date,
                      codigo_qr text null,
                      primary key (id_viaje),
                      foreign key (id_usuario) references Usuario(id_Usuario),
                      foreign key (id_carga) references Carga (id_Carga));


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



CREATE TABLE Costo(         id_Costo int not null auto_increment,
                            id_Viaje int not null,
                            importeReal decimal null,
                            cantidadReal int null,
                            kilometrajeReal int null,
                            latitud decimal null,
                            longitud decimal null,
                            fecha date,
                            importeEstimado decimal not null,
                            cantidadEstimada int null,
                            kilometrajeEstimado int not null,

                            primary key (id_Costo),
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
                         id_costo int not null,
                         id_cliente int not null,
                         id_viaje int not null,
                         importe decimal not null,
                         primary key (id_factura),
                         foreign key (id_costo) references Costo (id_Costo),
                         foreign key (id_cliente) references Cliente (id_Cliente),
                         foreign key (id_viaje) references Viaje (id_Viaje)
);

/*******DATOS********/
INSERT INTO Rol (descripcion)
VALUES ('sin rol'),
       ('administrador'),
       ('supervisor'),
       ('chofer'),
       ('mecanico');

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
VALUES (1,2, 1, 'test@gmail.com', '3f9406b114126f9f05c3fdf78012ae79', 1, 'jorge', 'perez', 34343434, '1980-05-05', 'cde333');
INSERT INTO Usuario VALUES (3,3 ,1,'super@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, 'Antonio', 'Gonzalez', 34563234, '1990-07-01', 'hjs123');
INSERT INTO Usuario VALUES (2,2 ,1,'admin@gmail.com', '0fd1604be5660d917f837442fcaeca49', 1, 'Jose', 'fernandez', 35663234, '1990-07-01', 'pes123');
INSERT INTO Usuario VALUES (4,4 ,1,'chofer@gmail.com', 'c06397df996adb426b5d43f33b95c2df', 1, 'Martin', 'Robertoz', 35568234, '1978-07-02', 'fif153');
INSERT INTO Usuario VALUES (5,5 ,1,'mecanico@gmail.com', 'f2bb07ee54b82f34f3f9f301115ffdf4', 1, 'Pablo', 'Lopez', 45673234, '1997-10-03', 'pjh783');

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

INSERT INTO Tipo_Carga(id_TipoCarga, descripcion) VALUES (222, 'Granel');
INSERT INTO Tipo_Carga VALUES (333, 'Refrigerado');



INSERT INTO Cliente (id_Cliente, nombre, apellido, CUIT) VALUES (1, 'Roberto', 'Gonzalez', 234567654);
INSERT INTO Cliente VALUES (2,'Esteban', 'Longchamps', 23465436);

INSERT INTO Tipo_Hazard ( descripcion )
VALUES ('Sin riesgo'),
       ('Explosivos'),
       ('Gases'),
       ('Líquidos inflamables'),
       ('Sustancias tóxicas');
       
INSERT INTO Carga(id_TipoCarga,id_TipoHazard,refrigeracion, graduacion ,peso)
VALUES(222, 1, 5, 10, 8500.0);
INSERT INTO Carga VALUES(333, 2, 1, 15, 15000.0);

INSERT INTO Viaje(id_usuario,id_carga,origen,destino,fecha_carga ,tiempo_estimadoLlegada ,codigo_qr)
VALUES(4,1,'Buenos Aires', 'Paraná', '20210520', '20210522', null);
INSERT INTO Viaje VALUES (4,2, 'La Plata', 'Río de Janeiro', '20210607', '20210612', null);
                     