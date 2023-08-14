<?php
require_once "include/header.php";
?>
<div class="clearfix"></div>

<div class="content-wrapper">
  <div class="container-fluid">
    <div class="row mb-3">
      <div class="col-12 col-lg-12">
        <button type="submit" class="btn btn-danger p-2" data-toggle="modal" data-target="#mkModalListaIpBloqueado"><i class="icon-minus"></i> lista bloqueados</button>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-lg-12">
        <div class="card">
          <div class="card-header">Lista de acessos
          </div>
          <div class="table-responsive">
            <table id="mkTabelaInfos" class="table text-center" cellpadding="0" cellspacing="0">
              <thead class="text-uppercase">
                <tr>
                  <th>ip</th>
                  <th>data</th>
                  <th>região</th>
                  <th>dispositivo</th>
                  <th>sistema</th>
                  <th>ação</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
            <section class="avisoCarregarInfos">
              <p class="m-0 mt-3">Aguarde, estamos carregando os acessos...</p>
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

<div class="modal fade" id="mkModalListaIpBloqueado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Lista de Ips Bloqueados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="mkModalBloquearIp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bloquear acesso IP</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="assets/php/mkEditarConfiguracao.php" enctype="multipart/form-data">
          <input type="hidden" id="modal-data-id-bloquear" name="id" value="">
          <div class="form-group row">
            <label class="col-lg-3 col-form-label form-control-label">IP</label>
            <div class="col-lg-9">
              <input class="form-control" type="tel" name="ipblock" required id="modal-data-ip-bloquear" value="">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-lg-3 col-form-label form-control-label"></label>
            <div class="col-lg-9 mt-4">
              <input type="submit" class="btn btn-danger" value="Bloquear IP" name="Cadastrar" id="Cadastrar">
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
  $('#mkModalBloquearIp').on('shown.bs.modal	', function(e) {
    let btnShow = e.relatedTarget;
    let modal = e.currentTarget;
    let idLinha = $(btnShow).data('id');
    let linha = $('[row-id=' + idLinha + ']')
    $('#modal-data-id-bloquear').val(linha.find('.data-id').text().trim());
    $('#modal-data-ip-bloquear').val(linha.find('.data-ip').text().trim());
  });

  function atualiza() {
    $.get('assets/php/mkListaAcessos.php',
      function(resultado) {

        $('#mkTabelaInfos').find('tbody').find('tr').remove();

        const obj = JSON.parse(resultado);
        let linhaFake = '<tr row-id="##id##">';
        linhaFake += '<td><a class="data-ip">##ip##</a></td>';
        linhaFake += '<td><a class="data-data">##data##</a></td>';
        linhaFake += '<td><a class="data-regiao">##cidade## - ##pais##</a></td>';
        linhaFake += '<td><a class="data-dispositivo">##dispositivo##</a></td>';
        linhaFake += '<td><a class="data-sistema">##sistema##</a></td>';
        linhaFake += '<td><button class="btn btn-outline-danger p-2" data-toggle="modal" data-target="#mkModalBloquearIp" data-id="##id##"><i class="icon-minus"></i> Bloquear IP</button></td>';

        linhaFake += '</tr>';
        let linha = '';
        let tableBody = '';

        for (let i = 0; i < obj.informacoes.length; i++) {

          linha = linhaFake;
          linha = linha.replaceAll('##id##', obj.informacoes[i].id);
          linha = linha.replaceAll('##data##', obj.informacoes[i].data);
          linha = linha.replaceAll('##pais##', obj.informacoes[i].pais);
          linha = linha.replaceAll('##estado##', obj.informacoes[i].estado);
          linha = linha.replaceAll('##cidade##', obj.informacoes[i].cidade);
          linha = linha.replaceAll('##userAgent##', obj.informacoes[i].userAgent);
          linha = linha.replaceAll('##sistema##', obj.informacoes[i].sistema);
          linha = linha.replaceAll('##navegador##', obj.informacoes[i].chave_pix);
          linha = linha.replaceAll('##dispositivo##', obj.informacoes[i].dispositivo);
          linha = linha.replaceAll('##host##', obj.informacoes[i].host);
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