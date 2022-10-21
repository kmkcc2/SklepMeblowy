<?php
    require("connection.php");
    $imie = $_POST["imie"];
    $nazwisko = $_POST["nazwisko"];
    $email = $_POST["email"];
    $haslo = $_POST["haslo"];
    
    $user = $_POST["email"];

    $query = "select * from `uzytkownicy` where email = '".$user."'";
    
    try{
        $result = mysqli_query($connection,$query);
    }
    catch(Exception $e){
        echo $e;
    }
    if($result->num_rows > 0){
        
        $userexist = "true"; 
    
    }
    else{
        $userexist = "false";

    }

    if($userexist == "false"){
        $hash = hash("sha1",$haslo);
        echo $hash;
        if($_POST["adres"] != null && $_POST["kod"] != null && $_POST["miasto"] != null && $_POST["kraj"] != null && $_POST["tel"] != null)
        {
            $tel = $_POST["tel"];
            $adres = $_POST["adres"]." ".$_POST["kod"]." ".$_POST["miasto"]." ".$_POST["kraj"];
            $query = "INSERT INTO `uzytkownicy`(`nazwa`, `haslo`, `email`, `nr_tel`, `adres_dostawy`) VALUES ('".$imie." ".$nazwisko."','".$hash."','".$email."','".$tel."','".$adres."')";
        }else{
            $query = "INSERT INTO `uzytkownicy`(`nazwa`, `haslo`, `email`) VALUES ('".$imie." ".$nazwisko."','".$hash."','".$email."')";
        }
    
        try{
            mysqli_query($connection,$query);
        }
        catch(Exception $exc){
            echo $exc;
        }
         
          if(isset($_GET['payment'])){
            header("Location: ../controller/pay.php");
          }else{
            header("Location: ../index.php?register=success");
          }
          
        header("Location: ../index.php?register=success");
    }else{
        header("Location: ../register_page.php?userexist=true");
    }
    
    
    
?>