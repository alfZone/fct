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

class ControllerTurmas {

    private $conn;
    private $database;

    public function __construct() {
        $this->database = new Connection();
        $this->conn = $this->database->getConnection();
    }

    // Obter todos as turmas
    public function getAll() {
        $turmas = $this->database->getData("SELECT * FROM fctTurmas");
        echo json_encode($turmas, JSON_UNESCAPED_UNICODE);
    }

    // Obter turmas por ID
    public function getById($id) {
        $p['id']=$id;
        $turmas = $this->database->getData("SELECT * FROM fctTurmas WHERE id = :id", $p);
        //print_r($turmas);
        if ($turmas) {
            echo json_encode($turmas, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(['msg' => 'Turma não encontrada', 'status' => '404']);
        }
    }

    // Criar uma nova turma
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
        $resp = $this->database->setData("INSERT INTO fctTurmas (nome, morada, contacto, 'data', cc) VALUES (:marca, :detalhes, :foto)", $p);
        echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    }

    // Atualizar uma turma
    public function update() {
        parse_str(file_get_contents("php://input"), $putData);
        $p['marca']=$putData['Marca'];
        $p['detalhes']=$putData['Detalhes'];
        $p['foto']=$putData['Foto'];
        $p['id']=$putData['id'];

        $resp = $this->database->setData("UPDATE fctTurmas SET marca = :marca, detalhes = :detalhes, foto = :foto WHERE id = :id", $p);
        echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    }

    // Deletar uma turma
    public function delete($id) {
        $p['id']=$id;

        $resp = $this->database->setData("DELETE FROM fctTurmas WHERE id = :id", $p);
        echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    }

}
?>

