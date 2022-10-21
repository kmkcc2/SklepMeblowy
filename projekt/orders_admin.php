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
      <th scope="col">ID zamówienia</th>
      <th scope="col">Data zamówienia</th>
      <th scope="col">ID użytkownika</th>
      <th scope="col">Adres dostawy</th>
      <th scope="col">Status zamówienia</th>
      <th scope="col">Dostawa</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody class="products_tbody">
      <?php
      require("controller/connection.php");

      if(isset($_SESSION['email'])){
        $email = $_SESSION['email'];
        $query = "select * from zamowienia";

        try{
            $result = mysqli_query($connection,$query);
            $count = 0;
            while ($row = $result->fetch_row()) {

                if($row[4] == "rozpoczete"){
                  $opcja1 = "zrealizowane";
                  $opcja2 = "w trakcie realizacji";
                }else if($row[4] == "zrealizowane"){
                  $opcja1 = "rozpoczete";
                  $opcja2 = "w trakcie realizacji";
                }else{
                  $opcja1 = "rozpoczete";
                  $opcja2 = "zrealizowane";
                }
                
                echo "
                <tr>
                    <td><input readonly type=\"text\" name=\"zamowienie_id$count\" value=\"$row[0]\"></input></td>
                    <td><input readonly type=\"text\" name=\"data_zamowienia$count\" value=\"$row[1]\"></input></td>
                    <td><input readonly type=\"text\" name=\"id_uzyt$count\" value=\"$row[2]\"></input></td>
                    <td><input type=\"text\" name=\"adres$count\" value=\"$row[3]\"></input></td>
                    <td>
                    <select name=\"status$count\" aria-label=\"Default select example\">
                      <option selected>$row[4]</option>
                      <option value=\"$opcja1\">$opcja1</option>
                      <option value=\"$opcja2\">$opcja2</option>
                    </select>
                  </td>
                    <td><input readonly type=\"text\" name=\"dostawa$count\" value=\"$row[5]\"></input></td>
                    <td><a href=\"order_details.php?id=$row[0]\">Szczegóły</a></td>
                    <input type=\"text\" hidden name=\"count\" value=\"$count\"></input>
                </tr>
                ";
                $count++;

            }
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
<!-- <button class="btn btn-primary m-1 add_new_record_orders" type="button">Dodaj rekord</button> -->
</div> 
</form>
</body>

</html>