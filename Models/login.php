<?php
include_once "functions.php";

if(isset($_POST['loginbutton'])) {
  $login = $_POST['login'];
   $pass = $_POST['pass'];



  $obj = new User;
  $obj->login($login, $pass);
} else {
  echo "error";
}
