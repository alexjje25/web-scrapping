<?php
 
 require_once '../public/_php/init.php';
 
if (!isLoggedIn())
{
    header('Location: login.php');
}