<?php

require_once("../conn.php");

//if $_POST["search"] isset and is not blank 
$search_model = isset($_POST["search_model"]) && $_POST["search_model"] != "" ? $_POST["search_model"] : false;
$search_nickname = isset($_POST["search_nickname"]) && $_POST["search_nickname"] != "" ? $_POST["search_nickname"] : false;
$year = isset($_POST["year"]) ? $_POST["year"] : false;

$search_model = $db->real_escape_string(trim($search_model)); //prevents mysql injection attacks
$search_nickname = $db->real_escape_string($search_nickname);
$year = $db->real_escape_string($year);

if($search_model || $search_nickname || $year) {
    $search_sql = " SELECT * FROM cars
                    WHERE nickname LIKE '%$search_nickname%' AND CONCAT_WS('', make, model) LIKE '%$search_model%'"; 
    
    if($year != 0) {
        $search_sql .= "AND year = $year";
    }

} else {
    $search_sql = " SELECT * FROM cars";
}

$result = $db->query($search_sql);

$cars = array();
while($row = $result->fetch_assoc()){
    $cars[] = $row; //append row to the $cars array 
}
$db->close(); //close connection when finsihed

echo json_encode($cars); //return results in JS object-notation

?>
