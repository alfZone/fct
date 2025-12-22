<?php
use src\Route as Route;
use classes\authentication\Authentication;

//Zona sem autenticação
Route::get('/', function(){require _CAMINHO_TEMPLATE. "index.html";});
Route::get('/pdf', function(){require _CAMINHO_CLASSES. "/fpdf/tutorial/tuto3.php";});

Route::get(['set' => '/base/index', 'as' => 'base.index'], 'Controller@index'); 
Route::get(['set' => '/base/show/{id}', 'as' => 'base.show'], 'Controller@show'); 

//api alunos
Route::get(['set' => '/api/alunos', 'as' => 'alunos.getAll'], 'ControllerAlunos@getAll');
Route::get(['set' => '/api/alunos/{id}', 'as' => 'alunos.getById'], 'ControllerAlunos@getById');
Route::post(['set' => '/api/alunos', 'as' => 'alunos.create'], 'ControllerAlunos@create');
Route::put(['set' => '/api/alunos', 'as' => 'alunos.update'], 'ControllerAlunos@update');
Route::delete(['set' => '/api/alunos/{id}', 'as' => 'alunos.delete'], 'ControllerAlunos@delete');

//api anos letivos
Route::get(['set' => '/api/anosLetivos/{id}', 'as' => 'anosLetivos.getById'], 'ControllerAnosLetivos@getById');
Route::get(['set' => '/api/anosLetivos/{id}', 'as' => 'anosLetivos.getById'], 'ControllerAnosLetivos@getById');
Route::post(['set' => '/api/anosLetivos', 'as' => 'anosLetivos.create'], 'ControllerAnosLetivos@create');
Route::put(['set' => '/api/anosLetivos', 'as' => 'anosLetivos.update'], 'ControllerAnosLetivos@update');
Route::delete(['set' => '/api/anosLetivos/{id}', 'as' => 'anosLetivos.delete'], 'ControllerAnosLetivos@delete');

//api turmas
Route::get(['set' => '/api/turmas/{id}', 'as' => 'turmas.getById'], 'ControllerTurmas@getById');
Route::get(['set' => '/api/turmas/{id}', 'as' => 'turmas.getById'], 'ControllerTurmas@getById');
Route::post(['set' => '/api/turmas', 'as' => 'turmas.create'], 'ControllerTurmas@create');
Route::put(['set' => '/api/turmas', 'as' => 'turmas.update'], 'ControllerTurmas@update');
Route::delete(['set' => '/api/turmas/{id}', 'as' => 'turmas.delete'], 'ControllerTurmas@delete');

Route::get(['set' => '/api/cursos/{id}', 'as' => 'cursos.getById'], 'ControllerCursos@getById');


Route::get(['set' => '/api/empresas', 'as' => 'empresas.getById'], 'ControllerEmpresas@getById');


Route::get(['set' => '/api/professores', 'as' => 'professores.getById'], 'ControllerProfessores@getById');


Route::get(['set' => '/api/estagiarios/{id}', 'as' => 'estagiarios.getById'], 'ControllerEstagiarios@getById');



//api general
Route::get(['set' => '/api/{table}', 'as' => 'tables.getAll'], 'ControllerTables@getAll');
Route::get(['set' => '/api/{table}/{id}', 'as' => 'tables.getById'], 'ControllerTables@getById');
Route::post(['set' => '/api/{table}', 'as' => 'tables.create'], 'ControllerTables@create');
Route::put(['set' => '/api/{table}', 'as' => 'tables.update'], 'ControllerTables@update');
Route::delete(['set' => '/api/{table}/{id}', 'as' => 'tables.delete'], 'ControllerTables@delete');

//Artigos
Route::get(['set' => '/artigos/numeros', 'as' => 'artigos.contarArtigos'], 'ControllerArtigos@contarArtigos');
Route::get(['set' => '/artigo/{id}/ver', 'as' => 'artigos.ArtigoVer'], 'ControllerArtigos@ArtigoVer');                      //web service

//Users
Route::get(['set' => '/users/contar', 'as' => 'users.contarUsers'], 'ControllerUser@contarUsers'); 
Route::get(['set' => '/users/lista', 'as' => 'users.listOfUsers'], 'ControllerUser@listOfUsers');

//Autenticação
$aut=new Authentication();
if ($aut->isLoged()){
  //Zona com autenticação
  //Users
  
  //Artigos
  Route::post(['set' => '/artigo/add', 'as' => 'artigos.addArtigo'], 'ControllerArtigos@addArtigo'); 
  Route::get(['set' => '/artigo/add', 'as' => 'artigos.addArtigo'], 'ControllerArtigos@addArtigo'); 
}else{
  //echo "Não tem acesso";
  //header('Location: https://www.esmonserrate.org/public/semAcesso');
  //exit;
  Route::get('/{any}', function(){  require _CAMINHO_ERROS. "erro401.php";});
  Route::get('/{any}/{any}', function(){  require _CAMINHO_ERROS. "erro401.php";});
  Route::get('/{any}/{any}/{any}', function(){  require _CAMINHO_ERROS. "erro401.php";});
}

Route::get('/{any}', function(){  require _CAMINHO_ERROS. "erro404.php";});
Route::get('/{any}/{any}', function(){  require _CAMINHO_ERROS. "erro404.php";});
Route::get('/{any}/{any}/{any}', function(){  require _CAMINHO_ERROS. "erro404.php";});

?>
