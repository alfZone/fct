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
$table->setTitle("Alunos Matriculados no Ano Ativo");
//SELECT `id`, `processo`, `idTurma` FROM `fctMatricula` WHERE 1
//select the table in the datebase
$table->prepareTable("fctMatricula");

//list of fields for list, new, edit and import records
$table->setFieldsAtive("id, processo, idTurma", 'list');
$table->setFieldsAtive("processo, idTurma", 'new');
$table->setFieldsAtive("processo, idTurma", 'edit');
$table->setFieldsAtive("processo, idTurma", 'csv');

//define field name passw as a password, hidding the file 
//$table->setFieldPass("Nome", 0, "md5");

//define lists of values to supplay to a field
$table->setFieldList("idTurma", 1, "SELECT fctTurmas.`ID`, concat(fctAnosletivos.Anoletivo, ' - ', `NomeTurma`) as Turma FROM `fctTurmas` 
                                        inner join fctAnosletivos on fctAnosletivos.ID=fctTurmas.IDAnoLetivo where fctAnosletivos.Ativo=1 order by `NomeTurma`;");
$table->setFieldList("processo", 1, "SELECT fctAlunos.`Processo`, concat(fctAlunos.Nome) as Nome FROM `fctAlunos` 
                                        ");
//$table->setFieldList("active",2,"1=>Active,0=>Inactive");

//the fiekd to be present as an image
//$table->setImageField("photo","../fotos/thumbs/",30);

//Link each record on the listo to external page passing the key value
//$table->setLinkPage("/public/perfil.php");


//Labels for fields
$table->setLabel('NomeEE', "Nome do Encarregado de Educação");
$table->setLabel('ContactoEE', "Contacto do Encarregado de Educação");
$table->setLabel('IDturma', "Turma");

//defines a criterion for the viewing action, where criterion is an sql (where) criterion that equals fields with values
//$table->setCriterio("type='Admin'");

//Allow multiple delections
$table->setMultiple(true);

//Set a default value to a field
//$table->setDefaultValue('fielName',$value);

//Active debug mode
$table->setDebugShow(true);

//Do what is necessary to maintain the table in an html page. Lists the data and allows you to insert new ones, edit and delete records. Use a 'do' parameter to make decisions
$table->showHTML();
