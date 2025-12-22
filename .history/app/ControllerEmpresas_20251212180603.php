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

class ControllerEmpresas {

    private $conn;
    private $database;

    public function __construct() {
        $this->database = new Connection();
        $this->conn = $this->database->getConnection();
    }

    // Obter todas as empresas
    public function getAll() {
        $empresas = $this->database->getData("SELECT * FROM fctEmpresas");
        echo json_encode($empresas, JSON_UNESCAPED_UNICODE);
    }

    // Obter empresas por NIF
    public function getById($NIF) {
        $p['NIF']=$NIF;
        $empresas = $this->database->getData("SELECT * FROM fctEmpresas WHERE NIF = :NIF", $p);
        //print_r($empresas);
        if ($empresas) {
            echo json_encode($empresas, JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(['msg' => 'Empresa não encontrada', 'status' => '404']);
        }
    }

    // Criar uma nova Empresa
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
        $resp = $this->database->setData("INSERT INTO fctEmpresas (nome, morada, contacto, 'data', cc) VALUES (:marca, :detalhes, :foto)", $p);
        echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    }

    // Atualizar uma empresa
    public function update() {
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

         NIF: document.getElementById("nif").value,
          NomeEmpresa: document.getElementById("empresa").value,
          Cargo: document.getElementById("cargo").value,
          Email: document.getElementById("email").value,
          Telefone: document.getElementById("telefone").value,
          ResponsavelEstagiario: document.getElementById("resp_nome").value,
          MoradaSede: document.getElementById("sede").value,
          HorarioFuncionamento: document.getElementById("horario").value,
          HorasDia: document.getElementById("horas").value,
          Monitor: document.getElementById("monitor_nome").value,
          CargoMonitor: document.getElementById("cargo_monitor").value,
          Observacoes: document.getElementById("obs").value,
          ContactoEmpresa: document.getElementById("contato").value


        $p['marca']=$putData['Marca'];
        $p['detalhes']=$putData['Detalhes'];
        $p['foto']=$putData['Foto'];
        $p['id']=$putData['id'];

        $resp = $this->database->setData("UPDATE fctEmpresas SET marca = :marca, detalhes = :detalhes, foto = :foto WHERE id = :id", $p);
        echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    }

    // Deletar uma empresa
    public function delete($id) {
        $p['id']=$id;

        $resp = $this->database->setData("DELETE FROM fctEmpresas WHERE id = :id", $p);
        echo json_encode($resp, JSON_UNESCAPED_UNICODE);
    }

}
?>

