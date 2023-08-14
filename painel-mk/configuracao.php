  <?php
  require_once "include/header.php";
  ?>
  <div class="clearfix"></div>

  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 col-lg-12">
          <div class="card">
            <div class="card-header">Configurações do site
            </div>
            <div class="table-responsive">
              <table id="mkTabelaInfos" class="table text-center" cellpadding="0" cellspacing="0">
                <thead class="text-uppercase">
                  <tr>
                    <th>Chave Pix</th>
                    <th>Titular Pix</th>
                    <th>Ultima alteração</th>
                    <th>ação</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
              <section class="avisoCarregarInfos">
                <p class="m-0 mt-3">Aguarde, estamos carregando as configurações...</p>
                <div class="spinner-border text-white" style="width: 30px; height: 30px;margin: 5px;">

                </div>
              </section>
            </div>
          </div>
        </div>
      </div>
      <div class="overlay toggle-menu"></div>
    </div>
  </div>

  <div class="modal fade" id="mkModalLinkProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Link do produto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <button class="btn btn-success p-2"><i class="icon-link"></i> Ir para link do produto</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="mkModalEditarConfiguracao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Editar configuração</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="assets/php/mkEditarConfiguracao.php" enctype="multipart/form-data">
          <input type="hidden" id="modal-data-id-editar-configuracao" name="id" value="">
            <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label">Chave Pix(receber pagamento)</label>
              <div class="col-lg-9">
                <input class="form-control" type="text" name="chave_pix" id="modal-data-chave_pix" required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label">Titular do Pix</label>
              <div class="col-lg-9">
                <input class="form-control" type="text" name="nome_titular" id="modal-data-nome_titular" required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label">Ultima alteração</label>
              <div class="col-lg-9">
                <input class="form-control" type="text" id="modal-data-data_config" disabled>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-lg-3 col-form-label form-control-label">IP da última alteração</label>
              <div class="col-lg-9">
                <input class="form-control" type="text" id="modal-data-ip" disabled>
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


  <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
  <script type="text/javascript">
    bkLib.onDomLoaded(function() {
      nicEditors.allTextAreas()
    });

    bkLib.onDomLoaded(function() {
      new nicEditor({
        fullPanel: true
      }).panelInstance('descricao');
    });

    $('#mkModalLinkProduto').on('shown.bs.modal	', function(e) {
      let btnShow = e.relatedTarget;
      let modal = e.currentTarget;
      let idLinha = $(btnShow).data('id');
      let linha = $('[row-id=' + idLinha + ']')
      $('#modal-data-id-produto').val(linha.find('.data-id').text().trim());
    });


    $('#mkModalEditarConfiguracao').on('shown.bs.modal	', function(e) {
      let btnShow = e.relatedTarget;
      let modal = e.currentTarget;
      let idLinha = $(btnShow).data('id');
      let linha = $('[row-id=' + idLinha + ']')
      $('#modal-data-id-editar-configuracao').val(linha.find('.data-id').text().trim());
      $('#modal-data-titulo_site').val(linha.find('.data-titulo_site').text().trim());
      $('#modal-data-link_site').val(linha.find('.data-link_site').text().trim());
      $('#modal-data-chave_pix').val(linha.find('.data-chave_pix').text().trim()); 
      $('#modal-data-nome_titular').val(linha.find('.data-nome_titular').text().trim());
      $('#modal-data-data_config').val(linha.find('.data-data_config').text().trim());
      $('#modal-data-email_site').val(linha.find('.data-email_site').text().trim());
      $('#modal-data-telefone_site').val(linha.find('.data-telefone_site').text().trim());
      $('#modal-data-cnpj_site').val(linha.find('.data-cnpj_site').text().trim());
      $('#modal-data-ip').val(linha.find('.data-ip').text().trim());
      $('#modal-logo_site').val(linha.find('.logo_site').text().trim());
    });

    function atualiza() {
      $.get('assets/php/mkConfiguracoes.php',
        function(resultado) {

          $('#mkTabelaInfos').find('tbody').find('tr').remove();

          const obj = JSON.parse(resultado);
          let linhaFake = '<tr row-id="##id##">';
          linhaFake += '<td><a class="data-chave_pix">##chave_pix##</a></td>';
          linhaFake += '<td><a class="data-nome_titular">##nome_titular##</a></td>';
          linhaFake += '<td><a class="data-data_config">##data##</a></td>';
          linhaFake += '<td><button class="btn btn-outline-warning p-2" data-toggle="modal" data-target="#mkModalEditarConfiguracao" data-id="##id##"><i class="icon-pencil"></i> Editar configuração</button></td>';
          
          linhaFake += '<td class="data-id" style="display:none;">##id##</td>';
          linhaFake += '<td><a class="data-email_site" style="display:none;">##email_site##</a></td>';
          linhaFake += '<td><a class="data-telefone_site" style="display:none;">##telefone_site##</a></td>';
          linhaFake += '<td><a class="data-cnpj_site" style="display:none;">##cnpj_site##</a></td>';
          linhaFake += '<td><a class="data-ip" style="display:none;">##ip##</a></td>';
          linhaFake += '<td><a class="logo_site" style="display:none;">##logo_site##</a></td>';
          
          linhaFake += '</tr>';
          let linha = '';
          let tableBody = '';

          for (let i = 0; i < obj.informacoes.length; i++) {

            linha = linhaFake;
            linha = linha.replaceAll('##id##', obj.informacoes[i].id);
            linha = linha.replaceAll('##logo_site##', obj.informacoes[i].logo_site);
            linha = linha.replaceAll('##titulo_site##', obj.informacoes[i].titulo_site);
            linha = linha.replaceAll('##link_site##', obj.informacoes[i].link_site);
            linha = linha.replaceAll('##logo_site##', obj.informacoes[i].logo_site);
            linha = linha.replaceAll('##email_site##', obj.informacoes[i].email_site);
            linha = linha.replaceAll('##telefone_site##', obj.informacoes[i].telefone_site);
            linha = linha.replaceAll('##cnpj_site##', obj.informacoes[i].cnpj_site);
            linha = linha.replaceAll('##chave_pix##', obj.informacoes[i].chave_pix);
            linha = linha.replaceAll('##nome_titular##', obj.informacoes[i].nome_titular);
            linha = linha.replaceAll('##data##', obj.informacoes[i].data);
            linha = linha.replaceAll('##ip##', obj.informacoes[i].ip);
            tableBody += linha;
          }
          $('#mkTabelaInfos').find('tbody').append(tableBody);
          $('.avisoCarregarInfos').hide();
        });

    }
    $(document).ready(function(e) {
      setInterval(function() {
        atualiza();
      }, 2000);
    });
  </script>