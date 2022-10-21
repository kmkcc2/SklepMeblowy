<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Sklep meblowy</title>

  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script src="../projekt/Scripts/shopcart.js"></script>
  <script src="../projekt/Scripts/search-bar.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

  <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
</head>

<body>
<?php
    include("../projekt/model/shop_cart.php");
    include("../projekt/model/nav_bar.php");
  ?>


 
  <form  class ="update-data" method="POST" action="../projekt/controller/update_user.php"> 
  <section class="h-100 h-custom ">
    <div class="container py-5 h-100 ">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12">
          <div class="shadow-lg card card-registration card-registration-2" style="border-radius: 15px;">
            <div class="card-body p-0">
              <div class="row g-0">
                <div class="col-lg-6">
                  <div class="p-5">
                    <h3 class="fw-normal mb-5" style="color: #4835d4;">Informacje ogólne</h3>

                    
                    <div class="row">
                      <div class="col-md-6 mb-4 pb-2">

                        <div class="form-outline">
                          <input type="text" id="form3Examplev2" class="form-control form-control-lg" name="imie" value=<?php
                            if(isset($_SESSION["nazwa"])){
                              $temp = explode(" ", $_SESSION["nazwa"]);
                              $adres = explode(" ", $_SESSION["adres"]);
                              if($adres[0] != "" && $adres[1] != "" && $adres[2] != "" && $adres[3] != "" && $adres[4] != ""){
                                $ulica = $adres[0]." ".$adres[1];
                                $kod = $adres[2];
                                $miasto = $adres[3];
                                $kraj = $adres[4];
                              }
                              

                              $imie = $temp[0];
                              $nazwisko = $temp[1];
                            
                              echo "\"".$imie."\"";
                            }else echo "\"connection error\"";
                          ?>/>
                          <label class="form-label" for="form3Examplev2">Imię</label>
                        </div>

                      </div>
                      <div class="col-md-6 mb-4 pb-2">

                        <div class="form-outline">
                          <input type="text" id="form3Examplev3" class="form-control form-control-lg" name="nazwisko" value =<?php
                            if(isset($_SESSION["nazwa"])){

                              echo "\"".$nazwisko."\"";
                            }else echo "\"connection error\"";
                          ?>/> 
                          <label class="form-label" for="form3Examplev3">Nazwisko</label>
                        </div>

                      </div>
                    </div>
                    <div class="mb-4">
                      <div class="form-outline form-white">
                        <input type="email" id="form3Examplea9" class="form-control form-control-lg" name="email" value = <?php
                            if(isset($_SESSION["nazwa"])){

                              echo "\"".$_SESSION["email"]."\"";
                            }else echo "\"connection error\"";
                          ?>/>
                        <label class="form-label" for="form3Examplea9">Email</label>
                      </div>
                    </div>
                    <div class="mb-4">
                      <div class="form-outline form-white">
                        <input type="password" id="pass" class="form-control form-control-lg" name="haslo" value=""/>
                        <label class="form-label" for="form3Examplea9">Nowe hasło</label>
                      </div>
                    </div>
                    <div class="mb-4">
                      <div class="form-outline form-white">
                        <input type="password" id="pass_conf" class="form-control form-control-lg checkpass" value=""/>
                        <label class="form-label" for="form3Examplea9">Potwierdź hasło</label>
                      </div>
                    </div>
                    <?php
                      if(isset($_GET["userexist"]) && $_GET["userexist"] == true){
                        echo "
                        <div class=\"mb-4\">
                      <div class=\"form-outline form-white\">
                        <span class=\"error\">Użytkownik o podanym adresie email już istnieje!</span>
                        
                      </div>
                    </div>
                        ";
                      }
                    ?>
                      <script>
                          
                          $('#pass_conf').change(function(){
                            var pass = $("#pass").val();
                            var pass_conf = $("#pass_conf").val();
                            if(pass != pass_conf){
                              $("#pass_conf").css("background-color","#FF9494")
                              $("#regist-btn").attr('disabled','disabled');
                            }else{
                              $("#pass_conf").css("background-color","#FFF")
                              $("#regist-btn").removeAttr('disabled');
                            }
                          });
                          
                          </script>
                  </div>
                </div>
                <div class="col-lg-6 bg-indigo text-white">
                  <div class="p-5">
                    <h3 class="fw-normal mb-5">Dane kontaktowe (opcjonalne)</h3>

                    <div class="mb-4 pb-2">
                      <div class="form-outline form-white">
                        <input type="text" id="form3Examplea2" class="form-control form-control-lg" name="adres" value =<?php
                            if(isset($_SESSION["nazwa"])){

                              if(isset($ulica)) echo "\"".$ulica."\"";

                            }else echo "\"connection error\"";
                          ?> />
                        <label class="form-label" for="form3Examplea2">Ulica i numer domu/mieszkania</label>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-5 mb-4 pb-2">

                        <div class="form-outline form-white">
                          <input type="text" id="form3Examplea4" class="form-control form-control-lg" name="kod" value =<?php
                            if(isset($_SESSION["nazwa"])){

                              if(isset($kod)) echo "\"".$kod."\"";

                            }else echo "\"connection error\"";
                          ?>/>
                          <label class="form-label" for="form3Examplea4">Kod pocztowy</label>
                        </div>

                      </div>
                      <div class="col-md-7 mb-4 pb-2">

                        <div class="form-outline form-white">
                          <input type="text" id="form3Examplea5" class="form-control form-control-lg" name="miasto" value =<?php
                            if(isset($_SESSION["nazwa"])){

                              if(isset($miasto)) echo "\"".$miasto."\"";
                            }else echo "\"connection error\"";
                          ?>/>
                          <label class="form-label" for="form3Examplea5">Miasto</label>
                        </div>

                      </div>
                    </div>

                    <div class="mb-4 pb-2">
                      <div class="form-outline form-white">
                        <input type="text" id="form3Examplea6" class="form-control form-control-lg" name="kraj" value =<?php
                            if(isset($_SESSION["nazwa"])){

                              if(isset($kraj)) echo "\"".$kraj."\"";
                            }else echo "\"connection error\"";
                          ?>/>
                        <label class="form-label" for="form3Examplea6">Kraj</label>
                      </div>
                    </div>

                    <div class="row">

                      <div class="mb-4 pb-2">

                        <div class="form-outline form-white">
                          <input type="text" id="form3Examplea8" class="form-control form-control-lg" name="tel" value =<?php
                            if(isset($_SESSION["nazwa"])){
                              if(isset($_SESSION["tel"])) {
                                echo "\"".$_SESSION["tel"]."\"";

                              }
                            }else echo "\"connection error\"";
                          ?>/>
                          <label class="form-label" for="form3Examplea8">Numer telefonu</label>
                        </div>

                      </div>
                    </div>





                    <button type="submit" id="regist-btn" class="btn btn-light btn-lg" data-mdb-ripple-color="dark">Zapisz zmiany
                      </button>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  </form>
</body>

</html>