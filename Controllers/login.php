<?php
include_once "../Models/functions.php";
session_start();

$login = htmlentities($_POST['login']);
$pass = htmlentities($_POST['pass']);

if(isset($_POST['loginbutton'])) {

  if(empty($login) || empty($pass)) {
    $_SESSION['msg_error'] = "Wszystkie pola musza byc wypelnione";
    header('Location: ../public_html/index.php');
    exit();
  } else {

    $obj = new User;
    $obj->login($login, $pass);
    }
} else {
  $_SESSION['msg_error'] = "Niewłaściwy login lub hasło";
  header('Location: ../public_html/index.php');
  exit();
}
