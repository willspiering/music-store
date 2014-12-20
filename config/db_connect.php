<?php
$host = "localhost";
$db_name = "music_store";
$username = "user";
$password = "toilets";

try {
    $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);   
}

// to handle connection errors
catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();   
}
?>