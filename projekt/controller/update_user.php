<?php
session_start();
    require("connection.php");
    $imie = $_POST["imie"];
    $nazwisko = $_POST["nazwisko"];
    $email = $_POST["email"];
    $haslo = $_POST["haslo"];
    $telefon = $_POST["tel"];
    $adres = $_POST["adres"]." ".$_POST["kod"]." ".$_POST["miasto"]." ".$_POST["kraj"];
    $nazwa = $imie." ".$nazwisko;

    $query = "";
    if($haslo != null){
        $hash = hash("sha1",$haslo);
        $query = "UPDATE `uzytkownicy` SET `nazwa`='$nazwa',`haslo`='$hash',`email`='$email',`nr_tel`='$telefon',`adres_dostawy`='$adres' WHERE email = '$email';";
    }else {
        $query = "UPDATE `uzytkownicy` SET `nazwa`='$nazwa',`email`='$email',`nr_tel`='$telefon',`adres_dostawy`='$adres' WHERE `email` = '$email'";
    }
        
    
        try{
            mysqli_query($connection,$query);
            session_destroy();
            header("Location: ../index.php");
        }
        catch(Exception $exc){
            echo $exc;
            exit;
        }
        

    
    
    
?>