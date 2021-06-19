create database Estrella;
use Estrella;

CREATE TABLE Tipo_Empleado(
                              id_tipo int not null auto_increment primary key,
                              descripcion varchar (20) not null
);

CREATE TABLE Tipo_Licencia(
                              id_tipoLicencia int not null auto_increment primary key,
                              descripcion varchar (30) not null
);

CREATE TABLE Rol(
                    id_Rol int not null auto_increment,
                    descripcion varchar(30) not null,
                    primary key (id_Rol)
);

CREATE TABLE Usuario(
                        id_Usuario int not null auto_increment,
                        id_Rol int,
                        mail varchar (30),
                        clave varchar (40),
                        activo int,
                        primary key (id_Usuario),
                        foreign key (id_Rol) references Rol (id_Rol));

CREATE TABLE Empleado(
                         id_Empleado int not null auto_increment,
                         id_Usuario int not null,
                         id_Licencia int not null,
                         id_Tipo_Empleado int not null,
                         nombre varchar (80) not null,
                         apellido varchar (80) not null,
                         dni int not null,
                         fecha_nac date,
                         codigo_licencia varchar (20) null,
                         primary key (id_Empleado),
                         foreign key (id_Usuario) references Usuario(id_Usuario),
                         foreign key (id_Licencia) references Tipo_Licencia (id_tipoLicencia),
                         foreign key (id_Tipo_Empleado) references Tipo_Empleado (id_tipo)
);

CREATE TABLE Seccion(
                        id_Seccion int,
                        descripcion varchar (80),
                        primary key(id_Seccion)
);

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

CREATE TABLE Vehículo (
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
                        id_Empleado int not null,
                        id_TipoService int not null,
                        fecha date not null,
                        kilometraje int not null,
                        detalle varchar (1000) not null ,
                        repuestos_cambiados varchar (1000) not null,
                        primary key (id_Service),
                        foreign key (id_Vehiculo) references Vehículo(id_Vehiculo),
                        foreign key (id_Empleado) references Empleado (id_Empleado),
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
                      id_empleado int not null,
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
                      foreign key (id_empleado) references Empleado(id_Empleado),
                      foreign key (id_carga) references Carga (id_Carga),
                      foreign key (id_vehiculo) references Vehículo(id_Vehiculo));

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
                               foreign key (id_viaje) references Viaje(id_Viaje)
);

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