<?php
include_once "functions.php";
session_start();

if(isset($_POST['save_changes'])) {

	if(!preg_match("/^[a-ząćęłńóśźżA-ZĄĆĘŁŃÓŚŻŹ]*$/", $_POST['u_name']) || 
	!preg_match("/^[a-ząćęłńóśźżA-ZĄĆĘŁŃÓŚŻŹ]*$/", $_POST['surname']) || 
	!preg_match("/^([a-ząćęłńóśźżA-ZĄĆĘŁŃÓŚŻŹ]+\s)([0-9a-ząćęłńóśźżA-ZĄĆĘŁŃÓŚŻŹ+\/])*$/", $_POST['adress']) ||
	!preg_match("/^([0-9]{2})-([0-9]{3})*$/", $_POST['post_code']) || 
	!preg_match("/^[a-ząćęłńóśźżA-ZĄĆĘŁŃÓŚŻŹ\s]*$/", $_POST['city']) || 
	!preg_match("/^[a-ząćęłńóśźżA-ZĄĆĘŁŃÓŚŻŹ]*$/", $_POST['county']) || 
	!preg_match("/^([0-9]{9})*$/", $_POST['phone_num'])) {
		
		$_SESSION['err_update'] = "Podane dane są nieprawidłowe";
			header("Location: ../Content/includes/profile.php");
			exit();
			
	} else {
		//przypisanie zmiennych do wartosci potrzebnych do edycji profilu oraz podstawowych danych do identyfikacji uzytkownika
			$userData = [$_SESSION['uId'], $_SESSION['uLogin'], $_POST['u_name'],
								$_POST['surname'], $_POST['adress'],$_POST['post_code'], 
								$_POST['city'], $_POST['county'], $_POST['phone_num']];
  
					$select = new EditProfile;
					$select->editUser($userData);

} 
		
}
