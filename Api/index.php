<?php

date_default_timezone_set('America/Argentina/Cordoba');
error_reporting(0);

require 'RestServer.php';
require 'TestController.php';
require './controlador/Inscripciones.php';
require './controlador/Cursos.php';
require './controlador/Eventos.php';
require './controlador/Usuarios.php';
require './controlador/Localidades.php';

$server = new RestServer('debug');
$server->addClass('Controladorinscripciones');
$server->addClass('ControladorCursos');
$server->addClass('ControladorEventos');
$server->addClass('ControladorUsuarios');
$server->addClass('ControladorLocalidades');

$server->handle();
