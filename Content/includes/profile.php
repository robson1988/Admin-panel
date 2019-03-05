<?php include_once "admin.php"; ?>

  <div class="container">
    <div class="row">

      <div class="col-12">
        <h3 class="title">Dane osobowe</h3>
      </div>

    <div class="col-12 ">
      <p><img class=" info img-responsive" src="../images/icon-1.png"></img> Tutaj mozesz sprawdzic i poprawic swoje dane, zmienic haslo lub adres email. Pamietaj aby wprowadzone dane byly poprawne.</p>
    </div>

      <div class=" col-12 pt-3 pr-3 details">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item"><a class="nav-link tabs active" id="mojedane-tab" data-toggle="tab" href="#mojedane" role="tab" aria-controls="mojedane" aria-selected="true">Moje Dane</a></li>
          <li class="nav-item"><a class="nav-link tabs" id="danelogowania-tab" data-toggle="tab" href="#danelogowania" role="tab" aria-controls="danelogowania" aria-selected="false">Dane Logownia</a></li>
          <li class="nav-item"><a class="nav-link tabs" id="zmienhaslo-tab" data-toggle="tab" href="#zmienhaslo" role="tab" aria-controls="zmienhaslo" aria-selected="false">Zmien Haslo</a></li>
        </ul>

          <div class="tab-content" id="myTabcontent">
            <div class="tab-pane fade show active" id="mojedane" role="tabpanel" aria-labelledby="mojedane-tab"> <!-- Dane osobowe zalogowanego -->

				<form method="POST" action="../../Models/updateusers.php">
                  <div class="row">
					<div class="col-4 col-md-3">Imie:</div>
					<div class="col-4 col-md-5"><input type="text" name="u_name" class="form-control" value="<?php echo $_SESSION['uName']; ?>"></div>
					
									<?php  if(isset($_SESSION['err_update'])) { ?> <div class="col-4  alert alert-danger  alert-dismissible  fade show" role="alert">
									<?php  echo $_SESSION['err_update']; ?><button type="button" class="close" data-dismiss="alert" aria-label ="Close" value="<?php unset($_SESSION['err_update']);?>">
						<span aria-hidden="true">&times;</span></button></div> <?php } else { 
									if(isset($_SESSION['succes_update'])) { ?> <div class="col-4  alert alert-success alert-dismissible  fade show" role="alert">
									<?php  echo $_SESSION['succes_update']; ?><button type="button" class="close" data-dismiss="alert" aria-label ="Close" value="<?php unset($_SESSION['succes_update']);?>">
						<span aria-hidden="true">&times;</span></button></div> <?php }} ?>
										
											
						
				  </div>
				  
                  <div class="row">
                    <div class="col-4 col-md-3">Nazwisko:</div>
                    <div class="col-4 col-md-5"><input type="text" name="surname" class="form-control" value="<?php echo $_SESSION['uSurname']; ?>"></div>
				</div>
				  
                  <div class="row">
                    <div class="col-4 col-md-3">Adres:</div>
                    <div class="col-4 col-md-5"><input type="text" name="adress" class="form-control" value="<?php echo $_SESSION['uAdres']; ?>"></div>
				  </div>
				  
                  <div class="row">
                    <div class="col-4 col-md-3">Kod Pocztowy:</div>
                    <div class="col-4 col-md-5"><input type="text" name="post_code" class="form-control" value="<?php echo $_SESSION['uPostCode']; ?>"></div>
				  </div>
				  
                  <div class="row">
                    <div class="col-4 col-md-3">Miasto:</div>
                    <div class="col-4 col-md-5"><input type="text" name="city" class="form-control" value="<?php echo $_SESSION['uCity']; ?>"></div>
				  </div>
				  
                  <div class="row">
                    <div class="col-4 col-md-3">Wojewodztwo:</div>
                    <div class="col-4 col-md-5"><input type="text" name="county" class="form-control" value="<?php echo $_SESSION['uCounty']; ?>"></div>
				  </div>
				  
                  <div class="row pb-2">
                    <div class="col-4 col-md-3">Telefon:</div>
                    <div class="col-4 col-md-5"><input type="text" name="phone_num" class="form-control" value="<?php echo $_SESSION['uPhoneNum']; ?>"></div>
				  </div>
				  
                  <div class="row">
                    <div class="col-4 col-md-3"></div>
                      <div class="col-4 col-md-5 text-right pb-2">
                        <input class="btn btn-custom btn-sm" type="submit" value="Zapisz zmiany" name="save_changes"/>
                      </div>
                  </div>
				 </form>
                </div>

            <div class="tab-pane fade" id="danelogowania" role="tabpanel" aria-labelledby="danelogowania-tab">    <!-- Dane logowania do konta -->
              <div class="row">
                <div class="col-4 col-md-3">Login:</div>
                <div class="col-6 col-md-5"><input class="form-control" value="<?php echo $_SESSION['uLogin'];?>" readonly ></div> <!-- Input wylaczony z edycji -->
              </div>
              <div class="row">
                <div class="col-4 col-md-3">E-mail:</div>
                <div class="col-6 col-md-5 pb-2"><input type="text" name="email" class="form-control" value="<?php echo $_SESSION['uMail']; ?>" readonly ></div>
				<div class="col-2  pt-2 "><a  href="profile.php?edit_email">Zmień e-mail</a></div>
			 </div>
			 
			 
			 
					<?php if(isset($_GET['edit_email'])) { ?>
					
						<form method="POST" action="../../Models/updateemail.php">
							<div class="row">
								<div class="col-4 col-md-3">Nowy e-mail:</div>
								<div class="col-6 col-md-5"><input type="text" name="newEmail1" class="form-control"></div>
							</div>
							<div class="row">
								<div class="col-4 col-md-3">Potwierdź nowy e-mail:</div>
								<div class="col-6 col-md-5 pb-2"><input type="text" name="newEmail2" class="form-control" ></div>
							</div>
							<div class="row">
								<div class="col-4 col-md-3"></div>
								<div class="col-6 col-md-5 text-right pb-2">
								<input class="btn btn-custom btn-sm" type="submit" value="Zapisz zmiany" name="sNewPass"/>
								</div>
							</div>
						</form>	
					
					<?php } ?>
			
			 
            </div>


            <div class="tab-pane fade" id="zmienhaslo" role="tabpanel" aria-labelledby="zmienhaslo-tab">          <!-- Zmiana hasla do logowania -->
              <form method="post" action="../../Models/updatepass.php" autocomplete="off" >
                <div class="row">
                  <div class="col-4 col-md-3">Stare hasło:</div>
                  <div class="col-6 col-md-5"><input type="password" name="oldPass" class="form-control" ></div>
                </div>

                <div class="row">
                  <div class="col-4 col-md-3">Nowe hasło:</div>
                  <div class="col-6 col-md-5"><input type="password" name="newPass1" class="form-control" ></div>
                </div>

                <div class="row">
                  <div class="col-4 col-md-3">Powtórz nowe hasło:</div>
                  <div class="col-6 col-md-5"><input type="password" name="newPass2" class="form-control" ></div>
                </div>

                <div class="row">
                  <div class="col-4 col-md-3"></div>
                    <div class="col-6 col-md-5 text-right pb-2">
                      <input class="btn btn-custom btn-sm" type="submit" value="Zmień hasło" name="updatePass"/>
                    </div>
                </div>
              </form>

            </div>
        </div>
      </div>


    </div>




  </div>


<?php include_once "admin.footer.php"; ?>
