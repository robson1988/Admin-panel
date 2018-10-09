<?php
include_once "../Models/functions.php";

  if(!isset($_SESSION['logedIn'])) {
    header('Location: ../public_html/index.php');
    exit();
    } else {
      $userLogOut = new User;
      $userLogOut->logOut();
      
      header('Location: ../public_html/index.php');
      exit();
    }
