<!DOCTYPE html>
<html lang="en">
<?php
  if(isset($_GET["error"])){
    echo '<script>alert("Błędne dane logowania")</script>';
  }
  if(isset($_GET["reset"])){
    echo '<script>alert("Hasło zostało zresetowane. Email z nowym hasłem powinien pojawić się w twojej skrzynce pocztowej.")</script>';
  }
?>
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
    include("../projekt/model/shop_cart.php");
    include("../projekt/model/nav_bar.php");
  ?>


 
  <div class="container">
    <div class="col-sm-12 col-md-6 col-lg-3 mx-auto mt-5 login_form">
      <?php
        if(isset($_GET['payment'])){
          echo '<script>alert("Proszę się zalogować!")</script>';
          $action_addres = "login.php?payment";
        }else{
          $action_addres = "login.php";
        }
      ?>
      <form action="/projekt/controller/<?php echo $action_addres ?>" method="POST">
        <!-- Email input -->
        <div class="form-outline mb-4">
          <input type="email" id="email-login" class="form-control" name="email" value="<?php if(isset($_COOKIE["email"])) { echo $_COOKIE["email"]; } ?>" />
          <label class="form-label" for="form2Example1">Adres email</label>
        </div>

        <!-- Password input -->
        <div class="form-outline mb-4">
          <input type="password" id="pass-login" class="form-control" name="pass" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" />
          <label class="form-label" for="form2Example2">Hasło</label>
        </div>

        <!-- 2 column grid layout for inline styling -->
        <div class="row mb-4">
          <div class="col d-flex justify-content-center">
            <!-- Checkbox -->
            <div class="form-check">
              <input class="form-check-input remember-me" type="checkbox" value="" id="form2Example31" name="remember" checked />
              <label class="form-check-label" for="form2Example31"> Zapamiętaj mnie </label>
            </div>
          </div>

          <div class="col">
            <!-- Simple link -->
            <a class="color-white" href="reset_password.php">Zapomniałeś hasła?</a>
          </div>
        </div>

        <!-- Submit button -->
        <button type="submit" class="login-button btn btn-primary btn-block mb-4">Zaloguj się</button>

        <!-- Register buttons -->
        <div class="text-center">
          <?php 
          if(isset($_GET['payment'])){
            $href = "register_page.php?payment";
          }else{
            $href = "register_page.php";
          }
          ?>
          <p>Nie masz konta? <a class="color-white" href=<?php echo $href ?>>Zarejestruj się</a></p>

        </div>
      </form>
    </div>
  </div>
</body>

</html>