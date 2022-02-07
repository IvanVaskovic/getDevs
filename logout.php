<?php 
session_start();

unset($_SESSION['email']);

unset($_COOKIE['email']);
setcookie('email','',time()-3600);

session_destroy();
header('Location: ./index.html');
?>