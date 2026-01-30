<?php
//ver se tem id ma url

//ver o processo na variavel de sessao
@session_start();
$processo = $_SESSION['user'];


?>

<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Professor - Informação</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="/fct/templates/base/css/estilos.css" />


</head>

<body>
  <div menu="/fct/templates/base/menuTopo.html"></div>
  <header></header>
  <div class="container mt-5 mb-5 d-flex justify-content-center">
    <div class="menu-card mx-auto col-lg-5 col-md-5">
      <div id="mensagem"></div>

      <form>
        <div class="mb-3">
          <label for="nome">Nome:</label>
          <input type="text" id="nome" class="form-control form-control-lg" />
        </div>

        <div class="mb-3">
          <label for="processo">Nº Processo:</label>
          <input type="text" id="processo" class="form-control form-control-lg" />
        </div>

        <div class="mb-3">
          <label for="email">Email:</label>
          <input type="email" id="email" class="form-control form-control-lg" />
        </div>

        <div class="mb-3">
          <label for="telefone">Telefone:</label>
          <input type="text" id="telefone" class="form-control form-control-lg" />
        </div>

        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <button type="button" id="btnEnviar" class="btn btn-success btn-school" onclick="atualizarDados()">Gravar</button>
            </div>
            <div class="col-md-6">
              <button type="button" id="btnEnviar" class="btn btn-danger btn-school" onclick="location.href='../prof'">Fechar</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="footer">© 2025 Escola Esmonserrate. Todos os direitos reservados.</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://turma12r.alunos.esmonserrate.org/fct/js/code/config.js"></script>
    <script src="https://turma12r.alunos.esmonserrate.org/fct/js/code/loginGoogle.js"></script>
    <script src="/fct/js/code/html.js"></script>
    <script>
      lg = new loginGoogle();
      lg.renderAutenticaURLS();
    </script>
    <script>
  //includeHTML("head");
  includeHTML("menu");
</script>

  <script>
    const atualizarProfessor = async () => {
      //alert("aaaa")
      const response = await fetch("https://turma12r.alunos.esmonserrate.org/fct/public/api/professores/<?= $processo ?>");
      const lv = await response.json();
      document.getElementById("nome").value = lv[0].Nome;
      document.getElementById("processo").value = lv[0].Processo;
      document.getElementById("email").value = lv[0].Email;
      document.getElementById("telefone").value = lv[0].Telefone;
    };
    atualizarProfessor();

    //#####################################################

    // Configuração do fetch para PUT
    const atualizarDados = async () => {
      try {
        // Dados que serão enviados
        const dados = {
          Processo: document.getElementById("processo").value,
          Nome: document.getElementById("nome").value,
          Email: document.getElementById("email").value,
          Telefone: document.getElementById("telefone").value,
        };

        //console.log(JSON.stringify(dados));

        const response = await fetch("https://turma12r.alunos.esmonserrate.org/fct/public/api/professores", {
          method: "PUT", // Método HTTP
          headers: {
            "Content-Type": "application/json",
            Authorization: "Bearer seu-token-aqui", // Se necessário
          },
          body: JSON.stringify(dados), // Converte objeto para JSON
        });

        if (!response.ok) {
          throw new Error(`Erro HTTP: ${response.status}`);
        }

        const dadosResposta = await response.json();
        console.log("Dados atualizados:", dadosResposta);
      } catch (erro) {
        console.error("Erro ao atualizar:", erro);
      }
    };

    // Executar
    //atualizarDados();
  </script>

  <script></script>
</body>

</html>