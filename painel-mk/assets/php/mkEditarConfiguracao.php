<?php

require_once 'init.php';

$id = isset($_POST['id']) ? $_POST['id'] : null;
$chave_pix = isset($_POST['chave_pix']) ? $_POST['chave_pix'] : null;
$nome_titular = isset($_POST['nome_titular']) ? $_POST['nome_titular'] : null;
$data = date("H:i:s d/m/Y");


$PDO = db_connect();
$sql = "UPDATE configuracoes SET chave_pix = :chave_pix, nome_titular = :nome_titular, data = :data  WHERE id = :id";
$stmt = $PDO->prepare($sql);
// $stmt->bindParam(':logo_site', $logo_site);
$stmt->bindParam(':chave_pix', $chave_pix);
$stmt->bindParam(':nome_titular', $nome_titular);
$stmt->bindParam(':data', $data);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
    echo "<script>alert('Configurações editada com sucesso');location='../../configuracao.php';</script>";
} else {
    echo "Erro ao alterar";
    print_r($stmt->errorInfo());
}
