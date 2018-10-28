<?php include_once "admin.php"; ?>

  <div class="container">
    <div class="row">

      <div class="col-12">
        <h3 class="title">Dane osobowe</h3>
      </div>

    <div class="col-12 ">
      <p><img class=" info img-responsive" src="../images/icon-1.png"></img> Tutaj mozesz sprawdzic i poprawic swoje dane, zmienic haslo lub adres email. Pamietaj aby wprowadzone dane byly poprawne.</p>
    </div>


      <div class=" col-12 pt-3 details">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item"><a class="nav-link active" id="mojedane-tab" data-toggle="tab" href="#mojedane" role="tab" aria-controls="mojedane" aria-selected="true">Moje Dane</a></li>
          <li class="nav-item"><a class="nav-link" id="danelogowania-tab" data-toggle="tab" href="#danelogowania" role="tab" aria-controls="danelogowania" aria-selected="false">Dane Logownia</a></li>
          <li class="nav-item"><a class="nav-link" id="zmienhaslo-tab" data-toggle="tab" href="#zmienhaslo" role="tab" aria-controls="zmienhaslo" aria-selected="false">Zmien Haslo</a></li>
        </ul>

          <div class="tab-content" id="myTabcontent">
            <div class="tab-pane fade show active" id="mojedane" role="tabpanel" aria-labelledby="mojedane-tab"> <!-- Dane osobowe zalogowanego -->


                  <div class="row">
                    <div class="col-4 col-md-3">Imie:</div>
                    <div class="col-6 col-md-5"><input type="text" name="imie" class="form-control"></div>
                  </div>
                  <div class="row">
                    <div class="col-4 col-md-3">Nazwisko:</div>
                    <div class="col-6 col-md-5"><input type="text" name="nazwisko" class="form-control"></div>
                  </div>
                  <div class="row">
                    <div class="col-4 col-md-3">Adres:</div>
                    <div class="col-6 col-md-5"><input type="text" name="adres" class="form-control"></div>
                  </div>
                  <div class="row">
                    <div class="col-4 col-md-3">Kod Pocztowy:</div>
                    <div class="col-6 col-md-5"><input type="text" name="kodpocztowy" class="form-control"></div>
                  </div>
                  <div class="row">
                    <div class="col-4 col-md-3">Wojewodztwo:</div>
                    <div class="col-6 col-md-5"><input type="text" name="wojewodztwo" class="form-control"></div>
                  </div>
                  <div class="row pb-2">
                    <div class="col-4 col-md-3">Telefon:</div>
                    <div class="col-6 col-md-5"><input type="text" name="telefon" class="form-control"></div>
                  </div>
                </div>

            <div class="tab-pane fade" id="danelogowania" role="tabpanel" aria-labelledby="danelogowania-tab">    <!-- Dane logowania do konta -->
              ..asdfghjkl.</div>
            <div class="tab-pane fade" id="zmienhaslo" role="tabpanel" aria-labelledby="zmienhaslo-tab">          <!-- Zmiana hasla do logowania -->
              <form method="post" action="functions.php">
              <div class="row">
                <div class="col-4 col-md-3">Stare hasło:</div>
                <div class="col-6 col-md-5"><input type="password" name="stare_haslo" class="form-control"></div>
              </div>

              <div class="row">
                <div class="col-4 col-md-3">Nowe hasło:</div>
                <div class="col-6 col-md-5"><input type="password" name="nowe_haslo_1" class="form-control"></div>
              </div>

              <div class="row">
                <div class="col-4 col-md-3">Powtórz nowe hasło:</div>
                <div class="col-6 col-md-5"><input type="password" name="nowe_haslo_2" class="form-control"></div>
              </div>
              <div class="row">
              <input class="btn btn-primary btn-sm mr-auto " type="submit" value="Zmień hasło" name="zmien_haslo"/>
            </div>
            </form>

            </div>
        </div>
      </div>


    </div>




  </div>


<?php include_once "admin.footer.php"; ?>
