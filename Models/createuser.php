<?php
include_once "functions.php";


$newlogin = $_POST['newlogin'];
$newpass = $_POST['newpass'];
$newemail = $_POST['newemail'];


  if(isset($_POST['createnewuser'])) {

      if(empty($newlogin) || empty($newpass) || empty($newemail)) {
      $_SESSION['msg_error'] = "Wszystkie pola musza być wypełnione";
      header('Location: register.php');
      exit();
      } else {
        if(strlen($newlogin) < 5 || strlen($newlogin) >20) {
          $_SESSION['msg_error'] = "Nazwa użytkownika musi mieć min 5 i max 20 znakow";
          header('Location: register.php');
          exit();
          } else {
            if (!preg_match("/^[0-9a-zA-Z]*$/", $newlogin)) {
              $_SESSION['msg_error'] = "Nazwa użytkownika zawiera niedozwolone znaki";
              header('Location: register.php');
              exit();
              } else {
                if (!preg_match("#[0-9]#", $newlogin)) {
                  $_SESSION['msg_error'] = "Nazwa uzytkownika musi zawierac przynajmniej jedna cyfre";
                  header('Location: register.php');
                  exit();
                  } else {
                    $emailCheck = filter_var($newemail, FILTER_SANITIZE_EMAIL);
                    if (filter_var($emailCheck, FILTER_VALIDATE_EMAIL) == false || ($emailCheck!=$newemail)) {
                      $_SESSION['msg_error'] = "Nieprawidłowy adres email";
                      header('Location: register.php');
                      exit();
                      } else {
              if(strlen($newpass)<6) {
                $_SESSION['msg_error'] = "Podane hasło jest za krotkie";
                header('Location: register.php');
                exit();
                } else {

                $register = new User;
                $register->register($newlogin, $newpass, $newemail);
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
  header('Location: register.php'); }
