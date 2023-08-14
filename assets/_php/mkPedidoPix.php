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
$notificacao = "0";

$origem = $_POST['origem'];
$destino = $_POST['destino'];
$valorTotal = $_POST['valorTotal'];
$quantidade = $_POST['quantidade'];
$nome = $_POST['mkNome'];
$email = $_POST['mkEmail'];
$telefone = $_POST['mkTelefone'];
$cpf = $_POST['mkCpf'];
$tipoPagamento = "PIX";

$PDO = db_connect();
$sql = "INSERT INTO vendas(origem, destino, valorTotal, quantidade, nome, email, telefone, cpf, tipoPagamento, ip, pais_loca, estado_loca, cidade_loca, sistema, navegador, data, notificacao)VALUES(:origem, :destino, :valorTotal, :quantidade, :nome, :email, :telefone, :cpf, :tipoPagamento, :ip, :pais_loca, :estado_loca, :cidade_loca, :sistema, :navegador, :data, :notificacao)";
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
    echo "<script>location='../../pix.php?status=success&clientId=$clientId';</script>";
    echo "deu certo";
} else {
    print_r($stmt->errorInfo());
}
