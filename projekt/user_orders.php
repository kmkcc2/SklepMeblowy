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


  
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID Zamówienia</th>
      <th scope="col">Data zamówienia</th>
      <th scope="col">Status</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
      <?php
      require("controller/connection.php");

      if(isset($_SESSION['email'])){
        $email = $_SESSION['email'];
        $query = "select z.zamowienie_id, z.data_zamowienia, z.status_zamowienia from zamowienia z join uzytkownicy u on u.uzytkownicy_id = z.uzytkownik_id
        where u.email = '$email'";

        try{
            $result = mysqli_query($connection,$query);

            while ($row = $result->fetch_row()) {
                echo "
                <tr>
                    <td>$row[0]</td>
                    <td>$row[1]</td>
                    <td>$row[2]</td>
                    <td><a href=\"order_details.php?id=$row[0]\">Szczegóły</a></td>
                </tr>
                ";
            };
        }catch(Exception $e){
            echo $e;
            exit;
        }

      }
      ?>
    
   
  </tbody>
</table>  
</body>

</html>