<?php
  include_once "../Content/includes/header.php";
?>

<body>
  <form method="POST" action="../Models/createuser.php">
    <input type="text" name="nLogin" placeholder="Login"/>
    <input type="email" name="nEmail" placeholder="E-mail"/>
    <input type="password" name="nPass" placeholder="Hasło"/>
    <input type="submit" name="createnewuser" value="Create"/>
  </form>

<?php if(isset($_SESSION['msg_error'])) {
  echo $_SESSION['msg_error'];
  session_unset();
  session_destroy();
}

include_once "../Content/includes/footer.php"

?>
