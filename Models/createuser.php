<?php
include_once "functions.php";
session_start();


$nlogin = $_POST['nLogin'];
$npass = $_POST['nPass'];
$nemail = $_POST['nEmail'];


  if(isset($_POST['createnewuser'])) {
      if(empty($nlogin) || empty($npass) || empty($nemail)) {
      $_SESSION['msg_error'] = "Wszystkie pola musza być wypełnione";
      header('Location: ../Controllers/register.php');
      exit();
      } else {
        if(strlen($nlogin) < 5 || strlen($nlogin) >20) {
          $_SESSION['msg_error'] = "Nazwa użytkownika musi mieć min 5 i max 20 znakow";
          header('Location: ../Controllers/register.php');
          exit();
          } else {
            if (!preg_match("/^[0-9a-zA-Z]*$/", $nlogin)) {
              $_SESSION['msg_error'] = "Nazwa użytkownika zawiera niedozwolone znaki";
              header('Location: ../Controllers/register.php');
              exit();
              } else {
                if (!preg_match("#[0-9]#", $nlogin)) {
                  $_SESSION['msg_error'] = "Nazwa uzytkownika musi zawierac przynajmniej jedna cyfre";
                  header('Location: ../Controllers/register.php');
                  exit();
                  } else {
                    $emailCheck = filter_var($nemail, FILTER_SANITIZE_EMAIL);
                    if (filter_var($emailCheck, FILTER_VALIDATE_EMAIL) == false || ($emailCheck!=$nemail)) {
                      $_SESSION['msg_error'] = "Nieprawidłowy adres email";
                      header('Location: ../Controllers/register.php');
                      exit();
                      } else {
              if(strlen($npass)<6) {
                $_SESSION['msg_error'] = "Podane hasło jest za krotkie";
                header('Location: ../Controllers/register.php');
                exit();
                } else {

                $register = new User;
                $register->register($nlogin, $npass, $nemail);
                $_SESSION['msg_error'] = "Utworzono nowego uzytkownika";

                header('Location: ../public_html/index.php');

              }
            }
          }
        }
      }
    }
  }  else {

  $_SESSION['msg_error'] = "<br> Wszystkie pola musza być wypełnione";
  //header('Location: ../Controllers/register.php');
}
