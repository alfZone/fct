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

class ControllerAlunos
{

    private $conn;
    private $database;

    public function __construct()
    {
        $this->database = new Connection();
        $this->conn = $this->database->getConnection();
    }

    // Obter todos os alunos
    public function getAll()
    {
        $alunos = $this->database->getData("SELECT * FROM fctAlunos");
        echo json_encode($alunos, JSON_UNESCAPED_UNICODE);
    }

    // Obter alunos por ID
    public function getById($processo)
    {
        $p['processo'] = $processo;
        $aluno = $this->database->getData("SELECT * FROM fctAlunos WHERE Processo = :processo", $p);
        //print_r($aluno);
        if ($aluno) {
            echo json_encode($aluno, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(['msg' => 'Aluno não encontrado', 'status' => '404']);
        }
    }

    // Obter alunos por Curso
    public function getByCurso($curso)
    {
        $p['curso'] = $curso;
        $aluno = $this->database->getData("SELECT `Processo`, `Nome`, `Morada`, `Contacto`, `Email`, `DataNascimento`, `CC`, `Contribuinte`, `NomeEE`, 
                                            `ContactoEE`, `IDturma`, fctTurmas.NomeTurma, fctTurmas.IDcurso as Curso, fctTurmas.IDAnoLetivo 
                                            FROM `fctAlunos` inner join fctTurmas on fctTurmas.id=IDturma  WHERE  fctTurmas.IDcurso = :curso 
                                            ORDER BY fctTurmas.NomeTurma, Nome ", $p);
        //print_r($aluno);
        if ($aluno) {
            echo json_encode($aluno, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(['msg' => 'Aluno não encontrado', 'status' => '404']);
        }
    }


    // Criar um novo aluno
    public function create()
    {
        $p['Processo'] = $_POST['Processo'];
        $p['Nome'] = $_POST['Nome'];
        $p['Morada'] = $_POST['Morada'];
        $p['Contacto'] = $_POST['Contacto'];
        $p['Email'] = $_POST['Email'];
        $p['DataNascimento'] = $_POST['DataNascimento'];
        $p['CC'] = $_POST['CC'];
        $p['Contribuinte'] = $_POST['Contribuinte'];
        $p['NomeEE'] = $_POST['NomeEE'];
        $p['ContactoEE'] = $_POST['ContactoEE'];
        $p['IDturma'] = $_POST['IDturma'];
        $resp = $this->database->setData("INSERT INTO fctAlunos (Processo, Nome, Morada, Contacto, Email, DataNascimento, CC, Contribuinte, NomeEE, ContactoEE, IDturma) VALUES (:marca, :detalhes, :foto)", $p);
        echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    }

    // Atualizar um Aluno
    public function update()
    {
        parse_str(file_get_contents("php://input"), $putData);
        $p['marca'] = $putData['Marca'];
        $p['detalhes'] = $putData['Detalhes'];
        $p['foto'] = $putData['Foto'];
        $p['id'] = $putData['id'];

        $resp = $this->database->setData("UPDATE fctAlunos SET marca = :marca, detalhes = :detalhes, foto = :foto WHERE id = :id", $p);
        echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    }

    // Deletar um Aluno
    public function delete($id)
    {
        $p['id'] = $id;

        $resp = $this->database->setData("DELETE FROM alfCarros WHERE id = :id", $p);
        echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    }
}
