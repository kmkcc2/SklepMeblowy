<?php
session_start();
require("connection.php");
    if(isset($_SESSION['logged'])){
        $email = $_SESSION['email'];
        $email_a = str_replace("@","",$email);
        $email_c = str_replace(".","_",$email_a);
        $adres = $_SESSION['adres'];
        if ($adres == ""){
            echo "<script>alert(\"Proszę uzupełnić dane o adresie dostawy w sekcji panel użytkownika\")</script>";
            header("Location: ../user_panel.php");
        }
        $cart = $_COOKIE['cart'.$email_c];
        $cart_array =  json_decode($cart);
        $dostawa = $_POST['dostawa'];
        $dostawa = explode(" ",$dostawa);
        $dostawa = $dostawa[1]." ".$dostawa[2];

        $query = "select uzytkownicy_id from uzytkownicy
        where email = '$email'";
        
        try{
            $result = mysqli_query($connection,$query);
            $uid = $result->fetch_column(0);
            $date = date('Y-m-d');

            $make_order = "INSERT INTO `zamowienia`(`data_zamowienia`, `uzytkownik_id`, `adres_dostawy`, `status_zamowienia`, `dostawa`) VALUES ('$date','$uid','$adres','rozpoczete','$dostawa')";
            $result1 = mysqli_query($connection,$make_order);
            
            $zamowienie_id = "select zamowienie_id from zamowienia where uzytkownik_id = $uid order by zamowienie_id desc";
            $zid = mysqli_query($connection,$zamowienie_id)->fetch_column(0);
            $cena = 0;
            foreach ($cart_array as $value) {
                $id = $value[0];
                $quan = $value[1];
                $cena = $cena + ((int)$value[2] * (int)$quan);
                $color = $value[4];
                $material = $value[5];
                $make_tranz = "INSERT INTO `tranzakcje`(`produkt_id`, `zamowienie_id`, `ilosc_sztuk`, `kolor`, `material`) VALUES ('$id','$zid','$quan','$color','$material')";
                mysqli_query($connection,$make_tranz);
                $update_quan = "UPDATE produkty set `dostepne_sztuki` = dostepne_sztuki - $quan where `produkt_id` = '$id'";
                mysqli_query($connection,$update_quan);
            }


            if (isset($_COOKIE['cart'.$email_c])) {
                setcookie('cart'.$email_c, 'placeholder', time()+ (86400 * 14), '/'); 
            }
            $cost = $_POST['total_cost'];
            $_SESSION['order-details'] = "$dostawa $adres $cost";
            header("Location: ../order_summary.php");
            

        }catch(Exception $e){
            echo $e;
            
        }

        exit;
    }else{
        header("Location: ../login_page.php?payment");
    }
?>