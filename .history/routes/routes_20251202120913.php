<?php
use src\Route as Route;
use classes\authentication\Authentication;

//Zona sem autenticação
Route::get('/', function(){require _CAMINHO_TEMPLATE. "index.html";});

//Pdfs
Route::get('/pdf/modelofeito', function(){require _CAMINHO_PDF. "/caderneta_pdf.php";});
Route::get('/pdf/tabela', function(){require _CAMINHO_PDF. "/tabela.php";});
Route::get('/pdf/modelo-a4-deitada', function(){require _CAMINHO_PDF. "/tuto4";});
Route::get('/pdf/cadernetav1', function(){require _CAMINHO_PDF. "/cadernetav1.php";});
Route::get('/pdf/modelo', function(){require _CAMINHO_PDF. "/caderneta.php";});
Route::get('/pdf/modelo-a5', function(){require _CAMINHO_PDF. "/cadernetaa5.php";});
Route::get('/pdf/modelo-a4-deitada', function(){require _CAMINHO_PDF. "/cadernetaa4deitada.php";});
Route::get('/pdf/caderneta', function(){require _CAMINHO_TEMPLATE. "/pdf/caderneta_pdf.php";});


Route::get('/login', function(){require  _CAMINHO_TEMPLATE. "login.html";});
Route::get('/dc', function(){require _CAMINHO_TEMPLATE. "dc.html";});
Route::get('/menu', function(){require _CAMINHO_TEMPLATE. "aluno.menu.html";});
Route::get('/distribuir', function(){require _CAMINHO_TEMPLATE. "distribuiralunos.html";});
Route::get('/cursos', function(){require _CAMINHO_TEMPLATE. "cursos.html";});

//aluno
Route::get('/aluno/menu', function(){require _CAMINHO_TEMPLATE. "aluno.menu.html";});
Route::get('/aluno/dados', function(){require _CAMINHO_TEMPLATE. "alunos.html";});
Route::get('/aluno/empresa', function(){require _CAMINHO_TEMPLATE. "dadosEmpresa.html";});

//ano letivo
Route::get('/ano/letivo', function(){require _CAMINHO_TEMPLATE. "anoletivo.html";});

//dc
Route::get('/dc/menu', function(){require _CAMINHO_TEMPLATE. "dc.html";});
Route::get('/dc/distribuir', function(){require _CAMINHO_TEMPLATE. "distribuiralunos.html";});


//prof
Route::get('/prof/menu', function(){require _CAMINHO_TEMPLATE. "prof.menu.html";});

//dados empresa
Route::get('/prof/empresa', function(){require _CAMINHO_TEMPLATE. "dadosEmpresa.html";});


//admin
Route::get('/admin/alunos', function(){require _CAMINHO_ADM. "alunosManager.php";});
Route::post('/admin/alunos', function(){require _CAMINHO_ADM. "alunosManager.php";});
Route::get('/admin/anos-letivos', function(){require _CAMINHO_ADM. "anosLetivosManager.php";});
Route::post('/admin/anos-letivos', function(){require _CAMINHO_ADM. "anosLetivosManager.php";});
Route::get('/admin/turmas', function(){require _CAMINHO_ADM. "turmasManager.php";});
Route::post('/admin/turmas', function(){require _CAMINHO_ADM. "turmasManager.php";});
Route::get('/admin/cursos', function(){require _CAMINHO_ADM. "cursosManager.php";});
Route::post('/admin/cursos', function(){require _CAMINHO_ADM. "cursosManager.php";});


Route::get(['set' => '/base/index', 'as' => 'base.index'], 'Controller@index'); 
Route::get(['set' => '/base/show/{id}', 'as' => 'base.show'], 'Controller@show'); 

//api alunos  
Route::get(['set' => '/api/alunos', 'as' => 'alunos.getAll'], 'ControllerAlunos@getAll');
Route::get(['set' => '/api/alunos/{processo}', 'as' => 'alunos.getById'], 'ControllerAlunos@getById');
Route::post(['set' => '/api/alunos', 'as' => 'alunos.create'], 'ControllerAlunos@create');
Route::put(['set' => '/api/alunos', 'as' => 'alunos.update'], 'ControllerAlunos@update');
Route::delete(['set' => '/api/alunos/{processo}', 'as' => 'alunos.delete'], 'ControllerAlunos@delete');


//api anos letivos
Route::get(['set' => '/api/anosletivos', 'as' => 'anosletivos.getAll'], 'ControllerAnosletivos@getAll');
Route::get(['set' => '/api/anosletivos/{id}', 'as' => 'anosletivos.getById'], 'ControllerAnosletivos@getById');
Route::post(['set' => '/api/anosletivos', 'as' => 'anosletivos.create'], 'ControllerAnosletivos@create');
Route::put(['set' => '/api/anosletivos', 'as' => 'anosletivos.update'], 'ControllerAnosletivos@update');
Route::delete(['set' => '/api/anosletivos/{id}', 'as' => 'anosletivos.delete'], 'ControllerAnosletivos@delete');

//api turmas
Route::get(['set' => '/api/turmas', 'as' => 'turmas.getAll'], 'ControllerTurmas@getAll');
Route::get(['set' => '/api/turmas/{id}', 'as' => 'turmas.getById'], 'ControllerTurmas@getById');
Route::post(['set' => '/api/turmas', 'as' => 'turmas.create'], 'ControllerTurmas@create');
Route::put(['set' => '/api/turmas', 'as' => 'turmas.update'], 'ControllerTurmas@update');
Route::delete(['set' => '/api/turmas/{id}', 'as' => 'turmas.delete'], 'ControllerTurmas@delete');

//api cursos
Route::get(['set' => '/api/cursos', 'as' => 'cursos.getAll'], 'ControllerCursos@getAll');
Route::get(['set' => '/api/cursos/{id}', 'as' => 'cursos.getById'], 'ControllerCursos@getById');
Route::post(['set' => '/api/cursos', 'as' => 'cursos.create'], 'ControllerCursos@create');
Route::put(['set' => '/api/cursos', 'as' => 'cursos.update'], 'ControllerCursos@update');
Route::delete(['set' => '/api/cursos/{id}', 'as' => 'cursos.delete'], 'ControllerCursos@delete');

//api empresas
Route::get(['set' => '/api/empresas', 'as' => 'empresas.getAll'], 'ControllerEmpresas@getAll');
Route::get(['set' => '/api/empresas/{id}', 'as' => 'empresas.getById'], 'ControllerEmpresas@getById');
Route::post(['set' => '/api/empresas', 'as' => 'empresas.create'], 'ControllerEmpresas@create');
Route::put(['set' => '/api/empresas', 'as' => 'empresas.update'], 'ControllerEmpresas@update');
Route::delete(['set' => '/api/empresas/{id}', 'as' => 'empresas.delete'], 'ControllerEmpresas@delete');

//api professores
Route::get(['set' => '/api/professores', 'as' => 'professores.getAll'], 'ControllerProfessores@getAll');
Route::get(['set' => '/api/professores/{id}', 'as' => 'professores.getById'], 'ControllerProfessores@getById');
Route::post(['set' => '/api/professores', 'as' => 'professores.create'], 'ControllerProfessores@create');
Route::put(['set' => '/api/professores', 'as' => 'professores.update'], 'ControllerProfessores@update');
Route::delete(['set' => '/api/professores/{id}', 'as' => 'professores.delete'], 'ControllerProfessores@delete');

//api estagiarios
Route::get(['set' => '/api/estagiarios', 'as' => 'estagiarios.getAll'], 'ControllerEstagiarios@getAll');
Route::get(['set' => '/api/estagiarios/{id}', 'as' => 'estagiarios.getById'], 'ControllerEstagiarios@getById');
Route::post(['set' => '/api/estagiarios', 'as' => 'estagiarios.create'], 'ControllerEstagiarios@create');
Route::put(['set' => '/api/estagiarios', 'as' => 'estagiarios.update'], 'ControllerEstagiarios@update');
Route::delete(['set' => '/api/estagiarios/{id}', 'as' => 'estagiarios.delete'], 'ControllerEstagiarios@delete');



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
