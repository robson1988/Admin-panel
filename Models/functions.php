<?php
session_start();
//Database connection
class Dbh {
  private $servername;
  private $username;
  private $password;
  private $dbname;
  private $charset;



    public function connect() {

      $this->servername = "localhost";
      $this->username = "root";
      $this->password = "root";
      $this->dbname = "login_system";
      $this->charset = "utf8mb4";

      try {

        $this->pdo = new PDO("mysql:host=".$this->servername.";dbname=".$this->dbname.";charset=".$this->charset, $this->username, $this->password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $this->pdo;


      } catch (PDOException $e) {
        echo "Błąd połączenia ".$e->getMessage();

      }

    }
}
//akcje uzytkownika
class User {

  public function __construct(){

           $database = new Dbh();
           $db = $database->connect();
           $this->conn = $db;

}
//logowanie uzytkownika
public function login($login, $pass)
   {
       try
       {
          if(!empty($login) || !empty($pass)) {

           $sql = "SELECT user_name, user_pass FROM users WHERE user_name= :login";
           $stmt = $this->conn->prepare($sql);
           $stmt->bindParam(':login', $login);
           $stmt->execute();

           if($stmt->rowCount()>0) {
             $result=$stmt->fetch();
             $dbpassword= $result['user_pass'];

             if(password_verify($pass, $dbpassword)) {
               header('Location: admin.php');
             } else {
               $_SESSION['msg_error'] = "Niewłaściwy login lub hasło";
               header('Location: ../public_html/index.php');
             }

           } else {
             $_SESSION['msg_error'] = "Niewłaściwy login lub hasło";
             header('Location: ../public_html/index.php');
           }

} else {
  $_SESSION['msg_error'] = "Wszystkie pola musza byc wypelnione";
  header('Location: ../public_html/index.php');
}


} catch(PDOException $e)
        {
            echo $e->getMessage();
        }
      }

//rejestracja uzytkownika
public function Register($newlogin, $newpass, $newemail) {

  try {
    $sql= "SELECT user_name, user_email FROM users WHERE user_name = :newlogin OR user_email = :newemail";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":newlogin", $newlogin);
    $stmt->bindParam(":newemail", $newemail);

    $stmt->execute();
    if($stmt->rowCount()!=0) {
      $_SESSION['msg_error']= "Nazwa uzytkownika lub email zajety";
      header('Location: register.php');
      exit();
    } else {
      $hashedPwd = password_hash($newpass, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (user_name, user_pass, user_email) VALUES (:newlogin, :hashedPwd, :newemail)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(":newlogin", $newlogin);
    $stmt->bindParam(":hashedPwd", $hashedPwd);
    $stmt->bindParam(":newemail", $newemail);

    $stmt->execute();
    return $stmt;
  }

  } catch (PDOException $e) {
    ECHO $e->getMessage();

  }


      }

    }
