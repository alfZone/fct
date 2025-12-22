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

class ControllerProfessores
{

    private $conn;
    private $database;

    public function __construct()
    {
        $this->database = new Connection();
        $this->conn = $this->database->getConnection();
    }

    // Obter todos os professores
    public function getAll()
    {
        $professores = $this->database->getData("SELECT * FROM fctProfessores");
        echo json_encode($professores, JSON_UNESCAPED_UNICODE);
    }

    // Obter professores por Processo
    public function getById($Processo)
    {
        $p['Processo'] = $Processo;
        $professores = $this->database->getData("SELECT * FROM fctProfessores WHERE Processo = :Processo", $p);
        //print_r($professores);
        if ($professores) {
            echo json_encode($professores, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(['msg' => 'Professor não encontrado', 'status' => '404']);
        }
    }

    // Criar um novo Professor
    public function create()
    {
        $p['Processo'] = $_POST['Processo'];
        $p['Nome'] = $_POST['Nome'];
        $p['Telefone'] = $_POST['Telefone'];
        $p['Email'] = $_POST['Email'];
        $p['DataNascimento'] = $_POST['DataNascimento'];
        $p['CC'] = $_POST['CC'];
        $p['Contribuinte'] = $_POST['Contribuinte'];
        $p['NomeEE'] = $_POST['NomeEE'];
        $p['ContactoEE'] = $_POST['ContactoEE'];
        $p['IDturma'] = $_POST['IDturma'];
        $resp = $this->database->setData("INSERT INTO fctProfessores (nome, morada, contacto, 'data', cc) VALUES (:marca, :detalhes, :foto)", $p);
        echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    }

    // Atualizar um Professor
    public function update()
    {
        parse_str(file_get_contents("php://input"), $putData);

        //print_r($putData);
        $input = json_decode($putData, true);
        //print_r($input);

        if (!empty($input) && ($input[0] === '{' || $input[0] === '[')) {
            // É JSON - decodificar
            $putData = json_decode($input[0], true);
            //print_r($putData);
        }

        $p['Processo'] = $putData['Processo'];
        $p['Nome'] = $putData['Nome'];
        $p['Telefone'] = $putData['Telefone'];
        $p['Email'] = $putData['Email'];

        $resp = $this->database->setData("UPDATE fctProfessores SET Nome = :Nome, Email = :Email, Telefone=:Telefone WHERE Processo = :Processo", $p);
        echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    }

    // Deletar um Professor
    public function delete($id)
    {
        $p['id'] = $id;

        $resp = $this->database->setData("DELETE FROM fctProfessores WHERE id = :id", $p);
        echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    }
}
