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
//$table->setTemplate(_CAMINHO_CLASSES . "/db/TableBD.html");
$table->setTemplate(_CAMINHO_TEMPLATE . "/tabela.html");

//Set title of the list
$table->setTitle("Cursos acompanhados pelos Professores");
//SELECT `Processo`, `Nome`, `Morada`, `Contacto`, `Email`, `DataNascimento`, `CC`, `Contribuinte`, `NomeEE`, `ContactoEE`, `IDturma` FROM `fctAlunos` WHERE 1
//select the table in the datebase
$table->prepareTable("fctProfessoresCurso");

//list of fields for list, new, edit and import records
$table->setFieldsAtive("id, processo, idCurso, ativo", 'list');
$table->setFieldsAtive("processo, idCurso, ativo", 'new');
$table->setFieldsAtive("processo, idCurso, ativo", 'edit');
$table->setFieldsAtive("processo, idCurso, ativo", 'csv');

//define field name passw as a password, hidding the file 
//$table->setFieldPass("passw",0, "md5");

//define lists of values to supplay to a field
$table->setFieldList("idCurso", 1, " SELECT `ID`,`Nome` FROM `fctCursos` order by `Nome`");
$table->setFieldList("processo", 1, " SELECT `Processo`, `Nome` FROM `fctProfessores` order by `Nome`");
$table->setFieldList("ativo",2,"1=>Ativo,0=>Inativo");

//the fiekd to be present as an image
//$table->setImageField("photo","../fotos/thumbs/",30);

//Link each record on the listo to external page passing the key value
//$table->setLinkPage("/public/perfil.php");


//Labels for fields
/* $table->setLabel('NomeEE',"Nome do Encarregado de Educação");
$table->setLabel('ContactoEE',"Contacto do Encarregado de Educação");
$table->setLabel('IDturma',"Turma"); */

//defines a criterion for the viewing action, where criterion is an sql (where) criterion that equals fields with values
if (isset($prof)){
 $table->setCriterio("processo='".$prof."'");  
 $table->setDefaultValue('processo',$prof); 
 $table->setFieldList("processo", 1, " SELECT `Processo`,`Nome` FROM `fctProfessores` where Processo='".$prof."'order by `Nome`");
}
//;

//Allow multiple delections
$table->setMultiple(true);

//Set a default value to a field
//$table->setDefaultValue('fielName',$value);

//Active debug mode
//$table->setDebugShow(true); 

//Do what is necessary to maintain the table in an html page. Lists the data and allows you to insert new ones, edit and delete records. Use a 'do' parameter to make decisions
$table->showHTML();
