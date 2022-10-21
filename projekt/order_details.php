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
      <th scope="col">Produkt</th>
      <th scope="col">ilość sztuk</th>
      <th scope="col">Cena(PLN za sztuke)</th>
      <th scope="col">kolor</th>
      <th scope="col">materiał</th>
    </tr>
  </thead>
  <tbody>
      <?php
      require("controller/connection.php");

      if(isset($_SESSION['email'])){
        $zid = $_GET['id'];
        $email = $_SESSION['email'];
        $query = "select DISTINCT p.nazwa, sum(t.ilosc_sztuk), p.cena, t.kolor, t.material, z.dostawa from zamowienia z 
        join uzytkownicy u on u.uzytkownicy_id = z.uzytkownik_id
        join tranzakcje t on t.zamowienie_id = z.zamowienie_id
        join produkty p on p.produkt_id = t.produkt_id
        where u.email = '$email' and z.zamowienie_id = '$zid'
        group by p.nazwa, t.kolor, t.material";

        try{
            $result = mysqli_query($connection,$query);
            $suma = 0;
            while ($row = $result->fetch_row()) {
              $dostawa = $row[5];
                echo "
                <tr>
                    <td>$row[0]</td>
                    <td>$row[1]</td>
                    <td>$row[2]</td>
                    <td>$row[3]</td>
                    <td>$row[4]</td>
                </tr>
                ";
                $suma += $row[1] * $row[2];
            };
            echo "
                <tr>
                    <td style=\"font-weight: bold\">Razem:</td>
                    <td style=\"font-weight: bold; color: blue\">$suma PLN</td>
                    <td style=\"font-weight: bold;\">dostawa: </td>
                    <td style=\"font-weight: bold; color: blue\">$dostawa</td>
                    <td></td>
                </tr>
                ";
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