<?php
  include_once "../Content/includes/header.php";
?>

<body>

<form method="post" action="../Controllers/login.php">
<input type="text" name="login" placeholder="Login"/>
<input type="password" name="pass" placeholder="Haslo"/>
<input type="submit" value="Login" name="loginbutton"/>
<?php if(isset($_SESSION['msg_error'])) {
  echo "<br>".$_SESSION['msg_error'];
  session_unset();
} ?>
</form>
<h5> Nie masz konta?<a href="../Controllers/register.php"> Zarejestruj sie </a>za darmo!</h5>




  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
</body>

</html>
