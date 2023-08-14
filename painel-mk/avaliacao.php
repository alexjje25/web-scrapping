<?php
require_once "include/header.php";

$sql2 = "SELECT * FROM avaliacao";
$stmt2 = $PDO->prepare($sql2);
$stmt2->execute();

?>
<link href="assets/css/pace.min.css" rel="stylesheet" />
<script src="assets/js/pace.min.js"></script>
<style>
  #mkTabelaInfos tr {
    /* display: flex; */
    align-items: center;
    width: 100%;
  }

  #mkTabelaInfos tr td {
    white-space: pre-wrap !important;
    display: table-cell;
    vertical-align: middle;
  }
</style>
<div class="clearfix"></div>

<div class="content-wrapper">
  <div class="container-fluid">
    <div class="row mb-3">
      <div class="col-12 col-lg-12">
        <button type="submit" class="btn btn-success p-2" data-toggle="modal" data-target="#mkModalCadastrarAvaliacao"><i class="icon-plus"></i> Cadastrar avaliação</button>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-lg-12">
        <div class="card">
          <div class="card-header">Lista de avaliações
          </div>
          <div class="table-responsive">
            <table id="mkTabelaInfos" class="table text-center" cellpadding="0" cellspacing="0">
              <thead class="text-uppercase">
                <tr>
                  <th>id</th>
                  <th>nome</th>
                  <th>comentario</th>
                  <th>estrelas</th>
                  <th>data</th>
                  <th>ação</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($avaliacao = $stmt2->fetch(PDO::FETCH_ASSOC)) : ?>
                  <tr>
                    <td><a><?php echo $avaliacao['id'] ?></a></td>
                    <td><a><?php echo $avaliacao['nome'] ?></a></td>
                    <td><a><?php echo $avaliacao['comentario'] ?></a></td>
                    <td><a><?php echo $avaliacao['estrelas'] ?></a></td>
                    <td><a><?php echo $avaliacao['data'] ?></a></td>
                    <td><a class="btn btn-outline-danger p-2" href="assets/php/mkApagaAvaliacao.php?id=<?php echo $avaliacao['id'] ?>"><i class="icon-trash"></i> Apagar</a></td>
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


<?php
require_once "include/footer.php";
?>