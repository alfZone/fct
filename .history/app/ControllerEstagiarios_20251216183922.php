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

class ControllerEstagiarios
{

    private $conn;
    private $database;

    public function __construct()
    {
        $this->database = new Connection();
        $this->conn = $this->database->getConnection();
    }

    // Obter todos os estagiarios
    public function getAll()
    {
        $estagi = $this->database->getData("SELECT fctEstagiarios.`ID`, fctEstagiarios.`NIF`, fctEmpresas.NomeEmpresa, fctEstagiarios.`Processo`, fctAlunos.Nome, 
                                                fctAlunos.IDturma, fctTurmas.NomeTurma, fctTurmas.IDcurso, fctEstagiarios.`IDAnoLetivo`, fctAnosletivos.Anoletivo, 
                                                `ProcessoProf`, fctProfessores.Nome FROM `fctEstagiarios` 
                                                inner join fctAlunos on fctAlunos.Processo=fctEstagiarios.Processo 
                                                inner join fctEmpresas on fctEmpresas.NIF=fctEstagiarios.NIF 
                                                inner join fctProfessores on fctProfessores.Processo=fctEstagiarios.ProcessoProf 
                                                inner join fctAnosletivos on fctAnosletivos.ID=fctEstagiarios.IDAnoLetivo 
                                                INNER JOIN fctTurmas on fctTurmas.ID=fctAlunos.IDturma
                                                order by fctTurmas.NomeTurma, fctAlunos.Nome;");
        echo json_encode($estagi, JSON_UNESCAPED_UNICODE);
    }

    // Obter todos os estagiarios
    public function getAllporAno($ano)
    {
        $p['ano'] = $ano;
        $estagi = $this->database->getData("SELECT fctEstagiarios.`ID`, fctEstagiarios.`NIF`, fctEmpresas.NomeEmpresa, fctEstagiarios.`Processo`, fctAlunos.Nome, 
                                                fctAlunos.IDturma, fctTurmas.NomeTurma, fctTurmas.IDcurso, fctEstagiarios.`IDAnoLetivo`, fctAnosletivos.Anoletivo, 
                                                `ProcessoProf`, fctProfessores.Nome FROM `fctEstagiarios` 
                                                inner join fctAlunos on fctAlunos.Processo=fctEstagiarios.Processo 
                                                inner join fctEmpresas on fctEmpresas.NIF=fctEstagiarios.NIF 
                                                inner join fctProfessores on fctProfessores.Processo=fctEstagiarios.ProcessoProf 
                                                inner join fctAnosletivos on fctAnosletivos.ID=fctEstagiarios.IDAnoLetivo 
                                                INNER JOIN fctTurmas on fctTurmas.ID=fctAlunos.IDturma;", $p);
        echo json_encode($estagi, JSON_UNESCAPED_UNICODE);
    }

    // Obter estagiarios por ID
    public function getById($id)
    {
        $p['id'] = $id;
        $estagi = $this->database->getData("SELECT fctEstagiarios.`ID`, fctEstagiarios.`NIF`, fctEmpresas.NomeEmpresa, fctEstagiarios.`Processo`, fctAlunos.Nome, 
                                                fctAlunos.IDturma, fctTurmas.NomeTurma, fctTurmas.IDcurso, fctEstagiarios.`IDAnoLetivo`, fctAnosletivos.Anoletivo, 
                                                `ProcessoProf`, fctProfessores.Nome FROM `fctEstagiarios` 
                                                inner join fctAlunos on fctAlunos.Processo=fctEstagiarios.Processo 
                                                inner join fctEmpresas on fctEmpresas.NIF=fctEstagiarios.NIF 
                                                inner join fctProfessores on fctProfessores.Processo=fctEstagiarios.ProcessoProf 
                                                inner join fctAnosletivos on fctAnosletivos.ID=fctEstagiarios.IDAnoLetivo 
                                                INNER JOIN fctTurmas on fctTurmas.ID=fctAlunos.IDturma
                                                WHERE fctEstagiarios.`ID` = :id order by fctTurmas.NomeTurma, fctAlunos.Nome ;", $p);
        //print_r($estagiarios);
        if ($estagi) {
            echo json_encode($estagi, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(['msg' => 'Turma não encontrada', 'status' => '404']);
        }
    }

    // Criar um novo estagiario
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
        $resp = $this->database->setData("INSERT INTO fctEstagiarios (nome, morada, contacto, 'data', cc) VALUES (:marca, :detalhes, :foto)", $p);
        echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    }

    // Atualizar um estagiario
    public function update()
    {
        parse_str(file_get_contents("php://input"), $putData);
        $p['marca'] = $putData['Marca'];
        $p['detalhes'] = $putData['Detalhes'];
        $p['foto'] = $putData['Foto'];
        $p['id'] = $putData['id'];

        $resp = $this->database->setData("UPDATE fctEstagiarios SET marca = :marca, detalhes = :detalhes, foto = :foto WHERE id = :id", $p);
        echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    }

    // Deletar um estagiario
    public function delete($id)
    {
        $p['id'] = $id;

        $resp = $this->database->setData("DELETE FROM fctEstagiarios WHERE id = :id", $p);
        echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    }
}
