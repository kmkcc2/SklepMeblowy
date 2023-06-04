<?php 

$host = "localhost";
$user = "root";
$password = '';
$db = "SklepMeblowy";

try{
    $connection = @mysqli_connect($host,$user,$password,$db);
} catch(Exception $e){
    echo "Database connection problem ".$e;
    exit;
}

?>
