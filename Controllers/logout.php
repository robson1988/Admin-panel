<?php
session_start();
include_once "../Models/functions.php";
print_r($_SESSION);
  if($_SESSION['logedIn']==1) {
     $userLogOut = new User;
      $userLogOut->logOut();
	  header('Location: ../public_html');
    exit();
   }
