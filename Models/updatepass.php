<?php
include_once "functions.php";
session_start();


if(isset($_POST['updatePass'])) {
	
	if(empty($_POST['oldPass']) || empty($_POST['newPass1']) || empty($_POST['newPass2'])) {
		
		$_SESSION['err_update'] = "Wszystkie pola muszą być wypełnione";
			header('Location: ../Content/includes/profile.php');
			exit();
		
		} else {
			
			if(strlen($_POST['newPass1']) <6) {
				
					$_SESSION['err_update'] = "Hasło musi mieć minimum 6 znaków";
					header('Location: ../Content/includes/profile.php');
					exit();
				
			} else {
			
				if($_POST['newPass1'] !== $_POST['newPass2']) {
					
					$_SESSION['err_update'] = "Hasła nie pasują";
					header('Location: ../Content/includes/profile.php');
					exit();
				} else {
					
					$pass = [$_POST['oldPass'], $_POST['newPass1'], $_POST['newPass2']];
					
					$update = new EditProfile;
					$update->changePass($pass);
					
				}
			}
		}	
		
	} else {
		header('Location: ../Content/includes/profile.php');
		exit();
	}