<?php
  session_start();
  if(isset($_COOKIE['remember_user'])){
    $response = HTTPRequester::HTTPPost("http://localhost/service/foobar.php", array("postParam" => "foobar"));

  }
  if(!isset($_COOKIE['cookieAccept'])){
    setcookie ("cookieAccept","NO",time()+ (86400 * 14), '/');
    $display = true;
  }else{
    $c = $_COOKIE['cookieAccept'];
    if($c == "NO") {
      $display = true;
    }else {
      $display = "'niema'";
    }


  }
  if(isset($_SESSION['cookie_email']) && !isset($_COOKIE['cart'.$_SESSION['cookie_email']])){
    setcookie ("cart".$_SESSION['cookie_email'],"placeholder",time()+ (86400 * 14), '/');
  }


  
  
 

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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
</head>

<body>
  <?php
  
  if(isset($_GET['pay_request']) && isset($_COOKIE['cart'])){
    echo "<script> 
      let conf = confirm(\"Posiadasz inne przedmioty w swoim koszyku. Czy chcesz je podmienić?\");
    if(conf){
      document.cookie = 'cart".$_SESSION['cookie_email']."'+'='+getCookie(\"cart\")+'; expires=14; path=/';
      document.cookie = 'cart=placeholder; expires=14; path=/';
    }

    </script>";  
  }
  ?>
<div class="justify-content-center container mt-5 cookie-info-box">
        <div class="row">
            <div class="col-md-10">
                <div class="d-flex flex-row justify-content-between align-items-center card cookie p-3 cookie-info-card">
                    <div class="d-flex flex-row align-items-center"><img src="https://i.imgur.com/Tl8ZBUe.png" width="40">
                        <div class="ml-2 mr-2"><span>Ta strona używa plików cookie. Nie mają one na celu gromadzenia danych osobowych, wykorzystują tylko te informacje, które są potrzebne do prawidłowego funkcjonowania.<br></span><a class="learn-more" href="#">Dowiedz się więcej<i class="fa fa-angle-right ml-2"></i></a></div>
                    </div>
                    <div><button class="btn btn-dark" id="cookie-accept-btn"type="button">Okay</button></div>
                </div>
            </div>
        </div>
    </div>
    <script>
      <?php echo "let x = ".$display; ?>;

      if(x == "1"){
        $(".cookie-info-box").css("display","flex")
        $(".cookie-info-box").css("position","absolute")
        $(".cookie-info-box").css("z-index","99999999999")
        $(".cookie-info-box").animate({
          top: -50,
        },500)
      }
 
    
    $("#cookie-accept-btn").click(function(){
      $(".cookie-info-box").animate({
        top: -200,

      },500,function(){
        $(".cookie-info-box").css("display","none");

        document.cookie = "cookieAccept=YES;path=/";

      });

    })

  </script>
  <?php
    include("../projekt/model/shop_cart.php");
    include("../projekt/model/nav_bar.php");
    if(isset($_GET['order']))
    echo '<script>alert("Przyjęto zamówienie!")</script>';
    if(isset($_GET['register'])) echo '<script>alert("Możesz się teraz zalogować używając podanych danych!")</script>';

    if(isset($_GET['pay_request'])){
      echo '<script>alert("Możesz teraz przejść do płatności w zakładce koszyk!")</script>';
    }
    
  ?>


  
  <div class="container px-5 py-5">
    <div class="img-container ">
      <div class="col-lg-8 col-md-12 col-sm-12 text-center position-absolute px-5 py-4 positioning">
        <h1>Stwórz swoje wymarzone środowisko pracy</h1>
      </div>
      <img src="Assets/background.avif" class="img-fluid rounded shadow-lg" alt="Office">
    </div>
  </div>



</body>

</html>