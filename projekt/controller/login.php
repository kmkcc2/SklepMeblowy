<?php
    require("connection.php");
    session_start(); 
   
    
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    if(preg_match('/^[0-9a-f]{40}$/i', $_POST['pass'] )){
        $pass_h = $_POST['pass'];

    }else{
        $pass_h = hash("sha1",$pass);

    }


    $email_a = str_replace("@","",$email);
    $email_c = str_replace(".","_",$email_a);


    $query = "Select * from `uzytkownicy` where email = '".$email."' and haslo = '".$pass_h."'";
    try{
        $result = mysqli_query($connection,$query);
    }
    catch(Exception $ex){
        echo $ex;
    }
    $name = "null";
    if($result->num_rows === 0){
        
        $_GET["error"] = "Złe dane logowania!";
        header("Location: /projekt/login_page.php?error");
    
        
    }else{
        while($rows = mysqli_fetch_assoc($result)){
            $name = $rows["nazwa"];
            $isadmin = $rows["admin"];
        };
        $_SESSION["admin"] = $isadmin;
        $_SESSION["logged"] = $name;
        $_SESSION["email"] = $email;
        $_GET["error"] = null;
        
        $user_data = "select * from `uzytkownicy` where email = '".$email."';";

        try{
            $result_data1 = mysqli_query($connection,$user_data);
            $result_data2 = mysqli_query($connection,$user_data);
            $result_data3 = mysqli_query($connection,$user_data);
            $nazwa = $result_data1->fetch_column(1);
            $_SESSION["nazwa"] = $nazwa;
            $adres = $result_data2->fetch_column(5);
            $_SESSION["adres"] = $adres;
            $telefon = $result_data3->fetch_column(4);
            $_SESSION["tel"] = $telefon;
            $_SESSION["cookie_email"] = $email_c;
            
        }
        catch(Exception $ex){
            echo $ex;
            exit;
        }


 
       

        if(isset($_GET['payment'])){
            header("Location: /projekt/index.php?pay_request");
        }else{
            header("Location: /projekt/index.php");
        }
        }
    
    
    
?>