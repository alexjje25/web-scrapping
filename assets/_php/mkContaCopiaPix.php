<?php

require_once 'init.php';

$id = isset($_POST['id']) ? $_POST['id'] : null;
$clique_copiapix = "sim";

$PDO = db_connect();
$sql = "UPDATE vendas SET clique_copiapix = :clique_copiapix WHERE id = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':clique_copiapix', $clique_copiapix);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
    echo "deu certo";
} else {
    echo "Erro ao alterar";
    print_r($stmt->errorInfo());
}
