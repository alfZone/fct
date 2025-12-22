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

    // Obter os estagiarios por ano letivo
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
                                                INNER JOIN fctTurmas on fctTurmas.ID=fctAlunos.IDturma
                                                WHERE fctEstagiarios.`IDAnoLetivo` = :ano 
                                                order by fctTurmas.NomeTurma, fctAlunos.Nome ;", $p);
        echo json_encode($estagi, JSON_UNESCAPED_UNICODE);
    }

    // Obter os estagiarios por ano letivo e curso
    public function getAllporAnoCurso($ano, $curso)
    {
        $p['ano'] = $ano;
        $p['curso'] = $curso;
        $estagi = $this->database->getData("SELECT fctEstagiarios.`ID`, fctEstagiarios.`NIF`, fctEmpresas.NomeEmpresa, fctEstagiarios.`Processo`, fctAlunos.Nome, 
                                                fctAlunos.IDturma, fctTurmas.NomeTurma, fctTurmas.IDcurso, fctEstagiarios.`IDAnoLetivo`, fctAnosletivos.Anoletivo, 
                                                `ProcessoProf`, fctProfessores.Nome FROM `fctEstagiarios` 
                                                inner join fctAlunos on fctAlunos.Processo=fctEstagiarios.Processo 
                                                inner join fctEmpresas on fctEmpresas.NIF=fctEstagiarios.NIF 
                                                inner join fctProfessores on fctProfessores.Processo=fctEstagiarios.ProcessoProf 
                                                inner join fctAnosletivos on fctAnosletivos.ID=fctEstagiarios.IDAnoLetivo 
                                                INNER JOIN fctTurmas on fctTurmas.ID=fctAlunos.IDturma
                                                WHERE fctEstagiarios.`IDAnoLetivo` = :ano and fctTurmas.IDcurso = :curso
                                                order by fctTurmas.NomeTurma, fctAlunos.Nome ;", $p);
        echo json_encode($estagi, JSON_UNESCAPED_UNICODE);
    }

    // Obter os estagiarios por ano letivo e curso
    public function getAllporAnoAtivoCurso($curso)
    {
        $p['curso'] = $curso;
        $estagi = $this->database->getData("SELECT fctEstagiarios.`ID`, fctEstagiarios.`NIF`, fctEmpresas.NomeEmpresa, fctEstagiarios.`Processo`, fctAlunos.Nome, 
                                                fctAlunos.IDturma, fctTurmas.NomeTurma, fctTurmas.IDcurso, fctEstagiarios.`IDAnoLetivo`, fctAnosletivos.Anoletivo, 
                                                `ProcessoProf`, fctProfessores.Nome, fctAnosletivos.Ativo FROM `fctEstagiarios` 
                                                inner join fctAlunos on fctAlunos.Processo=fctEstagiarios.Processo 
                                                inner join fctEmpresas on fctEmpresas.NIF=fctEstagiarios.NIF 
                                                inner join fctProfessores on fctProfessores.Processo=fctEstagiarios.ProcessoProf 
                                                inner join fctAnosletivos on fctAnosletivos.ID=fctEstagiarios.IDAnoLetivo 
                                                INNER JOIN fctTurmas on fctTurmas.ID=fctAlunos.IDturma
                                                WHERE fctAnosletivos.Ativo and fctTurmas.IDcurso = :curso
                                                order by fctTurmas.NomeTurma, fctAlunos.Nome ;", $p);
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
                                                WHERE fctEstagiarios.`ID` = :id 
                                                order by fctTurmas.NomeTurma, fctAlunos.Nome ;", $p);
        //print_r($estagiarios);
        if ($estagi) {
            echo json_encode($estagi, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(['msg' => 'Turma não encontrada', 'status' => '404']);
        }
    }

    // Criar um novo estagiario
    public function createEstagiariosAnoCurso($curso)
    {
        $p['curso'] = $curso;
        $n = 0;
        $aluno = $this->database->getData("SELECT `Processo`, fctAlunos.Nome, fctTurmas.IDcurso as Curso, fctTurmas.IDAnoLetivo, fctTurmas.NomeTurma, fctAlunos.IDturma 
                                            FROM `fctAlunos` inner join fctTurmas on fctTurmas.id=IDturma 
                                            INNER join fctAnosletivos on fctAnosletivos.ID= fctTurmas.IDAnoLetivo 
                                            WHERE fctTurmas.IDcurso = :curso 
                                            ORDER BY fctTurmas.NomeTurma, Nome;", $p);
        //print_r($aluno);
        if ($aluno[0]['numElements'] > 0) {
            foreach ($aluno as $estagiario) {
                $pEstagiario['processo'] = $estagiario['Processo'];
                $pEstagiario['anoletivo'] = $estagiario['IDAnoLetivo'];
                //ver se o registo já existe
                $existe = $this->database->getData("SELECT ID FROM fctEstagiarios WHERE Processo=:processo AND IDAnoLetivo=:anoletivo", $pEstagiario);
                if ($existe[0]['numElements'] == 0) {
                    $resp = $this->database->setData("INSERT INTO `fctEstagiarios`(`NIF`, `Processo`, `IDAnoLetivo`, `ProcessoProf`) VALUES ('1',:processo,:anoletivo,'1')", $pEstagiario);
                    $n++;
                }
            }
        }
        $data[0]['numElements'] = $n;
        $data[0]['msg'] = $n . ' estagiarios criados com sucesso.';
        $data[0]['status'] = '200';

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
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
