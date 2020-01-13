<?php

require_once("../conn.php");

$make = $_POST["make"];
$model = $_POST["model"];
$year = $_POST["year"];
$nickname = $_POST["nickname"];

if($make && $model && $year && $nickname){

    $sql = "INSERT INTO cars (make, model, year, nickname) VALUES ('$make', '$model', $year, '$nickname')";
    $result = $db->query($sql);

    if($result){
        echo "You have successfully inserted a car";
    }
}

?>