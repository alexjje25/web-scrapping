<?php
require_once 'init.php';

date_default_timezone_set('America/Sao_Paulo');

$PDO = db_connect();

$sql = "SELECT * FROM produtos ORDER BY id DESC";

$stmt = $PDO->prepare($sql);
$stmt->execute();
$infos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$infomacoes = array(
  'total' => count($infos),
  'informacoes' => $infos
);

echo json_encode($infomacoes);


// $sql2 = "UPDATE infos SET status = 'offline' WHERE data_online <=  CURRENT_TIMESTAMP() - INTERVAL 20 SECOND";
// $stmt2 = $PDO->prepare($sql2);
// $stmt2->execute();

// $sql = "SELECT 
//     infos.*,
//    (DATE_SUB(CURRENT_TIMESTAMP(),INTERVAL 20 SECOND) < data_online) as online
//     FROM infos ORDER BY id DESC";
//    $stmt = $PDO->prepare($sql);
//    $stmt->execute();

// $infos['online'] ? 'Online' : 'Offline'