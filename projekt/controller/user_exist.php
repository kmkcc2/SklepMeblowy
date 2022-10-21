<?php
    require("connection.php");
    $user = $_GET["email"];

    $query = "select * from `uzytkownicy` where email = '".$user."'";

    try{
        $result = mysqli_query($connection,$query);
    }
    catch(Exception $e){
        echo $e;
    }
    if($result->num_rows === 0){
        //header("Location register.php?userexist=false");
        echo $result->num_rows;
    }
    else{
        echo $result->num_rows;
        //header("Location register.php?userexist=true");
    }




?>