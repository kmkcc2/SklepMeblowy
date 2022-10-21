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
<form action="controller/pay.php" method="POST">
<div class=" container-fluid my-5 ">
    <div class="row justify-content-center ">
        <div class="col-xl-10">
            <div class="card shadow-lg ">
                <div class="row p-2 mt-3 justify-content-between mx-sm-2">
                    <div class="col">
                        <div class="row justify-content-start ">
                            <div class="col">
                                <p>Sklep Meblowy</p>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="row justify-content-around">
                    
                    <div class="col-md-5">
                        <div class="card border-0 ">
                            <div class="card-body pt-0">
                                <?php
                                    $cart_name = "";
                                    if(isset($_SESSION['cookie_email'])) $cart_name = $_SESSION['cookie_email'];

                                    


                                    $cart = $_COOKIE['cart'.$cart_name];

                                    $cart = json_decode($cart);

                                    $total_bez_dost = 0;
                                    $quan = [];
                                    foreach ($cart as $items){
                                        if(isset($quan[$items[0]])){
                                            $quan[$items[0]] += $items[1];
                                        }else{
                                            $quan[$items[0]] = $items[1];
                                        }
                                            
                                    }
                                
                                   
                                    foreach ($cart as $item){
                                        $check_quan = "select dostepne_sztuki from produkty where produkt_id = '$item[0]'";
                                        $res = mysqli_query($connection,$check_quan);
                                        while($quantity = $res->fetch_column(0)) {
                                            if($quantity < $quan[$item[0]]){
                                                echo '<script>let c = confirm("Wybrano zbyt dużą ilość produktu '.$item[3].'. Proszę wybrać poprawną ilość w koszyku. Maksymalna łączna ilość produktu to "+'.$quantity.'+ " sztuk")
                                                window.history.back()
                                                </script>';

                                            }
                                        }
                                        $kwota = str_replace("PLN","",$item[2]);
                                        $total_bez_dost += intval($kwota) * intval($item[1]);
                                        $query = "select zdjecie from zdjecia where produkt_id = '".$item[0]."' and nazwa = 'ikona'";
                                        try{
                                            $result = mysqli_query($connection,$query);
                                            $zdj = $result->fetch_column(0);

                                        }
                                        catch(Exception $e){
                                            echo $e;
                                            exit;
                                        }
                                        echo '<div class="row  justify-content-between">
                                        <div class="col-auto col-md-7">
                                            <div class="media flex-column flex-sm-row">
                                                <img class=" img-fluid " src="data:image/jpeg;base64,'.base64_encode($zdj).'" width="62" height="62">
                                                <div class="media-body  my-auto">
                                                    <div class="row ">
                                                        <div class="col"><p class="mb-0"><b>'.$item[3].'</b></p><small class="text-muted text-reset">'.$item[4]." ".$item[5].'</small></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pl-0 flex-sm-col col-auto  my-auto"> <p class="boxed">'.$item[1].'</p></div>
                                        <div class="pl-0 flex-sm-col col-auto my-auto"><p><b>'.$item[2].'</b></p></div>
                                    </div><hr class="my-2">';
                                    }




                                ?>
                             
                                <div class="row ">
                                    <div class="col">
                                        <div class="row justify-content-between">
                                            <div class="col-4"><p class="mb-1"><b>Podsumowanie</b></p></div>
                                            <div class="flex-sm-col col-auto"><p class="mb-1"><b><?php echo $total_bez_dost." PLN"; ?></b></p></div>
                                        </div>
                                        <div class="row justify-content-between">
                                            <div class="col"><p class="mb-1"><b>Dostawa</b></p></div>
                                            <div class="flex-sm-col col-auto"><p class="mb-1"><b><select name="dostawa" onchange="dostawaFunc()" class="form-select" aria-label="Default select example">
                                                <option name="dostawa" value="0 odbior osobisty" selected>Odbiór osobisty 0 zł</option>
                                                <option name="dostawa" value="15 kurier dpd">Kurier DPD 15 zł</option>
                                                <option name="dostawa" value="9 paczkomat inpost">Paczkomat InPost 9 zł</option>
                                                <option name="dostawa" value="5 poczta polska">Poczta Polska 5 zł</option>
                                            </select></b></p></div>
                                            <script>
                                                function dostawaFunc(){
                                                    var dostawa = $("option[name=dostawa]:selected").val();
                                                    dostawa = dostawa.split(" ")
                                                    let cena_dostawy = dostawa[0];
                                                    var total = parseInt(cena_dostawy) + parseInt(<?php echo $total_bez_dost?>);
                                                    $("#total").html(total+" PLN")
                                                    $("#sub_btn_pay").html("Zapłać "+total+" PLN")
                                                    $("#total_input_h").val(total)
                                                }
                                                
                                                
                                            </script>
                                        </div>
                                        <div class="row justify-content-between">
                                            <div class="col-4"><p ><b>Razem</b></p></div>
                                            <div class="flex-sm-col col-auto"><p  class="mb-1"><b id="total"><?php echo $total_bez_dost." PLN";?></b></p> </div>
                                            <input id="total_input_h" name="total_cost" type="hidden" value="<?php echo $total_bez_dost;?>">
                                        </div><hr class="my-0">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php
                    try{
                        $adres = explode(" ",$_SESSION['adres']);
                        if(isset($adres[4])){
                            $ulica = $adres[0]." ".$adres[1]; 
                            $kod = $adres[2];
                            $miasto = $adres[3];
                            $kraj = $adres[4];
                        }else{
                            $ulica = $adres[0]; 
                            $kod = $adres[1];
                            $miasto = $adres[2];
                            $kraj = $adres[3];
                        }
                        
                    }catch(Exception $e){
                        echo "<script>alert('Błąd podczas wczytywania danych dostawy. Sprawdź swoje dane')</script>";
                    }
                        
                    ?>
                    <div class="col-md-5">
                        <div class="card border-0">
                            <div class="card-header pb-0">
                                <h2 class="card-title space ">Podsumowanie zamówienia</h2>
                                <hr class="my-0">
                            </div>
                            <div class="card-body">
                                <div class="row mt-4">
                                    <div class="col"><p class="text-muted text-reset  mb-2">Adres dostawy</p><hr class="mt-0"></div>
                                </div>
                                <div class="form-group">
                                    <label for="NAME" class="small text-muted text-reset mb-1">Ulica i numer domu/mieszkania</label>
                                    <input type="text" class="form-control form-control-sm" name="NAME" id="NAME" aria-describedby="helpId" placeholder="Ulica 32a" value="<?php echo $ulica?>" required>
                                </div>
                                <div class="row no-gutters">
                                    <div class="col-sm-6 pr-sm-2">
                                        <div class="form-group">
                                            <label for="NAME" class="small text-muted text-reset mb-1">Kod pocztowy</label>
                                            <input type="text" class="form-control form-control-sm" name="NAME" id="NAME" aria-describedby="helpId" placeholder="00-000" value="<?php echo $kod?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="NAME" class="small text-muted text-reset mb-1">Miasto</label>
                                            <input type="text" class="form-control form-control-sm" name="NAME" id="NAME" aria-describedby="helpId" placeholder="Miasto" value="<?php echo $miasto?>" required>
                                        </div>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="NAME" class="small text-muted text-reset mb-1">Kraj</label>
                                    <input type="text" class="form-control form-control-sm" name="NAME" id="NAME" aria-describedby="helpId" placeholder="Polska" value="<?php echo $kraj?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="NAME" class="small text-muted text-reset mb-1">Numer telefonu</label>
                                    <input type="text" class="form-control form-control-sm" name="NAME" id="NAME" aria-describedby="helpId" placeholder="123456789"value="<?php echo $_SESSION['tel']?>" required>
                                </div>
                                <div class="row mt-4">
                                    <div class="col"><p class="text-muted text-reset mb-2">Dane karty kredytowej</p><hr class="mt-0"></div>
                                </div>
                                <div class="form-group">
                                    <label for="NAME" class="small text-muted text-reset mb-1">Imię i nazwisko posiadacza</label>
                                    <input type="text" class="form-control form-control-sm" name="NAME" id="NAME" aria-describedby="helpId" placeholder="Jan Kowalski" required>
                                </div>
                                <div class="form-group">
                                    <label for="NAME" class="small text-muted text-reset mb-1">Numer karty</label>
                                    <input type="text" class="form-control form-control-sm" name="NAME" id="NAME" aria-describedby="helpId" placeholder="4534 5555 5555 5555" required>
                                </div>
                                <div class="row no-gutters">
                                    <div class="col-sm-6 pr-sm-2">
                                        <div class="form-group">
                                            <label for="NAME" class="small text-muted text-reset mb-1">Data ważności</label>
                                            <input type="text" class="form-control form-control-sm" name="NAME" id="NAME" aria-describedby="helpId" placeholder="06/21" requiredd>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="NAME" class="small text-muted text-reset mb-1">Kod CVC</label>
                                            <input type="text" class="form-control form-control-sm" name="NAME" id="NAME" aria-describedby="helpId" placeholder="183" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-md-5">
                                    <div class="col">
                                        <button type="submit" name="" id="sub_btn_pay" class="btn btn-lg btn-primary mt-5">Zapłać <?php echo $total_bez_dost." PLN";?></button>
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>

</body>

</html>