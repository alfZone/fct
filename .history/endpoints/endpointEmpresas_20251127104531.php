<?php
require_once '../controllers/ControllerEmpresas.php';
use app\ControllerEmpresas;

header('Content-Type: application/json');

$ctrl = new ControllerEmpresas();
$ctrl->getAll(); // retorna JSON com todas as empresas
?>
