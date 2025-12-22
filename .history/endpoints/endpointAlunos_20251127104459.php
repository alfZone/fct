<?php
require_once '../controllers/ControllerAlunos.php'; // caminho relativo ao seu projeto
use app\ControllerAlunos;

header('Content-Type: application/json');

$ctrl = new ControllerAlunos();
$ctrl->getAll(); // retorna JSON com todos os alunos
?>
