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


<form action="controller/update_from_admin.php?type=<?php echo $_GET['table']?>" method="POST">
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Zdjęcie</th>
      <th scope="col">ID produktu</th>
      <th scope="col">Nazwa</th>
      <th scope="col">Dostępne sztuki</th>
      <th scope="col">Cena</th>
      <th scope="col">Waga</th>
      <th scope="col">Dostępność</th>
    </tr>
  </thead>
  <tbody class="products_tbody">
      <?php
      require("controller/connection.php");

      if(isset($_SESSION['email'])){
        $email = $_SESSION['email'];
        $query = "select p.`produkt_id`, p.`nazwa`, p.`dostepne_sztuki`, p.`cena`, p.`waga`, p.`dostepnosc`,z.zdjecie from produkty p left join zdjecia z on z.produkt_id = p.produkt_id where z.nazwa = 'ikona' or z.nazwa is null;
        ;";

        try{
            $result = mysqli_query($connection,$query);
            $count = 0;
            while ($row = $result->fetch_row()) {
              
                echo "
                <tr>
                    <td><img style=\"width: 30; height: 30px\" src=\"data:image/jpeg;base64,".base64_encode($row[6])."\" alt=\"ikona\"></td>
                    <td><input readonly type=\"text\" name=\"id_produktu$count\" value=\"$row[0]\"></input></td>
                    <td><input type=\"text\" name=\"nazwa$count\" value=\"$row[1]\"></input></td>
                    <td><input type=\"text\" name=\"dostepne_sztuki$count\" value=\"$row[2]\"></input></td>
                    <td><input type=\"text\" name=\"cena$count\" value=\"$row[3]\"></input></td>
                    <td><input type=\"text\" name=\"waga$count\" value=\"$row[4]\"></input></td>";
                    if($row[5] == true){
                      echo "<td><input type=\"checkbox\" name=\"dost$count\" checked></input></td>";
                    }else{
                      echo "<td><input type=\"checkbox\" name=\"dost$count\"></input></td>";
                    }
                    echo "
                </tr>
                ";
                $count++;

            }
            echo "<input type=\"text\" hidden id=\"admin_count\" name=\"count\" value=\"$count\"></input>";
        }catch(Exception $e){
            echo $e;
            exit;
        }

      }
      ?>
    
   
  </tbody>
</table> 
<div class="d-flex flex-row-reverse bd-highlight">
<button class="btn btn-primary m-1" type="submit">Zapisz zmiany</button>
<button class="btn btn-primary m-1 add_new_record_products" type="button">Dodaj rekord</button>
</div> 
</form>
</body>

</html>