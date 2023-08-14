<?php
require_once 'init.php';

$login = strip_tags(trim($_POST["login"]));
$senha = strip_tags(trim($_POST["senha"]));

// $login = isset($_POST['login']) ? $_POST['login'] : '';
// $senha = isset($_POST['senha']) ? $_POST['senha'] : '';

if (empty($login) || empty($senha)) {
	// echo "<script>alert('Informe usuário e senha !');location='../../login.php';</script>";
	exit;
}

$senhaHash = make_hash($senha);
 
$PDO = db_connect();
 
$sql = "SELECT id, login FROM usuarios WHERE login = :login AND senha = :senha";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':login', $login);
$stmt->bindParam(':senha', $senhaHash);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (count($users) <= 0)
{
    echo "<script>alert('Email ou senha incorretos !');location='../../login.php';</script>";
    exit;
}

$user = $users[0];
 
session_start();
$_SESSION['logged_in'] = true;
$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['login'];
 
header('Location: ../../index.php');