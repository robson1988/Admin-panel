<?php
include_once "functions.php";
session_start();



if(isset($_POST['sNewPass'])) {
	
		if($_POST['newEmail1'] !== $_POST['newEmail2']) {
			
			$_SESSION['err_update'] = "Nieprawidłowy adres e-mail";
			header('Location: ../Content/includes/profile.php');
			exit();
			
			} else {
				
				$newDbEmail = filter_var($_POST['newEmail1'], FILTER_SANITIZE_EMAIL);
				
					if(filter_var($newDbEmail, FILTER_VALIDATE_EMAIL) == false || ($_POST['newEmail1'] != $newDbEmail)) {
			
					$_SESSION['err_update'] = "Nieprawidłowy adres e-mail";
					header('Location: ../Content/includes/profile.php');
					exit();
					
						} else {
						
						$update = new EditProfile;
						$update->changeEmail($newDbEmail);
						
						}
			
					}
				}