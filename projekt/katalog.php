<?php
  session_start();  
  require("controller/connection.php")
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
    include("../projekt/model/shop_cart.php");
    include("../projekt/model/nav_bar.php");
  ?>



  <div class="container m-8 p-4">

          <?php
          $sqlimage = "SELECT zdjecie, produkty.nazwa, produkty.cena, produkty.dostepne_sztuki FROM zdjecia join produkty on produkty.produkt_id = zdjecia.produkt_id where zdjecia.nazwa = 'ikona' AND produkty.dostepnosc = '1'";
          $result = mysqli_query($connection,$sqlimage);
          
                
            
              echo "<div class=\"row m-4 \">";
              for($j=0;$j<3;$j++){
                while($rows = mysqli_fetch_assoc($result))
                { 
                  echo "<div class=\"col-xs-12 col-sm-12 col-md-4 col-lg-4\">";
                  $image = $rows['zdjecie'];
                  $name = $rows['nazwa']; 
                  $cena = $rows['cena']; 
                  $sztuki = $rows['dostepne_sztuki'];

                  echo "<a href=\"items/item_page.php?name=".$name."\">" ;
                  echo "<div class=\"square bg-image hover-zoom\" style=\"width: 100%;
                  background: url(data:image/jpeg;base64,".base64_encode($image).");
                  padding-bottom: 100%;
                  background-size: cover;
                  background-position: center;\">";
                  echo "</div>";
                  echo "</a>";
                  if($sztuki > 0){
                    echo "<label class=\"mt-4 text-large\"><h3>".ucfirst($name)."</h3><br><p style=\"font-size: 50%;margin-top: -45px;text-align:left\">".$cena." zł</p></label>";
                  }else{
                    echo "<label class=\"mt-4 text-large\"><h3 style=\"text-decoration: line-through;\">".ucfirst($name)."</h3><br><p style=\"font-size: 50%;margin-top: -45px;text-align:left\">Wyprzedane</p></label>";
                  }
                  
                  echo "</div>";
                }
              }
              echo "</div>";
            
          
        ?>   




  </div>



</body>

</html>