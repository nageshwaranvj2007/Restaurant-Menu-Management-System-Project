<?php

header("Content-Type: application/json");

include "db.php";

$sql = "SELECT id, food_name, category, price, status FROM menu ORDER BY id ASC";

$result = mysqli_query($conn, $sql);

$menu = [];

if($result){

    while($row = mysqli_fetch_assoc($result)){

        $menu[] = $row;

    }

    echo json_encode([
        "success" => true,
        "menu" => $menu
    ]);

}
else{

    echo json_encode([
        "success" => false,
        "message" => mysqli_error($conn)
    ]);

}

?>