<?php
require_once 'ControllerAlunos.php'; // ajuste o caminho correto
use app\ControllerAlunos;

header('Content-Type: application/json');

$ctrl = new ControllerAlunos();
$ctrl->getAll(); // isso vai executar o método e retornar JSON
?>
