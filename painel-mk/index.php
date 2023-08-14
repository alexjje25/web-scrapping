<?php
  session_start();
  require_once 'assets/php/init.php';
	

	if (!isLoggedIn()){
	    header('Location: login.php');
	} else {
		header('Location: painel.php');
	}
