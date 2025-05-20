<?php

function checkLogin($con, $userId) {
    $userId = intval($userId);
    $query = "SELECT * FROM user WHERE id = '$userId' LIMIT 1";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }

    header("Location: login.php");
    return null;
}



function random_num($length) {
    $text = "";
    if($length < 5) {
        $length = 5;
    }
    
    $len = rand(4, $length);
    
    for($i = 0; $i < $len; $i++) {
        $text .= rand(0, 9);
    }
    
    return $text;
}