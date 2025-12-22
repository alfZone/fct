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

class ControllerAlunos {

    private $conn;
    private $database;

    public function __construct() {
        $this->database = new Connection();
        $this->conn = $this->database->getConnection();
    }

    // Obter todos os alunos
    public function getAll() {
        $alunos = $this->database->getData("SELECT * FROM fctAlunos");
        echo json_encode($alunos, JSON_UNESCAPED_UNICODE);
    }

    // Obter alunos por ID
    public function getById($id) {
        $p['id']=$id;
        $aluno = $this->database->getData("SELECT * FROM fctAlunos WHERE id = :id", $p);
        //print_r($aluno);
        if ($aluno) {
            echo json_encode($aluno, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(['msg' => 'Aluno não encontrado', 'status' => '404']);
        }
    }

    // Criar um novo aluno
    public function create() {
        $p['nome']=$_POST['Nome'];
        $p['morada']=$_POST['Morada'];
        $p['contacto']=$_POST['Contacto'];
        $p['data']=$_POST['Data'];
        $p['cc']=$_POST['Cc'];
        $p['contribuinte']=$_POST['Contribuinte'];
        $p['nomeEE']=$_POST['NomeEE'];
        $p['contactoEE']=$_POST['ContactoEE'];
        $p['nProcesso']=$_POST['NProcesso'];
        $p['idTurma']=$_POST['IdTurma'];
        $resp = $this->database->setData("INSERT INTO fctAlunos (nome, morada, contacto, 'data', cc) VALUES (:marca, :detalhes, :foto)", $p);
        echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    }

    // Atualizar um carro
    public function update() {
        parse_str(file_get_contents("php://input"), $putData);
        $p['marca']=$putData['Marca'];
        $p['detalhes']=$putData['Detalhes'];
        $p['foto']=$putData['Foto'];
        $p['id']=$putData['id'];

        $resp = $this->database->setData("UPDATE alfCarros SET marca = :marca, detalhes = :detalhes, foto = :foto WHERE id = :id", $p);
        echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    }

    // Deletar um carro
    public function delete($id) {
        $p['id']=$id;

        $resp = $this->database->setData("DELETE FROM alfCarros WHERE id = :id", $p);
        echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    }

}
?>

