<?php
//acciones
define("LECTURA", 0);
define("ALTA", 1);
define("BAJA", 2);
define("MODIFICACION", 3);
//roles
define("SIN_ROL",1);
define("ADMINISTRADOR",2);
define("SUPERVISOR",3);
define("CHOFER",4);
define("MECANICO",5);

//vehiculos
//tipo_semi
define("NO_APLICA",1);
define("ARAÑA",2);
define("JAULA",3);
define("TANQUE",4);

//tipoVehiculo
define("ARRASTRE", 1);
define("TRACTOR", 2);

//estadoViaje
define("PENDIENTE", 1);
define("ENCURSO", 2);
define("FINALIZADO", 3);

//estadosDeVehiculos
define("REPARANDO", 1);
define("DANIADO", 2);
define("DISPONIBLE", 3);
define("NO_DISPONIBLE", 4);