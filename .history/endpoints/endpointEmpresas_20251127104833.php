<?php
require_once 'ControllerEmpresas.php'; // ajuste o caminho correto
use app\ControllerEmpresas;

header('Content-Type: application/json');

$ctrl = new ControllerEmpresas();
$ctrl->getAll();
?>

