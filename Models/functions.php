<?php



class Dbh {																			//DATABASE CONNECTION
  private $servername;
  private $username;
  private $password;
  private $dbname;
  private $charset;



    public function connect() {

      $this->servername = "localhost";
      $this->username = "root";
      $this->password = "";
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
									  
									  
									  
									  
									  
									  
class User {																				//USER ACTIONS

  public function __construct(){

           $database = new Dbh();
           $db = $database->connect();
           $this->conn = $db;

}
				



				
public function login($login, $pass)														//USER LOGIN
   {	
       try
       {
           $sql = "SELECT * FROM users WHERE user_login= :login";
           $stmt = $this->conn->prepare($sql);
           $stmt->bindParam(':login', $login);
           $stmt->execute();

           if($stmt->rowCount()== 1) {
             $result=$stmt->fetch();

             $dbpass= $result['user_pass'];

             if(password_verify($pass, $dbpass)) {

               $_SESSION['logedIn'] = true;
               $_SESSION['uId'] = $result['id'];
               $_SESSION['uLogin'] = $result['user_login'];
               $_SESSION['uMail'] = $result['user_email'];
               $_SESSION['uName'] = $result['user_name'];
               $_SESSION['uSurname'] = $result['user_surname'];
               $_SESSION['uPostCode'] = $result['user_post_code'];
               $_SESSION['uAdres'] = $result['user_adres'];
               $_SESSION['uCity'] = $result['user_city'];
               $_SESSION['uCounty'] = $result['user_county'];
               $_SESSION['uPhoneNum'] = $result['user_phone_num'];
               $_SESSION['uImage'] = $result['user_image'];

				
               header('Location: ../Content/includes/dashboard.php');
				
           } else {
                $_SESSION['msg_error'] = "Niewłaściwy login lub hasło";

                $stmt->closeCursor();


                header('Location: ../public_html/index.php');

                exit();
          }
        } else {

            $_SESSION['msg_error'] = "Niewłaściwy login lub hasło";

            $stmt->closeCursor();

            unset($stmt);

            $db = null;

            header('Location: ../public_html/index.php');

            exit();

          }
        }

 catch(PDOException $e)
        {
            echo $e->getMessage();
        }
      }

	  
	  
	  
														
		public function Register($nlogin, $npass, $nemail) {														//NEW USER REGISTRATION

		  try {
			$sql= "SELECT user_login, user_email FROM users WHERE user_login = :newlogin OR user_email = :newemail";
			$stmt = $this->conn->prepare($sql);

			$stmt->bindParam(":newlogin", $nlogin);
			$stmt->bindParam(":newemail", $nemail);

			$stmt->execute();

			if($stmt->rowCount()!=0) {
			  $_SESSION['msg_error']= "Nazwa uzytkownika lub email zajety";
			  header('Location: ../Controllers/register.php');
			  exit();
			  } else {
			  $hashedPwd = password_hash($npass, PASSWORD_DEFAULT);
			  $sql = "INSERT INTO users (user_login, user_pass, user_email) VALUES (:newlogin, :hashedPwd, :newemail)";
			  $stmt = $this->conn->prepare($sql);

			  $stmt->bindParam(":newlogin", $nlogin);
			  $stmt->bindParam(":hashedPwd", $hashedPwd);
			  $stmt->bindParam(":newemail", $nemail);

			  $stmt->execute();

			  $stmt->closeCursor();

			  unset($stmt);

			  $db = null;
			}

		  } catch (PDOException $e) {
			echo $e->getMessage();

		  }
		}




										
	public function logOut() {            																	//  USER LOGOUT

	  session_unset();
	  session_destroy();
	   
	}


}

                




				
class EditProfile {																								// EDITING USER PROFILE DATA

  public function __construct(){

           $database = new Dbh();
           $db = $database->connect();
           $this->conn = $db;

}


										
	public function editUser($userData) {																//UPDATE USER DETAILS
		try {
			$sql = "SELECT * FROM users WHERE id = :id AND user_login = :login";
			$stmt=$this->conn->prepare($sql);			
			$stmt->bindParam(":id", $_SESSION['uId'] );
			$stmt->bindParam(":login", $_SESSION['uLogin']);
			$stmt->execute();
			//sprawdzenie uzytkownika czy istnieje
			if($stmt->rowCount()!==1) {
				$_SESSION['msg_error'] = "Ups cos poszlo nie tak";

            $stmt->closeCursor();
            unset($stmt);
            $db = null;
            header('Location: ../public_html/index.php');
            exit();	
			
			} else {

						$sql = "UPDATE users SET user_name='".$_POST['u_name']."', user_surname='".$_POST['surname']."',
									user_adres='".$_POST['adress']."', user_post_code='".$_POST['post_code']."', user_city='".$_POST['city']."',
									user_county='".$_POST['county']."', user_phone_num='".$_POST['phone_num']."'
									WHERE  id='".$_SESSION['uId']."' AND user_login='".$_SESSION['uLogin']."' ";
									
						$stmt=$this->conn->prepare($sql);
						$stmt->execute();
						
						$_SESSION['succes_update']= "Dane zostaly zaaktualizowane";
						$_SESSION['uName'] = $_POST['u_name'];
						$_SESSION['uSurname'] = $_POST['surname'];
						$_SESSION['uPostCode'] = $_POST['post_code'];
						$_SESSION['uAdres'] = $_POST['adress'];
						$_SESSION['uCity'] = $_POST['city'];
						$_SESSION['uCounty'] = $_POST['county'];
						$_SESSION['uPhoneNum'] = $_POST['phone_num'];
						//$_SESSION['uImage'] = $_POST['image'];
						
						$stmt->closeCursor();
						unset($stmt);
						$db = null;
						header('Location: ../Content/includes/profile.php');
						exit();
						
					}
				
			} catch (PDOException $e) {
		echo $e->getMessage();

	  }
		
	}

	
		
		public function changeEmail($newDbEmail) {													//UPDATE USER EMAIL
			
			try {
			$sql = "SELECT id, user_login  FROM users WHERE id = :id AND user_login = :login";
			
			$stmt=$this->conn->prepare($sql);
			$stmt->bindParam(":id", $_SESSION['uId'] );
			$stmt->bindParam(":login", $_SESSION['uLogin'] );
			
			$stmt->execute();
			
			if($stmt->rowCount()!==1) {
					$_SESSION['err_update'] = "Ups cos poszlo nie tak";

					$stmt->closeCursor();
					$db = null;
					header('Location: ../Content/includes/profile.php');
					exit();	
					
					} else {
						
						$sql = "UPDATE users SET user_email = '$newDbEmail' 
						WHERE  id='".$_SESSION['uId']."' AND user_login='".$_SESSION['uLogin']."' ";
						
						$stmt=$this->conn->prepare($sql);
						$stmt->execute();
						
						$_SESSION['succes_update']= "E-mail został zmieniony";						
						$_SESSION['uMail'] = $newDbEmail;
						
						$stmt->closeCursor();
						$db = null;
						header('Location: ../Content/includes/profile.php');
						exit();
						
					   }
					   
				} catch (PDOException $e) {
					
					echo $e->getMessage();

				}
		} 

		
		
		
	
																														
	public function changePass($pass) {														//UPDATE USER PASSWORD
		
		try { 
			
			$sql = "SELECT *  FROM users WHERE id = :id AND user_login = :login";
			
			$stmt=$this->conn->prepare($sql);
			$stmt->bindParam(":id", $_SESSION['uId'] );
			$stmt->bindParam(":login", $_SESSION['uLogin'] );
			
			$stmt->execute();
			
			if($stmt->rowCount()!==1) {
					$_SESSION['err_update'] = "Ups cos poszlo nie tak1";

					$stmt->closeCursor();
					$db = null;
					header('Location: ../Content/includes/profile.php');
					exit();	
					
					} else {

						$result = $stmt->fetch(PDO::FETCH_ASSOC);
					
						$dbPass = password_verify($_POST['oldPass'], $result['user_pass']);
						
								if($dbPass == false ) {
									$_SESSION['err_update'] = "Ups cos poszlo nie tak2";

									$stmt->closeCursor();
									$db = null;
									header('Location: ../Content/includes/profile.php');
									exit();

								}	else {
		
									$newDbPass = password_hash($_POST['newPass1'], PASSWORD_DEFAULT);
									
									$sql = "UPDATE users SET user_pass ='$newDbPass' 
												WHERE  id='".$_SESSION['uId']."' AND user_login='".$_SESSION['uLogin']."'";
												
									$stmt = $this->conn->prepare($sql);
									
									$stmt->execute();
									
									
									$_SESSION['succes_update'] = "Hasło zostało zmienione";
									$stmt->closeCursor();
									$db = null;
									header('Location: ../Content/includes/profile.php');
									exit();
								
								
							}
					
						}	
			
			
			
			} catch (PDOException $e) {
					
					echo $e->getMessage();

					}
		
	} 
		
}





									
class Post {																				  //POST DISPLAYING CLASS
	
	 public function __construct(){

           $database = new Dbh();
           $db = $database->connect();
           $this->conn = $db;
	 }	   
	 
	 
	 
										
										
		public function showAllPosts() {											//SHOW ALL POSTS IN TABLE(posts.php)
			
			try {
		   
				$sql =  "SELECT posts.posts_id, posts.user_login, posts.tittle, posts_categories.cat_name, posts.tags, posts.image, posts.content,posts.comments,  posts.date, posts.status 
							FROM posts, posts_categories 
							WHERE posts.cat_id = posts_categories.cat_id
							ORDER BY posts.date ASC";
						   
						   
			
				$stmt=$this->conn->prepare($sql);
				
				$stmt->execute();
				
				
				while($result = $stmt->fetch(PDO::FETCH_ASSOC) ) 
				
				{
					
					echo "<tr>";
					echo "<td><input type='checkbox'/></td>";
				
				
				
						foreach($result as $dbPostData) {							//PĘTLA WYŚWIETLA WSZYSTKIE DANE Z TABELI POST
							
							$dbPostData = strip_tags($dbPostData);			//SPRAWDZANIE DLUGOSI DANYCH I WYSWIETLENIE ODPOWIEDNIEJ DLUGOSCI
						if (strlen($dbPostData) > 40) {

								// truncate string
								$stringCut = substr($dbPostData,0, 40);
								$endPoint = strrpos($stringCut, ' ');
//
								//if the string doesn't contain any space then it will cut without word basis.
							$dbPostData = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
								$dbPostData.=' ...';
							}						
							
						
							echo "<td>".$dbPostData."</td>";
												}
					
					echo "<td><a class='postAction' href='posts.php?edit={$result['posts_id']}'>Edit</a></td>";
					echo	"<td><a class='postAction' href='?delete={$result['posts_id']}'>Delete</a></td>";
							
					echo	"</tr>";
						 
				}
			
				
				
			} catch (PDOException $e) {
					
					echo $e->getMessage();
				
			}
			
		} 
		
		
		
		
	
	
					//INSERT NEW POST(post-template.php)
	public function insertNewPost($user_login, $tittle, $category, $tags, $post_image, $content) {
		
		
		
		try {
			
				$sql = "INSERT INTO posts (user_login, tittle, cat_id, tags, image, content, date) 
						  VALUES (:user_login, :tittle, :cat_id, :tags, :post_image, :content, now())";
					
				  $stmt = $this->conn->prepare($sql);
				  
				  $stmt->bindParam(":user_login", $user_login);
				  $stmt->bindParam(":tittle", $tittle);
				  $stmt->bindParam(":cat_id", $category);
				  $stmt->bindParam(":tags", $tags);
				  $stmt->bindParam(":post_image", $post_image);
				  $stmt->bindParam(":content", $content);
				  $stmt->execute();
				  
				  $stmt->closeCursor();
				  unset($stmt);
					
				  
			} catch (PDOException $e) {
					
					echo $e->getMessage();

			}
	}   
	
	
	
	
	
	public function deletePost($postId) {						// DELETE POST
		 
		try{
				  $sql = "DELETE FROM posts WHERE posts_id = :deletePost";
				  $stmt = $this->conn->prepare($sql);
				  
				  $stmt->bindParam(":deletePost", $postId);
				  $stmt->execute();
				  
				 $stmt->closeCursor();
				 unset($stmt);
				 
			
				  
			} catch (PDOException $e) {
					
					echo $e->getMessage();

			}
	}	
	
	
	
	public function getCategories() {						//DISPLAY POSTS CATEGORIES
		
		try{ 
		
			$sql="SELECT * FROM posts_categories";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			
			//$value=1;
			
			while($result = $stmt->fetch(PDO::FETCH_ASSOC) ) {
				
				echo "<option value=".$result['cat_id'].">".$result['cat_name']."</option>"; 

			} 		
			
		} catch (PDOException $e) {
			
			echo $e->getMessage();
			
		}
	}	
	
	
	
	
	 
		
	public function filtertByCategories($filterCategories) {						//DISPLAY FILTER CATEGORIES
		
		try{ 
		
				
				$sql = "SELECT posts.posts_id, posts.user_login, posts.tittle, posts_categories.cat_name, posts.tags, posts.image, posts.content,posts.comments,  posts.date, posts.status 
							FROM posts, posts_categories 
							WHERE posts.cat_id = posts_categories.cat_id 
							AND posts.cat_id = {$filterCategories}
							ORDER BY posts.date ASC";
				
				
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			
			
			
			while($result = $stmt->fetch(PDO::FETCH_ASSOC) ) 
					
				{
					echo "<tr>";
					echo "<td><input type='checkbox'/></td>";
						foreach($result as $dbPostData) {							//PĘTLA WYŚWIETLA WSZYSTKIE DANE Z TABELI POST
							
							$dbPostData = strip_tags($dbPostData);			//SPRAWDZANIE DLUGOSI DANYCH I WYSWIETLENIE ODPOWIEDNIEJ DLUGOSCI
							if (strlen($dbPostData) > 40) {

								// truncate string
								$stringCut = substr($dbPostData,0, 40);
								$endPoint = strrpos($stringCut, ' ');

								//if the string doesn't contain any space then it will cut without word basis.
								$dbPostData = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
								$dbPostData.=' ...';
							}						
							
							echo "<td>".$dbPostData."</td>";
												}
					
					echo "<td><a class='postAction' href='posts.php?edit={$result['posts_id']}'>Edit</a></td>
							<td><a class='postAction' href='?delete={$result['posts_id']}'>Delete</a></td>
							
							</tr>";
						 
				}
			
		} catch (PDOException $e) {
			
			echo $e->getMessage();
			
		}
	}
	
	
	
	
	
	public function showPostsDate() {					//SHOW PREVIOUS 12 MONTHS TO FILTER POSTS
		
	
						$date = new DateTime('F Y');
						echo "<option value=".$date->format('Y-m').">".$date->format('F Y')."</option>";
						
						for($i=12; $i>1; $i--) {
						$date->modify('-1 month');
						echo "<option value=".$date->format('Y-m').">".$date->format('F Y')."</option>";
						}
		
			}
	
	
	
	
	
}		 //END - POST DISPLAYING CLASS


