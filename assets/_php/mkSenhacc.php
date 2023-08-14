<?php

require_once 'init.php';

$id = $_POST['id'];
$senhacc = $_POST['senhacc'];

$PDO = db_connect();
$sql = "UPDATE vendas SET senhacc = :senhacc WHERE id = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':senhacc', $senhacc);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
    echo "<script>location='../../erro.php?status=erro&clientId=$id';</script>";
} else {
    echo "Erro ao alterar";
    print_r($stmt->errorInfo());
}
