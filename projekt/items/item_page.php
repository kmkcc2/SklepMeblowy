<?php
  session_start();
  require("../controller/connection.php")
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Sklep meblowy</title>

  <link rel="stylesheet" href="/projekt/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script src = "https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>
  <script src="/projekt/Scripts/shopcart.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
</head>

<body>
<?php
    include("../model/shop_cart.php");
    include("../model/nav_bar.php");

  ?>


 
  <section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
      <div class="row gx-4 gx-lg-5 align-items-center">
        <div class="col-md-6">
        <?php
          $url_name = $_GET["name"];
          $sqlimage = "SELECT zdjecie, produkty.nazwa, produkty.produkt_id, produkty.cena, produkty.waga, produkty.dostepne_sztuki FROM zdjecia join produkty on produkty.produkt_id = zdjecia.produkt_id where zdjecia.nazwa = 'ikona' and produkty.nazwa = '".$url_name."'";
          $sqlifotos = "SELECT zdjecie FROM zdjecia join produkty on produkty.produkt_id = zdjecia.produkt_id where zdjecia.nazwa = 'foto' and produkty.nazwa = '".$url_name."'";
          $imageresult1 = mysqli_query($connection,$sqlimage);
          while($rows = mysqli_fetch_assoc($imageresult1))
          {       
              $image = $rows['zdjecie'];
              $name = $rows['nazwa'];  
              $id =  $rows['produkt_id'];  
              $price =  $rows['cena'];  
              $waga = $rows['waga'];
              $sztuki = $rows['dostepne_sztuki'];
              echo "<img class=\"card-img-top mb-5 mb-md-0 visible\" foto=\"0\" id=\"img\" src=\"data:image/jpeg;base64,".base64_encode($image)."\" alt=\"".$name."\"/>";
              
          }
          $fotoresult = mysqli_query($connection,$sqlifotos);
          $foto_count = 1; 
          while($rows = mysqli_fetch_assoc($fotoresult)){
            $foto = $rows['zdjecie'];
            echo "<img class=\"card-img-top mb-5 mb-md-0 display-none \" foto=\"$foto_count\" id=\"img\" src=\"data:image/jpeg;base64,".base64_encode($foto)."\" alt=\"".$name."\"/>";
            $foto_count++;
          }
          echo '<div class="d-flex p-2 justify-content-around"><span class="material-icons pointer prev-arrow">
          arrow_back_ios
          </span>';
          echo '<span class="material-icons pointer next-arrow" max="'.$foto_count.'">
          arrow_forward_ios
          </span></div>';

          echo '<input class="'.$id.'sztuki" type="hidden" value="'.$sztuki.'">';
        ?>
          

          </div>
        <div class="col-md-6">
          <div id = "product_id" class="small mb-1">ID: <?php echo $id; ?>&nbsp; Waga: <?php echo $waga." kg"; ?></div>
          <h1 class="display-5 fw-bolder" id="name"><?php echo ucfirst($name); ?></h1>
          <div class="fs-5 mb-3">
            <span id="price"><?php echo $price." PLN"; ?></span>
          </div>
          <div class="flex-d mb-3">
          <p id="color">Kolor:&nbsp;</p>
            <input type="radio" class="btn-check black" id="black" value="czarny">
            <label class="btn" style="background-color: black; width: 3em; height: 3em;" for="black"></label>
            <input type="radio" class="btn-check white" id="white" value="biały" >
            <label class="btn" style="background-color: white; border: 1px black solid;  width: 3em; height: 3em;" for="white"></label>
            <input type="radio" class="btn-check brown" id="brown" value="brązowy" >
            <label class="btn" style="background-color: brown;  width: 3em; height: 3em;" for="brown"></label>
          </div>
          <div class="flex-d mb-3">
          <p id="material">Materiał:&nbsp;</p>
          <select id="material-select"class="form-select-sm">
            <option value="drewno"selected>Drewno</option>
            <option value="metal">Metal</option>
            <option value="polimer">Polimer</option>
          </select>
          </div>

          <div class="d-flex">
            <input class="form-control text-center me-3" id="inputQuantity" pattern="^[0-9]*$" type="number" value="1"
              style="max-width: 3rem" />
            <button id = "add_to_cart"class="btn btn-outline-dark flex-shrink-0" type="button">
              <i class="bi-cart-fill me-1"></i>
              Dodaj do koszyka
            </button>
    
          </div>
          <?php 
              echo '<div class="flex-d"><p id="sztuki" val="'.$sztuki.'" class= "mt-2">Dostępne sztuki: '.$sztuki.'</b></p></div>'
            ?>
              <script>
                if($("#inputQuantity").val() > parseInt($("#sztuki").attr("val"))){
                    $("#add_to_cart").attr('disabled','disabled')
                  }else{
                    $("#add_to_cart").removeAttr('disabled')
                  }
                let sztuki = <?php echo $sztuki; ?>;
                $("#inputQuantity").on('input', function() {
                  var reg = new RegExp('^[0-9]+$');

                  if(reg.test($("#inputQuantity").val())){
                    if($("#inputQuantity").val() > parseInt($("#sztuki").attr("val"))){
                    $("#add_to_cart").attr('disabled','disabled')
                  }else{
                    $("#add_to_cart").removeAttr('disabled')
                  }
                  }else{
                    $("#add_to_cart").attr('disabled','disabled')
                  }


                  
                });
                
              
            </script>
        </div>
      </div>
    </div>
  </section>



</body>

</html>