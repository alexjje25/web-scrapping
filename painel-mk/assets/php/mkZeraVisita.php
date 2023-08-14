<?php

require_once 'init.php';

$PDO = db_connect();
$sql = "TRUNCATE acessos";
$stmt = $PDO->prepare($sql);

if ($stmt->execute()) {
    echo "<script>window.history.back()</script>";
} else {
    echo "Erro ao remover";
    print_r($stmt->errorInfo());
}
