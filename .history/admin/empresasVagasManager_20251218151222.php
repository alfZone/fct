<?php
//@session_start();
ini_set("error_reporting", E_ALL);

//require __DIR__ . '/../config.php';
//require __DIR__ . '/../autoload.php';
//require __DIR__ . '/../bootstrap.php';
//use classes\authentication\Authentication;
//use classes\db\Database;
use classes\db\TableBD;


//Create an object 
$table = new TableBD();

//Set the path for the html template
$table->setTemplate(_CAMINHO_CLASSES . "/db/TableBD.html");

//Set title of the list
$table->setTitle("Vagas para Empresas");
//SELECT `Processo`, `Nome`, `Morada`, `Contacto`, `Email`, `DataNascimento`, `CC`, `Contribuinte`, `NomeEE`, `ContactoEE`, `IDturma` FROM `fctAlunos` WHERE 1
//select the table in the datebase
$table->prepareTable("fctVagasAnoEmpresa");

//list of fields for list, new, edit and import records
$table->setFieldsAtive("id, NIF, IdCurso, NumVagas, Obs", 'list');
$table->setFieldsAtive("NIF, IdCurso, NumVagas, Obs", 'new');
$table->setFieldsAtive("IdCurso,NIF", 'edit');
$table->setFieldsAtive("IdCurso,NIF", 'csv');

//define field name passw as a password, hidding the file 
//$table->setFieldPass("passw",0, "md5");

//define lists of values to supplay to a field
$table->setFieldList("NIF", 1, " SELECT `NIF`, `NomeEmpresa` FROM `fctEmpresas` order by `NomeEmpresa`;");
$table->setFieldList("IdCurso", 1, " SELECT `ID`, `Nome` FROM `fctCursos` order by Nome;");
//$table->setFieldList("active",2,"1=>Active,0=>Inactive");

//the fiekd to be present as an image
//$table->setImageField("photo","../fotos/thumbs/",30);

//Link each record on the listo to external page passing the key value
//$table->setLinkPage("/public/perfil.php");


//Labels for fields
$table->setLabel('NIF', "Empresa");
$table->setLabel('IdCurso', "Curso");

//defines a criterion for the viewing action, where criterion is an sql (where) criterion that equals fields with values
//$table->setCriterio("type='Admin'");

//Allow multiple delections
$table->setMultiple(true);

//Set a default value to a field
//$table->setDefaultValue('fielName',$value);

//Active debug mode
//$table->setDebugShow(true); 

//Do what is necessary to maintain the table in an html page. Lists the data and allows you to insert new ones, edit and delete records. Use a 'do' parameter to make decisions
$table->showHTML();
