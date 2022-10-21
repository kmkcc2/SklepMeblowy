<?php
require("connection.php");
if(isset($_GET['type'])){
    if($_GET['type'] == "users"){

        $nazwa = [];
        $haslo = [];
        $email = [];
        $telefon = [];
        $adres = [];
        $admin = [];
        
        

        $records_nb = $_POST["count"] + 1;
        for ($i = 0; $i < $records_nb; $i++){
            echo strlen($_POST["haslo".$i]);

            if($_POST["haslo".$i] == "" || (int)strlen($_POST["haslo".$i]) == 40){
                array_push($haslo,$_POST["haslo".$i] );
            }else{
                array_push($haslo,hash("sha1",$_POST["haslo".$i]));

            }
            array_push($nazwa,$_POST["nazwa".$i]);
            array_push($email,$_POST["email".$i]);
            array_push($telefon,$_POST["nr_tel".$i]);
            array_push($adres,$_POST["adres".$i]);
            array_push($admin,$_POST["admin".$i]);
        }
        for ($i = 0; $i < $records_nb; $i++){
            try{
                $query = "UPDATE `uzytkownicy` SET `nazwa`='$nazwa[$i]',`haslo`='$haslo[$i]',`email`='$email[$i]',`nr_tel`='$telefon[$i]',`adres_dostawy`='$adres[$i]',`admin`='$admin[$i]' WHERE email = '$email[$i]'";
                mysqli_query($connection,$query);
            }catch(Exception $e){
                echo $e;
                exit;
            }
        }
        header("Location: /projekt/users_admin.php?table=users");
    }else if($_GET['type'] == "orders"){
        $adres = [];
        $status = [];
        $dostawa = [];
        $idz = [];
        $idu = [];
        
        

        $records_nb = $_POST["count"] + 1;
        for ($i = 0; $i < $records_nb; $i++){
            array_push($adres,$_POST["adres".$i]);
            array_push($status,$_POST["status".$i]);
            array_push($dostawa,$_POST["dostawa".$i]);
            array_push($idu,$_POST["id_uzyt".$i]);
            array_push($idz,$_POST["zamowienie_id".$i]);
        }
        for ($i = 0; $i < $records_nb; $i++){
            try{
                echo $idu[$i]." ".$idz[$i];

                $query = "UPDATE `zamowienia` SET `adres_dostawy`='$adres[$i]',`status_zamowienia`='$status[$i]',`dostawa`='$dostawa[$i]' where `zamowienie_id` = '$idz[$i]' AND `uzytkownik_id` = '$idu[$i]'";
                mysqli_query($connection,$query);

            }catch(Exception $e){
                echo $e;
                exit;
            }
        }
        header("Location: /projekt/orders_admin.php?table=orders");
    }else if($_GET['type'] == "products"){
        $id = [];
        $nazwa = [];
        $sztuki = [];
        $cena = [];
        $waga = [];
        $dost = [];
        


        $records_nb = $_POST["count"];
        for ($i = 0; $i < $records_nb; $i++){
            array_push($id,$_POST["id_produktu".$i]);
            array_push($nazwa,$_POST["nazwa".$i]);
            array_push($sztuki,$_POST["dostepne_sztuki".$i]);
            array_push($cena,$_POST["cena".$i]);
            array_push($waga,$_POST["waga".$i]);
            if(isset($_POST["dost".$i])){
                array_push($dost,true);
            }else{
                array_push($dost,false);

            }
        }

        for ($i = 0; $i < $records_nb; $i++){
            try{
                $check = "select * from produkty where produkt_id = $id[$i]";
                $result = mysqli_query($connection,$check);
                $query = "";
                if($result -> num_rows === 0){
                    $query = "INSERT INTO `produkty`(`produkt_id`, `nazwa`, `dostepne_sztuki`, `cena`, `waga`, `dostepnosc`) VALUES ('$id[$i]','$nazwa[$i]',$sztuki[$i],$cena[$i],$waga[$i],'$dost[$i]')";
                }else{
                    $query = "UPDATE `produkty` SET `nazwa`='$nazwa[$i]',`dostepne_sztuki`='$sztuki[$i]',`cena`='$cena[$i]',`waga`='$waga[$i]', `dostepnosc` = '$dost[$i]' where `produkt_id` = $id[$i]";
                }

                mysqli_query($connection,$query);
            }catch(Exception $e){
                echo $e;
                exit;
            }
        }
        header("Location: /projekt/products_admin.php?table=products");
    }

    
}
echo "error";

?>