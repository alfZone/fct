<?php
//ver se tem id ma url
if (!(isset($nif))) {
  //ver na variavel de sessao
  @session_start();
  $nif = $_SESSION['user'];
}

//echo $nif;

?>

<!doctype html>
<html lang="pt">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dados da Empresa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary: #1a3a6b;
      --success: #28a745;
      --dark-overlay: rgba(0, 0, 0, 0.55);
    }

    body {
      background: url('https://images.adsttc.com/media/images/555f/4a49/e58e/ce07/f900/013f/large_jpg/Jose_Campos_to_Joao_Franco-11.jpg?1432308290') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Inter', sans-serif;
      min-height: 100vh;
      display: flex;
      align-items: center;
    }

    /* Overlay escuro para legibilidade */
    body::before {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: var(--dark-overlay);
      z-index: 1;
    }

    .card {
      background: rgba(255, 255, 255, 0.96);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border: none;
      border-radius: 20px;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
      z-index: 2;
      position: relative;
      max-width: 900px;
      margin: 20px auto;
    }

    h2 {
      font-family: 'Playfair Display', serif;
      font-weight: 700;
      color: var(--primary);
      font-size: 2.2rem;
      text-align: center;
      margin-bottom: 2rem;
    }

    .form-label {
      font-weight: 600;
      color: #2c3e50;
      font-size: 0.95rem;
    }

    .form-control {
      border-radius: 10px;
      padding: 0.65rem 1rem;
      border: 1.5px solid #ced4da;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 0.2rem rgba(26, 58, 107, 0.15);
    }

    /* Botão fixe no fundo */
    .btn-save {
      background: var(--success);
      border: none;
      padding: 0.9rem 2.5rem;
      font-size: 1.1rem;
      font-weight: 600;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(40, 167, 69, 0.3);
      transition: all 0.3s ease;
    }

    .btn-save:hover {
      background: #218838;
      transform: translateY(-3px);
      box-shadow: 0 12px 25px rgba(40, 167, 69, 0.4);
    }

    /* Botão fixe no fundo */
    .btn-back {
      background: var(--primary);
      border: none;
      padding: 0.9rem 2.5rem;
      font-size: 1.1rem;
      font-weight: 600;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(59, 141, 207, 0.3);
      transition: all 0.3s ease;
    }

    .btn-back:hover {
      background: #341bc0ff;
      transform: translateY(-3px);
      box-shadow: 0 12px 25px rgba(81, 79, 201, 0.4);
    }

    /* Responsividade extra */
    @media (max-width: 768px) {
      .card {
        margin: 15px;
        border-radius: 15px;
      }

      h2 {
        font-size: 1.8rem;
      }
    }
  </style>
</head>

<body>

  <div class="container py-5">
    <div class="card p-5">
      <h2 class="mb-4">Ficha de Identificação da Empresa</h2>

      <form id="formEmpresa">
        <div class="row g-4">
          <div class="col-12">
            <label class="form-label">Empresa</label>
            <input type="text" class="form-control" id="empresa" required>
          </div>

          <div class="col-md-6">
            <label class="form-label">Responsável pelo Estagiário</label>
            <input type="text" class="form-control" id="resp_nome" placeholder="Primeiro Nome" required>

          </div>

          <div class="col-md-6">
            <label class="form-label">Cargo</label>
            <input type="text" class="form-control" id="cargo">
          </div>

          <div class="col-md-12">
            <label class="form-label">Sede / Morada</label>
            <textarea class="form-control" rows="3" id="sede" name="sede"></textarea>
          </div>

          <div class="col-md-12">
            <label class="form-label">Contato</label>
            <textarea class="form-control" rows="3" id="contato" name="contato"></textarea>
          </div>

          <div class="col-md-6">
            <label class="form-label">Horário de Funcionamento</label>
            <input type="text" class="form-control" id="horario" placeholder="Ex: 09:00 - 18:00">
          </div>

          <div class="col-md-6">
            <label class="form-label">Horas por Dia</label>
            <input type="text" class="form-control" id="horas" placeholder="Ex: 8">
          </div>

          <div class="col-6">
            <label class="form-label">Monitor / Orientador</label>
            <input type="text" class="form-control" id="monitor_nome" placeholder="Primeiro Nome">
          </div>

          <div class="col-md-6">
            <label class="form-label">Cargo do Monitor</label>
            <input type="text" class="form-control" id="cargo_monitor">
          </div>

          <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" id="email">
          </div>

          <div class="col-md-6">
            <label class="form-label">Telefone</label>
            <input type="text" class="form-control" id="telefone">
          </div>

          <div class="col-md-6">
            <label class="form-label">NIF</label>
            <input type="text" class="form-control" id="nif" maxlength="9">
          </div>

          <div class="col-md-2">
            <input type="number" class="form-control" id="anoLetivo" maxlength="9">
          </div>


          <div class="col-md-12">
            <div class="row" id="vagas">
              <!-- Vagas de FCT por curso serão inseridas aqui dinamicamente -->
            </div>

          </div>

          <div class="col-md-12">
            <label class="form-label">Cursos</label>
            <textarea class="form-control" rows="3" id="cursos" name="cursos" readonly></textarea>
          </div>
        </div>

        <div class="container">
          <div class="row text-end mt-5">
            <div class="col-md-4">
              <div class="form-floating">
                <select class="form-select" id="SelCurso" name="sellist">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                </select>
                <label for="sel1" class="form-label">Escolha o Curso:</label>
              </div>
              <button type="button" id="btnEnviar" class="btn btn-success btn-save" onclick="addEmpresaCurso()">Adicionar ao Curso</button>
            </div>
            <div class="col-md-4">
              <button type="button" id="btnEnviar" class="btn btn-success btn-save" onclick="updateData()">Gravar</button>
            </div>
            <div class="col-md-4">
              <button type="button" id="btnEnviar" class="btn btn-danger btn-back" onclick="location.href='../empresa/lista'">Fechar</button>
            </div>
          </div>
        </div>


      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    var ListaCursos = Array();

    // Atualiza os dados da empresa nos campos do formulário
    const atualizarEmpresa = async () => {
      //alert("aaaa")
      const response = await fetch("https://turma12r.alunos.esmonserrate.org/fct/public/api/empresas/<?= $nif; ?>");
      const lv = await response.json();
      document.getElementById("nif").value = <?= $nif; ?>;
      document.getElementById("empresa").value = lv[0].NomeEmpresa;
      document.getElementById("cargo").value = lv[0].Cargo;
      document.getElementById("email").value = lv[0].Email;
      document.getElementById("telefone").value = lv[0].Telefone;
      document.getElementById("resp_nome").value = lv[0].ResponsavelEstagiario;
      document.getElementById("sede").value = lv[0].MoradaSede;
      document.getElementById("horario").value = lv[0].HorarioFuncionamento;
      document.getElementById("horas").value = lv[0].HorasDia;
      document.getElementById("monitor_nome").value = lv[0].Monitor;
      document.getElementById("cargo_monitor").value = lv[0].CargoMonitor;
      //document.getElementById("obs").value = lv[0].Observacoes;
      document.getElementById("contato").value = lv[0].ContactoEmpresa;
    };

    // Atualiza os dados da empresa nos campos do formulário
    const atualizarAnoLetivo = async () => {
      //alert("aaaa")
      const response = await fetch("https://turma12r.alunos.esmonserrate.org/fct/public/api/anosletivos/ativo");
      const lv = await response.json();
      document.getElementById("anoLetivo").value = lv[0].ID;
    };

    // Lista todos os cursos para a caixa de seleção
    const readAPICursos = async () => {
      let strHtml = ``
      const response = await fetch("https://turma12r.alunos.esmonserrate.org/fct/public/api/cursos/")
      const dataArray = await response.json()
      for (const dataRecord of dataArray) {
        strHtml += `
                <option value="${dataRecord.ID}">${dataRecord.Nome}</option>}
                   `
      }
      document.getElementById("SelCurso").innerHTML = strHtml;
    }
    // function call

    // Lista cursos e pedir as vagar e observações por cursos
    const readAPICursosAtivos = async () => {
      let strHtml = ``
      let strHtml2 = ``
      let resp = new Array();
      const response = await fetch("https://turma12r.alunos.esmonserrate.org/fct/public/api/empresas/<?= $nif; ?>/cursos")
      //console.log("https://turma12r.alunos.esmonserrate.org/fct/public/api/empresas/<?= $nif; ?>/cursos")
      const dataArray = await response.json()
      console.log(dataArray)
      if (dataArray[0].numElements > 0) {
        for (const dataRecord of dataArray) {
          //console.log(dataRecord.IdCurso)
          document.getElementById("anoLetivo").innerHTML = dataRecord.IDAnoLetivo;
          resp = await readAPIVagarCurso(dataRecord.IdCurso, <?= $nif; ?>);
          console.log(resp)
          ListaCursos.push(dataRecord.IdCurso);
          strHtml += `${dataRecord.Nome}|`
          strHtml2 += `
          <div class="col-md-6">
            <label class="form-label">Vagas de FCT para ${dataRecord.NomeCurto}</label>
            <input type="number" class="form-control" id="vfct${dataRecord.IdCurso}" maxlength="9" value="${resp[0]}">
          </div>
          <div class="col-md-6">
            <label class="form-label">Observações para ${dataRecord.NomeCurto}</label>
           <textarea class="form-control" rows="3" id="obs${dataRecord.IdCurso}" name="obs">${resp[1]}</textarea>
          </div>
           `
        }
      }

      document.getElementById("cursos").innerHTML = strHtml;
      document.getElementById("vagas").innerHTML = strHtml2;
    }
    // function call

    // Lê as vagas e observações para um curso específico
    const readAPIVagarCurso = async (curso, nif) => {
      var resp = new Array(2);
      resp[0] = "";
      resp[1] = "";
      const response = await fetch("https://turma12r.alunos.esmonserrate.org/fct/public/api/estagiarios/vagas/" + curso + "/" + nif)
      const dataArray = await response.json()
      //console.log("https://turma12r.alunos.esmonserrate.org/fct/public/api/estagiarios/vagas/" + curso)
      //console.log(dataArray)
      if (dataArray[0].numElements * 1 > 0) {
        for (const dataRecord of dataArray) {
          //document.getElementById("vfct" + curso).value = dataRecord.NumVagas;
          //document.getElementById("obs" + curso).value = dataRecord.Obs;
          //console.log("aqui");
          resp[0] = dataRecord.NumVagas;
          resp[1] = dataRecord.Obs;
        }
      }
      //console.log(resp)
      return resp;
    }

    readAPICursosAtivos()
    readAPICursos()
    atualizarEmpresa();
    atualizarAnoLetivo();



    const addEmpresaCurso = async () => {
      try {

        var idCurso = document.getElementById("SelCurso").value;
        //alert("https://turma12r.alunos.esmonserrate.org/fct/public/api/empresas/<?= $nif; ?>/curso/" + idCurso);

        const response = await fetch("https://turma12r.alunos.esmonserrate.org/fct/public/api/empresas/<?= $nif; ?>/curso/" + idCurso, {
          method: "POST", // Método HTTP
          headers: {
            "Content-Type": "application/json",
            //Authorization: "Bearer your-token", // if necessary
          },
          //body: JSON.stringify(dataSend), // Convert data to JSON
        });

        if (!response.ok) {
          throw new Error(`Erro HTTP: ${response.status}`);
        }

        const dadosResposta = await response.json();
        console.log("Data updated:", dadosResposta);
        alert(dadosResposta.msg);
        atualizarEmpresa();
        readAPICursosAtivos()

      } catch (erro) {
        console.error("Error updating data:", erro);
      }
    };

    const updateData = async () => {
      try {
        console.log(L");
        //await updateVagas()
        // The data to send
        const dataSend = {
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
          //Observacoes: document.getElementById("obs").value,
          ContactoEmpresa: document.getElementById("contato").value
        };

        //console.log(JSON.stringify(dataSend));

        const response = await fetch("https://turma12r.alunos.esmonserrate.org/fct/public/api/empresas/", {
          method: "PUT", // Método HTTP
          headers: {
            "Content-Type": "application/json",
            Authorization: "Bearer your-token", // if necessary
          },
          body: JSON.stringify(dataSend), // Convert data to JSON
        });

        if (!response.ok) {
          throw new Error(`Erro HTTP: ${response.status}`);
        }

        const dadosResposta = await response.json();
        console.log("Data updated:", dadosResposta);
      } catch (erro) {
        console.error("Error updating data:", erro);
      }
    };

    const updateVagas = async (curso) => {
      try {
        // The data to send
        const dataSend = {
          NIF: document.getElementById("nif").value,
          NumVagas: document.getElementById("vfct" + curso).value,
          Obs: document.getElementById("obs" + curso).value,
          IdCurso: curso,
          IDAnoLetivo: document.getElementById("anoLetivo").value,
        };

        console.log(JSON.stringify(dataSend));

        const response = await fetch("https://turma12r.alunos.esmonserrate.org/fct/public/api/estagiarios/vagas", {
          method: "PUT", // Método HTTP
          headers: {
            "Content-Type": "application/json",
            Authorization: "Bearer your-token", // if necessary
          },
          body: JSON.stringify(dataSend), // Convert data to JSON
        });

        if (!response.ok) {
          throw new Error(`Erro HTTP: ${response.status}`);
        }

        const dadosResposta = await response.json();
        console.log("Data updated:", dadosResposta);
      } catch (erro) {
        console.error("Error updating data:", erro);
      }
    };
  </script>
</body>

</html>