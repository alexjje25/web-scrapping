  <?php
  require_once "include/header.php";
  

  $id = "1";
  $PDO = db_connect();
  $sql = "SELECT * FROM configuracoes WHERE id = :id";
  $stmt = $PDO->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $info = $stmt->fetch(PDO::FETCH_ASSOC);

  $sql2 = "SELECT * FROM produtos";
  $stmt2 = $PDO->prepare($sql2);
  $stmt2->execute();
  ?>
  <link href="assets/css/pace.min.css" rel="stylesheet" />
  <script src="assets/js/pace.min.js"></script>
  
  <div class="clearfix"></div>

  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row mb-3">
        <div class="col-12 col-lg-12">
          <button type="submit" class="btn btn-success p-2" data-toggle="modal" data-target="#mkModalCadastrarProduto"><i class="icon-plus"></i> Cadastrar novo Produto</button>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-lg-12">
          <div class="card">
            <div class="card-header">Lista de produtos cadastrados
            </div>
            <div class="table-responsive">
              <table id="mkTabelaInfos" class="table text-center" cellpadding="0" cellspacing="0">
                <thead class="text-uppercase">
                  <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Foto</th>
                    <th>preço final</th>
                    <th>quantidade</th>
                    <th>data cadastro</th>
                    <th>ação</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($produto = $stmt2->fetch(PDO::FETCH_ASSOC)) : ?>
                    <tr>
                      <td style="font-size: 16px !important; font-weight: bold;"><?php echo $produto['id'] ?></td>
                      <td style="width: 350px"><a><?php echo $produto['titulo_produto'] ?></a></td>
                      <td><img width="60" src="data:image/png;base64,<?php echo $produto['imagem1'] ?>"></td>
                      <td><a><?php echo $produto['preco_desconto'] ?></a></td>
                      <td><a><?php echo $produto['quantidade_estoque'] ?></a></td>
                      <td><a><?php echo $produto['data'] ?></a></td>
                      <td class="d-flex pt-4 justify-content-center">
                        <a class="btn btn-outline-success p-2 m-1" target="_blank" href="<?php echo $info['link_site']; ?>produto.php?id=<?php echo $produto['id'] ?>&titulo=<?php echo trim(preg_replace('/[^a-z0-9]+/', '-', strtolower($produto['titulo_produto'])), '-'); ?>"><i class="icon-link"></i> Link</a>
                        <button class="btn btn-outline-warning p-2 m-1" data-toggle="modal" data-target="#mkModalEditarProduto"><i class="icon-pencil"></i> Editar</button>
                        <a class="btn btn-outline-danger p-2 m-1" href="assets/php/mkApagarProduto.php?id=<?php echo $produto['id'] ?>"><i class="icon-trash"></i> Apagar</a>
                      </td>

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
  <div class="modal fade" id="mkModalCadastrarProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cadastro de produto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="assets/php/mkCadastroProduto.php" enctype="multipart/form-data">
            <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label">Titulo do produto</label>
              <div class="col-lg-9">
                <input class="form-control" type="text" name="titulo_produto" required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-4 col-form-label form-control-label">Valor do Produto(ex:1500)</label>
              <div class="col-lg-8">
                <input class="form-control" type="tel" name="valor_produto" required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-4 col-form-label form-control-label">Quantidade Parcela</label>
              <div class="col-lg-8">
                <select name="parcelas" class="form-control">
                  <option selected value="1">1x</option>
                  <option value="2">2x</option>
                  <option value="3">3x</option>
                  <option value="4">4x</option>
                  <option value="5">5x</option>
                  <option value="6">6x</option>
                  <option value="7">7x</option>
                  <option value="8">8x</option>
                  <option value="9">9x</option>
                  <option value="10">10x</option>
                  <option value="11">11x</option>
                  <option value="12">12x</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-4 col-form-label form-control-label">Porcentagem de Desconto</label>
              <div class="col-lg-8">
                <input class="form-control" type="text" name="porcentagem_desconto" minlength="1" maxlength="2" required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-4 col-form-label form-control-label">Quantidade de produto</label>
              <div class="col-lg-8">
                <input class="form-control" type="text" name="quantidade_estoque" required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label">Descrição do Produto</label>
              <div class="col-lg-9">
                <textarea name="descricao" id="descricao" style="width:340px;height:200px;">

                </textarea>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label">Imagem 1</label>
              <div class="col-lg-9">
                <input class="form-control" type="file" required name="mkImgSlider1" id="mkImgSlider1">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label">Imagem 2</label>
              <div class="col-lg-9">
                <input class="form-control" type="file" required name="mkImgSlider2" id="mkImgSlider2">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label">Imagem 3</label>
              <div class="col-lg-9">
                <input class="form-control" type="file" required name="mkImgSlider3" id="mkImgSlider3">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label">Imagem 4</label>
              <div class="col-lg-9">
                <input class="form-control" type="file" required name="mkImgSlider4" id="mkImgSlider4">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label"></label>
              <div class="col-lg-9 mt-4">
                <input type="submit" class="btn btn-success" value="Cadastrar" name="Cadastrar" id="Cadastrar">
                <input type="reset" class="btn btn-danger" value="Cancelar">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="mkModalEditarProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edição de produto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="assets/php/mkEditarProduto.php" enctype="multipart/form-data">
            <input type="hidden" id="modal-data-id-editar-produto" name="id" value="">
            <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label">Preço Real</label>
              <div class="col-lg-9">
                <input class="form-control" type="tel" name="preco_real" required id="modal-data-id-preco_real" value="">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label">Preço com Desconto</label>
              <div class="col-lg-9">
                <input class="form-control" type="tel" name="preco_desconto" id="modal-data-id-preco_desconto" value="" required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label">Porcentagem de Desconto</label>
              <div class="col-lg-9">
                <input class="form-control" type="text" name="porcentagem_desconto" id="modal-data-id-porcentagem_desconto" value="" required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label">Quantidade de produto</label>
              <div class="col-lg-9">
                <input class="form-control" type="text" name="quantidade_estoque" id="modal-data-id-quantidade_estoque" required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label"></label>
              <div class="col-lg-9 mt-4">
                <input type="submit" class="btn btn-success" value="Salvar" name="Cadastrar" id="Cadastrar" disabled>
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
  <style>
    #mkTabelaInfos tr {
      align-items: center;
      width: 100%;
    }

    #mkTabelaInfos tr td {
      white-space: pre-wrap !important;
      display: table-cell;
      vertical-align: middle;
    }
  </style>


  <script type="text/javascript" src="https://js.nicedit.com/nicEdit-latest.js"></script>
  <script type="text/javascript">
    bkLib.onDomLoaded(function() {
      nicEditors.allTextAreas()
    });

    bkLib.onDomLoaded(function() {
      new nicEditor({
        fullPanel: true
      }).panelInstance('descricao');
    });
  </script>