<?php
require_once 'init.php';

$nome = $_POST['nome'];
$comentario = $_POST['comentario'];
$estrelas = $_POST['estrelas'];
$data = $_POST['data'];


$PDO = db_connect();
$sql = "INSERT INTO avaliacao(nome, comentario, estrelas, data) VALUES(:nome, :comentario, :estrelas, :data)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':comentario', $comentario);
$stmt->bindParam(':estrelas', $estrelas);
$stmt->bindParam(':data', $data);

if ($stmt->execute()) {
	echo "<script>alert('Avaliação cadastrada com sucesso');location='../../avaliacao.php';</script>";
} else {
	print_r($stmt->errorInfo());
}
