<?php include_once "../Content/includes/header.php";
      session_start();
;?>

<body>
<form method="POST" action="createuser.php">
<input type="text" name="newlogin" placeholder="Login"/>
<input type="email" name="newemail" placeholder="E-mail"/>
<input type="password" name="newpass" placeholder="Hasło"/>
<input type="submit" name="createnewuser" value="Create"/>

</form>
<?php if(isset($_SESSION['msg_error'])) {
  echo $_SESSION['msg_error'];
  session_unset();
  session_destroy();
} ?>


</body>
</html>
