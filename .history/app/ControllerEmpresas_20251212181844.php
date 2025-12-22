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
        $empresas = $this->database->getData("SELECT * FROM fctEmpresas");
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

    // Criar uma nova Empresa
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
        $resp = $this->database->setData("INSERT INTO fctEmpresas (nome, morada, contacto, 'data', cc) VALUES (:marca, :detalhes, :foto)", $p);
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
        $p['Observacoes'] = $putData['Observacoes'];
        $p['ContactoEmpresa'] = $putData['ContactoEmpresa'];


        $resp = $this->database->setData("UPDATE `fctEmpresas` SET `NIF`=:NIF,`NomeEmpresa`=:NomeEmpresa,`Cargo`=:Cargo,`ResponsavelEstagiario`=:ResponsavelEstagiario,
                                            `MoradaSede`=:MoradaSede,`ContactoEmpresa`=:ContactoEmpresa,`HorarioFuncionamento`=:HorarioFuncionamento,`Horas<|fim_middle|><|fim_middle|>

    // Deletar uma empresa
    public function delete($id)
    {
        $p['id'] = $id;

        $resp = $this->database->setData("DELETE FROM fctEmpresas WHERE id = :id", $p);
        echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    }
}
