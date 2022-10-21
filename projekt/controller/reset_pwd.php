<?php
require("connection.php");
    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    $email = $_POST['email'];

    $query = "Select * from `uzytkownicy` where email = '".$email."' and haslo = '".$pass_h."'";
    try{
        $result = mysqli_query($connection,$query);
    }
    catch(Exception $ex){
        echo $ex;
    }
    $name = "null";
    if($result->num_rows > 0){
        
        $new_password = randomPassword();
        $new_password_hash = hash("sha1",$new_password);
        $update_user_password = "UPDATE `uzytkownicy` SET `haslo`='$new_password_hash' WHERE email = '$email';";

        $msg = "Twoje nowe tymczasowe hasło to:\n$new_password\nUżywając swojego adresu email oraz powyższego hasła możesz zalogować się na swoje konto.";

        $msg = wordwrap($msg,70);

        mail("$email","no-reply",$msg);
        
      
    }
    header("Location: /projekt/login_page.php?reset");

?>