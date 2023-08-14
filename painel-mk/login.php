<?php
session_start();
require_once 'assets/php/init.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Painel MK - Login</title>
  <link href="assets/css/pace.min.css" rel="stylesheet" />
  <script src="assets/js/pace.min.js"></script>
  <link rel="icon" href="assets/images/logomk.png" type="image/x-icon">
  <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
  <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/animate.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/sidebar-menu.css" rel="stylesheet" />
  <link href="assets/css/app-style.css" rel="stylesheet" />

</head>

<body class="bg-theme bg-theme1">
  <div id="pageloader-overlay" class="visible incoming">
    <div class="loader-wrapper-outer">
      <div class="loader-wrapper-inner">
        <div class="loader"></div>
      </div>
    </div>
  </div>
  <div id="wrapper">
    <div class="loader-wrapper">
      <div class="lds-ring">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>
    <div class="card card-authentication1 mx-auto my-5">
      <div class="card-body">
        <div class="card-content p-2">
          <div class="text-center">
            <img src="assets/images/logomk.png" width="130" alt="logo icon">
          </div>
          <form method="POST" action="assets/php/logar.php" name="formLogin" id="formLogin">
            <div class="form-group mt-3">
              <label for="login" class="sr-only">Login</label>
              <div class="position-relative has-icon-right">
                <input type="text" id="login" name="login" class="form-control input-shadow" required placeholder="Digite seu login">
                <div class="form-control-position">
                  <i class="icon-user"></i>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="senha" class="sr-only">Senha</label>
              <div class="position-relative has-icon-right">
                <input type="password" id="senha" name="senha" class="form-control input-shadow" required placeholder="Digite sua senha">
                <div class="form-control-position">
                  <i class="icon-lock"></i>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-light btn-block" id="mkBtnEntrar">Entrar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/sidebar-menu.js"></script>
  <script src="assets/js/base.js"></script>
  <script src="assets/js/app-script.js"></script>

  <!-- <script>
    $(document).ready(function() {

      $("#mkBtnEntrar").click(function() {
        var login = $("#login").val();
        var senha = $("#senha").val();
        $("#mkBtnEntrar").prop('disabled', true);
        $.post('assets/php/logar.php', {
          login: login,
          senha: senha
        }, function(resposta) {
          if (resposta == true) {
            alert("Deu certo");
            $("#formLogin").submit();
          }
        }, 'html');
        alert("não deu certo");
        return false;
      });

    });
  </script> -->

</body>

</html>