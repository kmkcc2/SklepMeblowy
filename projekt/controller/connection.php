<?php 

$host = "localhost";
// $user = "id18075744_kmkcc2";
$user = "root";
// $password = '9g0in|HglElI}CCC';
$password = '';
// $db = "id18075744_libprojekt";
$db = "SklepMeblowy";

try{
    $connection = @mysqli_connect($host,$user,$password,$db);
} catch(Exception $e){
    echo "Database connection problem ".$e;
    exit;
}

?>