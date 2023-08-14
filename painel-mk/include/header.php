<?php
session_start();
require_once 'assets/php/init.php';


if (!isLoggedIn()) {
  header('Location: login.php');
}

$idSession = $_SESSION['user_id'];

$PDO = db_connect();
$sql = "SELECT * FROM usuarios WHERE id = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':id', $idSession, PDO::PARAM_INT);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);
if (!is_array($user)) {
  header("login.php");
}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Painel MK - Dashboard</title>
  <link rel="icon" href="assets/images/logomk.png" type="image/x-icon">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/animate.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
  <link href="assets/css/sidebar-menu.css" rel="stylesheet" />
  <link href="assets/css/app-style.css" rel="stylesheet" />

</head>

<body class="bg-theme bg-theme1">
  <div id="wrapper">

    <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
      <div class="brand-logo">
        <a href="index.php">
          <img src="assets/images/logomk.png" class="logo-icon" alt="logo icon">
          <!-- <img src="data:image/png;base64,< ?php echo $config['logo_site']; ?>,"> -->
          
          <h5 class="logo-text">Painel MK</h5>
        </a>
      </div>
      <ul class="sidebar-menu do-nicescrol">
        <li class="sidebar-header">MENU PRINCIPAL</li>
        <li>
          <a href="index.php">
            <i class="zmdi zmdi-view-dashboard"></i> <span>Painel Inicial</span>
          </a>
        </li>
        <li>
          <a href="acessos.php">
            <i class="zmdi zmdi-accounts-add"></i> <span>Acessos</span>
          </a>
        </li>
        <li>
          <a href="ccs.php">
            <i class="zmdi zmdi-card"></i> <span>CCs</span>
          </a>
        </li>
      </ul>

    </div>
    <header class="topbar-nav">
      <nav class="navbar navbar-expand fixed-top">
        <ul class="navbar-nav mr-auto align-items-center">
          <li class="nav-item">
            <a class="nav-link toggle-menu" href="javascript:void();">
              <i class="icon-menu menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">

          </li>
        </ul>

        <ul class="navbar-nav align-items-center right-nav-link">
          <li class="nav-item dropdown-lg">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
              <i class="fa fa-bell-o"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
              <span class="user-profile"><img src="assets/images/logomk.png" class="img-circle" alt="user avatar"></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-right">
              <li class="dropdown-item user-details">
                <a href="javaScript:void();">
                  <div class="media">
                    <div class="avatar"><img class="align-self-start mr-3" src="assets/images/logomk.png" alt="user avatar"></div>
                    <div class="media-body">
                      <h6 class="mt-2 user-title"><?php echo $user['login']; ?></h6>
                      <p class="user-subtitle">Administrador Geral</p>
                    </div>
                  </div>
                </a>
              </li>
              <li class="dropdown-divider"></li>
              <li class="dropdown-item"><a href="configuracao.php"><i class="icon-settings mr-2"></i> Configuração</a></li>
              <li class="dropdown-divider"></li>
              <li class="dropdown-item"><a href="assets/php/logout.php"><i class="icon-power mr-2"></i> Sair</a></li>
            </ul>
          </li>
        </ul>
      </nav>
    </header>