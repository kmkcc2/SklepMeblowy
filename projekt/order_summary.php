<?php session_start() ?>
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
<div  id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body ">
                <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal"></i> </div>
                
                <div class="px-4 py-5">

                    <h5 class="text-uppercase"><?php $_SESSION['logged']; ?></h5>



                <h4 class="mt-5 theme-color mb-5">Dziękujemy za złożenie zamówienia!</h4>

                <span class="theme-color">Podsumowanie</span>
                <div class="mb-3">
                    <hr class="new1">
                </div>
<?php
    if(isset($_SESSION['order-details'])){
        $ss = $_SESSION['order-details'];
        $ss = explode(" ",$ss);
        $dost = "$ss[0] $ss[1]";
        $addr = "$ss[2] $ss[3] $ss[4] $ss[5] $ss[6]";
        $cena = $ss[7];

    }else{
        echo 'bad';
        exit;
    }
?>
                <div class="d-flex justify-content-between">
                    <span class="font-weight-bold">Kwota całkowita do zapłaty:</span>
                    <span class="text-muted price_total"><?php echo $cena ?>PLN</span>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <span class="font-weight-bold">Dostawa: </span>
                    <span class="font-weight-bold theme-color"><?php echo $dost ?> </span>
                </div>  
                <div class="d-flex justify-content-between mt-3">
                    <span class="font-weight-bold">Adres dostawy: </span>
                    <span class="font-weight-bold theme-color"><?php echo $addr ?> </span>
                </div>  



                <div class="text-center mt-5">


                    <a href="index.php" class="btn btn-primary ">Wróć do strony głównej</a>
                    
                </div>                   

                </div>


            </div>
        </div>
    </div>
</div>
</body>
</html>