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

class ControllerEmpresas
{

    private $conn;
    private $database;

    public function __construct()
    {
        $this->database = new Connection();
        $this->conn = $this->database->getConnection();
    }

    // Obter todas as empresas
    public function getAll()
    {
        $empresas = $this->database->getData("SELECT * FROM fctEmpresas order by NomeEmpresa");
        echo json_encode($empresas, JSON_UNESCAPED_UNICODE);
    }

    // Obter todas as empresas
    public function getEmail()
    {
        $empresas = $this->database->getData("SELECT email, NomeEmpresa FROM fctEmpresas order by NomeEmpresa");
        echo json_encode($empresas, JSON_UNESCAPED_UNICODE);
    }

    // Obter empresas por NIF
    public function getById($NIF)
    {
        $p['NIF'] = $NIF;
        $empresas = $this->database->getData("SELECT * FROM fctEmpresas WHERE NIF = :NIF", $p);
        //print_r($empresas);
        if ($empresas) {
            echo json_encode($empresas, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(['msg' => 'Empresa não encontrada', 'status' => '404']);
        }
    }

    // Obter empresas por NIF
    public function getCursosById($NIF)
    {
        $p['NIF'] = $NIF;
        $empresas = $this->database->getData("SELECT fctEmpresasCurso.`id`, `IdCurso`, `NIF`, fctCursos.Nome, fctCursos.NomeCurto FROM `fctEmpresasCurso` 
                                                inner join fctCursos on fctCursos.ID=fctEmpresasCurso.IdCurso WHERE NIF = :NIF 
                                                order by fctCursos.Nome;", $p);
        //print_r($empresas);
        if ($empresas) {
            echo json_encode($empresas, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(['msg' => 'Empresa não encontrada', 'status' => '404']);
        }
    }

    // Adicionar empresa a um curso
    public function addEmpresaToCurso($NIF, $idCurso)
    {
        $p['IdCurso'] = $idCurso;
        $p['NIF'] = $NIF;
        //print_r($p);
        $resp = $this->database->setData("INSERT INTO fctEmpresasCurso (IdCurso, NIF) VALUES (:IdCurso, :NIF)", $p);
        echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    }


    // Criar uma nova Empresa
    public function create()
    {
        // Obter dados brutos da requisição
        $rawInput = file_get_contents("php://input");

        // Tent developers<|fim_middle|>
        $jsonData = json_decode($rawInput, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            // É JSON válido
            $_POST = $jsonData;
        } else {
            // Não é JSON, tentar como form-urlencoded (PUT tradicional)
            parse_str($rawInput, $_POST);
        }

        //print_r($_POST);

        $p['NIF'] = $_POST['NIF'];
        $p['NomeEmpresa']  = $_POST['NomeEmpresa'];
        $p['Cargo'] = $_POST['Cargo'];
        $p['Email'] = $_POST['Email'];
        $p['Telefone'] = $_POST['Telefone'];
        $p['ResponsavelEstagiario'] = $_POST['ResponsavelEstagiario'];
        $p['MoradaSede'] = $_POST['MoradaSede'];
        $p['HorarioFuncionamento'] = $_POST['HorarioFuncionamento'];
        $p['HorasDia'] = $_POST['HorasDia'];
        $p['Monitor'] = $_POST['Monitor'];
        $p['CargoMonitor'] = $_POST['CargoMonitor'];
        //$p['Observacoes'] = $_POST['Observacoes'];
        $p['ContactoEmpresa'] = $_POST['ContactoEmpresa'];

        $resp = $this->database->setData("INSERT INTO fctEmpresas (`NIF`, `NomeEmpresa`, `Cargo`, `ResponsavelEstagiario`, `MoradaSede`, `ContactoEmpresa`, 
                                            `HorarioFuncionamento`, `HorasDia`, `Monitor`, `CargoMonitor`, `Telefone`, `Observacoes`, `Email`) 
                                            VALUES (:NIF, :NomeEmpresa, :Cargo, :ResponsavelEstagiario, :MoradaSede, :ContactoEmpresa, 
                                            :HorarioFuncionamento, :HorasDia, :Monitor, :CargoMonitor, :Telefone, '', :Email)", $p);
        echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    }

    // Atualizar uma empresa
    public function update()
    {
        // Obter dados brutos da requisição
        $rawInput = file_get_contents("php://input");

        // Tent developers<|fim_middle|>
        $jsonData = json_decode($rawInput, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            // É JSON válido
            $putData = $jsonData;
        } else {
            // Não é JSON, tentar como form-urlencoded (PUT tradicional)
            parse_str($rawInput, $putData);
        }

        $p['NIF'] = $putData['NIF'];
        $p['NomeEmpresa']  = $putData['NomeEmpresa'];
        $p['Cargo'] = $putData['Cargo'];
        $p['Email'] = $putData['Email'];
        $p['Telefone'] = $putData['Telefone'];
        $p['ResponsavelEstagiario'] = $putData['ResponsavelEstagiario'];
        $p['MoradaSede'] = $putData['MoradaSede'];
        $p['HorarioFuncionamento'] = $putData['HorarioFuncionamento'];
        $p['HorasDia'] = $putData['HorasDia'];
        $p['Monitor'] = $putData['Monitor'];
        $p['CargoMonitor'] = $putData['CargoMonitor'];
        //$p['Observacoes'] = $putData['Observacoes'];
        $p['ContactoEmpresa'] = $putData['ContactoEmpresa'];


        $resp = $this->database->setData("UPDATE `fctEmpresas` SET `NomeEmpresa`=:NomeEmpresa,`Cargo`=:Cargo,`ResponsavelEstagiario`=:ResponsavelEstagiario,
                                            `MoradaSede`=:MoradaSede,`ContactoEmpresa`=:ContactoEmpresa,`HorarioFuncionamento`=:HorarioFuncionamento,`HorasDia`=:HorasDia,
                                            `Monitor`=:Monitor,`CargoMonitor`=:CargoMonitor,`Email`=:Email,`Telefone`=:Telefone
                                            WHERE NIF = :NIF", $p);
        echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    }

    // Deletar uma empresa
    public function delete($id)
    {
        $p['id'] = $id;

        $resp = $this->database->setData("DELETE FROM fctEmpresas WHERE id = :id", $p);
        echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    }
}
