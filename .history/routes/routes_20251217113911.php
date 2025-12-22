<?php

use src\Route as Route;
use classes\authentication\Authentication;

//Zona sem autenticação
Route::get('/', function () {
  require _CAMINHO_TEMPLATE . "index.html";
});

//Authentication
Route::get('/admin', function () {
  require _CAMINHO_TEMPLATE . "login.html";
});
Route::get('/admin/login', function () {
  require _CAMINHO_TEMPLATE . "login.html";
});

//menu admin
Route::get('/admin/in', function () {
  require _CAMINHO_TEMPLATE . "menu-admin.html";
});

//Pdfs
Route::get('/pdf/modelofeito', function () {
  require _CAMINHO_PDF . "/caderneta_pdf.php";
});
Route::get('/pdf/tabela', function () {
  require _CAMINHO_PDF . "/tabela.php";
});
Route::get('/pdf/cadernetav1', function () {
  require _CAMINHO_PDF . "/cadernetav1.php";
});
Route::get('/pdf/modelo', function () {
  require _CAMINHO_PDF . "/caderneta.php";
});
Route::get('/pdf/modelo-a5', function () {
  require _CAMINHO_PDF . "/cadernetaa5.php";
});
Route::get('/pdf/modelo-a4-deitada', function () {
  require _CAMINHO_PDF . "/cadernetaa4deitada.php";
});
Route::get('/pdf/caderneta', function () {
  require _CAMINHO_TEMPLATE . "/pdf/caderneta_pdf.php";
});


Route::get('/login', function () {
  require  _CAMINHO_TEMPLATE . "login.html";
});
Route::get('/menu', function () {
  require _CAMINHO_TEMPLATE . "aluno.menu.html";
});
Route::get('/cursos', function () {
  require _CAMINHO_TEMPLATE . "cursos.html";
});

//aluno
Route::get('/alunos', function () {
  require _CAMINHO_TEMPLATE . "aluno.menu.html";
});
Route::get('/aluno/dados', function () {
  require _CAMINHO_TEMPLATE . "alunos.html";
});
Route::get('/aluno/empresa', function () {
  require _CAMINHO_TEMPLATE . "dadosEmpresa.html";
});
Route::get('/alunos/{id}', function () {
  require _CAMINHO_TEMPLATE . "aluno.menu.html";
});

//############# profs ###########################
Route::get('/prof', function () {
  require _CAMINHO_TEMPLATE . "professorMenu.html";
});
Route::get('/prof/menu', function () {
  require _CAMINHO_TEMPLATE . "professorMenu.html";
});
Route::get('/prof/dados', function () {
  require _CAMINHO_TEMPLATE . "professor.php";
});
Route::get('/prof/empresa', function () {
  require _CAMINHO_TEMPLATE . "empresaDados.php";
});
Route::get('/prof/empresa/lista', function () {
  require _CAMINHO_TEMPLATE . "empresaLista.html";
});
Route::get('/prof/empresa/{nif}', function ($nif) {
  require _CAMINHO_TEMPLATE . "empresaDados.php";
});
Route::get('/prof/{id}', function () {
  require _CAMINHO_TEMPLATE . "professorMenu.html";
});
//################################################

//################ empresas ######################
Route::get('/empresa', function () {
  require _CAMINHO_TEMPLATE . "empresaMenu.html";
});

Route::get('/empresa/{id}', function () {
  require _CAMINHO_TEMPLATE . "empresaMenu.html";
});
//################################################


//################# dc ##########################
Route::get('/dc', function () {
  require _CAMINHO_TEMPLATE . "dcMenu.html";
});
Route::get('/dc/distribuir', function () {
  require _CAMINHO_TEMPLATE . "dcDistribuirAlunos.html";
});

//################################################

//ano letivo
Route::get('/ano/letivo', function () {
  require _CAMINHO_TEMPLATE . "anoletivo.html";
});





//menu inicial
Route::get('/inicial', function () {
  require _CAMINHO_TEMPLATE . "menu-inicial.html";
});

//turma
Route::get('/turma', function () {
  require _CAMINHO_TEMPLATE . "turma.html";
});


//###################### CRUDS ADMIN ########################
//admin
Route::get('/admin/alunos', function () {
  require _CAMINHO_ADM . "alunosManager.php";
});
Route::post('/admin/alunos', function () {
  require _CAMINHO_ADM . "alunosManager.php";
});
Route::get('/admin/anos-letivos', function () {
  require _CAMINHO_ADM . "anosLetivosManager.php";
});
Route::post('/admin/anos-letivos', function () {
  require _CAMINHO_ADM . "anosLetivosManager.php";
});
Route::get('/admin/turmas', function () {
  require _CAMINHO_ADM . "turmasManager.php";
});
Route::post('/admin/turmas', function () {
  require _CAMINHO_ADM . "turmasManager.php";
});
Route::get('/admin/cursos', function () {
  require _CAMINHO_ADM . "cursosManager.php";
});
Route::post('/admin/cursos', function () {
  require _CAMINHO_ADM . "cursosManager.php";
});
Route::get('/admin/empresas', function () {
  require _CAMINHO_ADM . "empresasManager.php";
});
Route::post('/admin/empresas', function () {
  require _CAMINHO_ADM . "empresasManager.php";
});
Route::get('/admin/empresas-curso', function () {
  require _CAMINHO_ADM . "empresasCursoManager.php";
});
Route::post('/admin/empresas-curso', function () {
  require _CAMINHO_ADM . "empresasCursoManager.php";
});
Route::get('/admin/documentos', function () {
  require _CAMINHO_ADM . "documentosManager.php";
});
Route::post('/admin/documentos', function () {
  require _CAMINHO_ADM . "documentosManager.php";
});
Route::get('/admin/professores', function () {
  require _CAMINHO_ADM . "professoresManager.php";
});
Route::post('/admin/professores', function () {
  require _CAMINHO_ADM . "professoresManager.php";
});
Route::get('/admin/estagiarios', function () {
  require _CAMINHO_ADM . "estagiariosManager.php";
});
Route::post('/admin/estagiarios', function () {
  require _CAMINHO_ADM . "estagiariosManager.php";
});




Route::get(['set' => '/base/index', 'as' => 'base.index'], 'Controller@index');
Route::get(['set' => '/base/show/{id}', 'as' => 'base.show'], 'Controller@show');

//api alunos  
Route::get(['set' => '/api/alunos', 'as' => 'alunos.getAll'], 'ControllerAlunos@getAll');
Route::get(['set' => '/api/alunos/{processo}', 'as' => 'alunos.getById'], 'ControllerAlunos@getById');
Route::get(['set' => '/api/alunos/curso/{curso}', 'as' => 'alunos.getByCurso'], 'ControllerAlunos@getByCurso');
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
Route::put(['set' => '/api/empresas/{NIF}/curso/{idCurso}', 'as' => 'empresas.update'], 'ControllerEmpresas@update');
Route::delete(['set' => '/api/empresas/{id}', 'as' => 'empresas.delete'], 'ControllerEmpresas@delete');

//api professores
Route::get(['set' => '/api/professores', 'as' => 'professores.getAll'], 'ControllerProfessores@getAll');
Route::get(['set' => '/api/professores/{id}', 'as' => 'professores.getById'], 'ControllerProfessores@getById');
Route::post(['set' => '/api/professores', 'as' => 'professores.create'], 'ControllerProfessores@create');
Route::put(['set' => '/api/professores', 'as' => 'professores.update'], 'ControllerProfessores@update');
Route::delete(['set' => '/api/professores/{id}', 'as' => 'professores.delete'], 'ControllerProfessores@delete');

//api estagiarios
Route::get(['set' => '/api/estagiarios', 'as' => 'estagiarios.getAll'], 'ControllerEstagiarios@getAll');
Route::get(['set' => '/api/estagiarios/ano/{ano}', 'as' => 'estagiarios.getAllporAno'], 'ControllerEstagiarios@getAllporAno');
Route::get(['set' => '/api/estagiarios/criar-ano-ativo/{curso}', 'as' => 'estagiarios.createEstagiariosAnoCurso'], 'ControllerEstagiarios@createEstagiariosAnoCurso');
Route::get(['set' => '/api/estagiarios/ano-letivo-ativo/{curso}', 'as' => 'estagiarios.getAllporAnoAtivoCurso'], 'ControllerEstagiarios@getAllporAnoAtivoCurso');
Route::get(['set' => '/api/estagiarios/ano-curso/{ano}/{curso}', 'as' => 'estagiarios.getAllporAnoCurso'], 'ControllerEstagiarios@getAllporAnoCurso');

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


//Authentication

Route::get(['set' => '/autenticacao/logout', 'as' => 'loginGoogle.logout'], 'ControllerLoginGoogle@logout');
Route::get(['set' => '/autenticacao/getAutentication', 'as' => 'LoginGoogle.getAutentication'], 'ControllerLoginGoogle@getAutentication');

Route::get(['set' => '/autenticacao/validacaoLogin', 'as' => 'LoginGoogle.logout'], 'ControllerLoginGoogle@validaLogin');
Route::post(['set' => '/autenticacao/validacaoLogin', 'as' => 'LoginGoogle.logout'], 'ControllerLoginGoogle@validaLogin');

//Autenticação
$aut = new Authentication();
if ($aut->isLoged()) {
  //Zona com autenticação
  //Users

  //Artigos
  Route::post(['set' => '/artigo/add', 'as' => 'artigos.addArtigo'], 'ControllerArtigos@addArtigo');
  Route::get(['set' => '/artigo/add', 'as' => 'artigos.addArtigo'], 'ControllerArtigos@addArtigo');
} else {
  //echo "Não tem acesso";
  //header('Location: https://www.esmonserrate.org/public/semAcesso');
  //exit;
  Route::get('/{any}', function () {
    require _CAMINHO_ERROS . "erro401.php";
  });
  Route::get('/{any}/{any}', function () {
    require _CAMINHO_ERROS . "erro401.php";
  });
  Route::get('/{any}/{any}/{any}', function () {
    require _CAMINHO_ERROS . "erro401.php";
  });
}

Route::get('/{any}', function () {
  require _CAMINHO_ERROS . "erro404.php";
});
Route::get('/{any}/{any}', function () {
  require _CAMINHO_ERROS . "erro404.php";
});
Route::get('/{any}/{any}/{any}', function () {
  require _CAMINHO_ERROS . "erro404.php";
});
