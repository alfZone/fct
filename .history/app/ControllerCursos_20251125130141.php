<?php

/**
 * @autores alf
 * @copyright 2025
 * @ver 2.0
 */


namespace app;
use src\Connection;
use PDO;

//require_once 'Database.php'; // Arquivo de conexão com a base de dados

class ControllerCursos {

    private $conn;
    private $database;

    public function __construct() {
        $this->database = new Connection();
        $this->conn = $this->database->getConnection();
    }

    // Obter todos os cursos
    public function getAll() {
        $cursos = $this->database->getData("SELECT * FROM fctCursos");
        echo json_encode($cursos, JSON_UNESCAPED_UNICODE);
    }

    // Obter cursos por ID
    public function getById($id) {
        $p['id']=$id;
        $cursos = $this->database->getData("SELECT * FROM fctCursos WHERE id = :id", $p);
        //print_r($cursos);
        if ($cursos) {
            echo json_encode($cursos, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(['msg' => 'Curso não encontrado', 'status' => '404']);
        }
    }

    // Criar um novo curso
    public function create() {
        $p['Processo']=$_POST['Processo'];
        $p['Nome']=$_POST['Nome'];
        $p['Morada']=$_POST['Morada'];
        $p['Contacto']=$_POST['Contacto'];
        $p['Email']=$_POST['Email'];
        $p['DataNascimento']=$_POST['DataNascimento'];
        $p['CC']=$_POST['CC'];
        $p['Contribuinte']=$_POST['Contribuinte'];
        $p['NomeEE']=$_POST['NomeEE'];
        $p['ContactoEE']=$_POST['ContactoEE'];
        $p['IDturma']=$_POST['IDturma'];
        $resp = $this->database->setData("INSERT INTO fctCursos (nome, morada, contacto, 'data', cc) VALUES (:marca, :detalhes, :foto)", $p);
        echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    }

    // Atualizar um curso
    public function update() {
        parse_str(file_get_contents("php://input"), $putData);
        $p['marca']=$putData['Marca'];
        $p['detalhes']=$putData['Detalhes'];
        $p['foto']=$putData['Foto'];
        $p['id']=$putData['id'];

        $resp = $this->database->setData("UPDATE fctCursos SET marca = :marca, detalhes = :detalhes, foto = :foto WHERE id = :id", $p);
        echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    }

    // Deletar um curso
    public function delete($id) {
        $p['id']=$id;

        $resp = $this->database->setData("DELETE FROM fctCursos WHERE id = :id", $p);
        echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    }

}
?>

