<?php
require_once 'init.php';

$titulo_produto = $_POST['titulo_produto'];
$valor_produto = $_POST['valor_produto'];
$parcelas = $_POST['parcelas'];
$porcentagem_desconto = $_POST['porcentagem_desconto'];
$quantidade_estoque = $_POST['quantidade_estoque'];
$descricao = $_POST['descricao'];
$mkImgSlider1 = $_FILES['mkImgSlider1'];
$mkImgSlider2 = $_FILES['mkImgSlider2'];
$mkImgSlider3 = $_FILES['mkImgSlider3'];
$mkImgSlider4 = $_FILES['mkImgSlider4'];
$data = date("d-m-Y");

$totalporcent = 100;
$total = $porcentagem_desconto / $totalporcent;
$resultado = $total * $valor_produto;
$valor_desconto = $valor_produto - $resultado;
$preco_real = number_format($valor_produto, 2, ",", ".");
$preco_desconto = number_format($valor_desconto, 2, ",", ".");
$valor_parcelado = number_format($valor_desconto / $parcelas, 2, ",", ".");

function retorno($mensagem, $sucesso = false)
{
	// Criando vetor com a propriedades
	$retorno = array();
	$retorno['sucesso'] = $sucesso;
	$retorno['mensagem'] = $mensagem;

	// Convertendo para JSON e retornando
	return json_encode($retorno);
}


$foto1 = $_FILES['mkImgSlider1'];
$nome1 = $foto1['name'];
$tipo1 = $foto1['type'];
$tamanho1 = $foto1['size'];
if (!preg_match('/^image\/(pjpeg|jpeg|png|gif|bmp)$/', $tipo1)) {
	echo retorno('imagem invalida.');
	exit;
}
$mkImgConverte1 = file_get_contents($foto1['tmp_name']);
$imagem1 = base64_encode($mkImgConverte1);

$foto2 = $_FILES['mkImgSlider2'];
$nome2 = $foto2['name'];
$tipo2 = $foto2['type'];
$tamanho2 = $foto2['size'];
if (!preg_match('/^image\/(pjpeg|jpeg|png|gif|bmp)$/', $tipo2)) {
	echo retorno('imagem invalida.');
	exit;
}
$mkImgConverte2 = file_get_contents($foto2['tmp_name']);
$imagem2 = base64_encode($mkImgConverte2);

$foto3 = $_FILES['mkImgSlider3'];
$nome3 = $foto3['name'];
$tipo3 = $foto3['type'];
$tamanho3 = $foto3['size'];
if (!preg_match('/^image\/(pjpeg|jpeg|png|gif|bmp)$/', $tipo3)) {
	echo retorno('imagem invalida.');
	exit;
}
$mkImgConverte3 = file_get_contents($foto3['tmp_name']);
$imagem3 = base64_encode($mkImgConverte3);

$foto4 = $_FILES['mkImgSlider4'];
$nome4 = $foto4['name'];
$tipo4 = $foto4['type'];
$tamanho4 = $foto4['size'];
if (!preg_match('/^image\/(pjpeg|jpeg|png|gif|bmp)$/', $tipo4)) {
	echo retorno('imagem invalida.');
	exit;
}
$mkImgConverte4 = file_get_contents($foto4['tmp_name']);
$imagem4 = base64_encode($mkImgConverte4);


$PDO = db_connect();
$sql = "INSERT INTO produtos(titulo_produto, preco_real, preco_desconto, porcentagem_desconto, valor_parcelado, parcelas, quantidade_estoque, descricao, imagem1, imagem2, imagem3, imagem4, data) VALUES(:titulo_produto, :preco_real, :preco_desconto, :porcentagem_desconto, :valor_parcelado, :parcelas, :quantidade_estoque, :descricao, :imagem1, :imagem2, :imagem3, :imagem4, :data)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':titulo_produto', $titulo_produto);
$stmt->bindParam(':preco_real', $preco_real);
$stmt->bindParam(':preco_desconto', $preco_desconto);
$stmt->bindParam(':parcelas', $parcelas);
$stmt->bindParam(':porcentagem_desconto', $porcentagem_desconto);
$stmt->bindParam(':valor_parcelado', $valor_parcelado);
$stmt->bindParam(':quantidade_estoque', $quantidade_estoque);
$stmt->bindParam(':descricao', $descricao);
$stmt->bindParam(':imagem1', $imagem1);
$stmt->bindParam(':imagem2', $imagem2);
$stmt->bindParam(':imagem3', $imagem3);
$stmt->bindParam(':imagem4', $imagem4);
$stmt->bindParam(':data', $data);

if ($stmt->execute()) {
	echo "<script>alert('Produto cadastrado com sucesso');location='../../produtos.php';</script>";
	echo "deu certo";
} else {
	print_r($stmt->errorInfo());
}
