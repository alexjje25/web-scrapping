<?php
require_once 'init.php';

date_default_timezone_set('America/Sao_Paulo');

$PDO = db_connect();

$sql = "SELECT * FROM acessos ORDER BY id DESC";

$stmt = $PDO->prepare($sql);
$stmt->execute();
$infos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$infomacoes = array(
  'total' => count($infos),
  'informacoes' => $infos
);

echo json_encode($infomacoes);
