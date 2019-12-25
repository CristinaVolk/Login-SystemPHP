<?php 
function user_exists($username) {
    $query = "SELECT COUNT(`user_id`) FROM `wolves` WHERE `username` = '$username'";
    $mysqli -> query($query, $resultmode); 
    if ($resultmode){
        print('Success!');
    }   
}
?>