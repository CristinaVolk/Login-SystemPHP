<?php 

$upOne = dirname(__DIR__, 1);
include $upOne.'\database\connect.php';

function is_logged() {    
    return (isset($_SESSION['user_id'])) ? true : false; 
}

function user_exists($username) {
    
    $username = sanitize($username);
    $query = "SELECT `user_id` FROM `wolves` WHERE `username` = '$username' LIMIT 1";
    // echo mysqli_fetch_object(mysqli_query($GLOBALS['conn'], $query)) ? true : false;
    return  mysqli_fetch_object(mysqli_query($GLOBALS['conn'], $query)) ? true : false;    
}

function user_active($username) {
    
    $username = sanitize($username);
    $query = "SELECT `user_id` FROM `wolves` WHERE `username` = '$username' AND `active`=1 LIMIT 1";
    // echo mysqli_fetch_object(mysqli_query($GLOBALS['conn'], $query)) ? true : false;
    return  mysqli_fetch_object(mysqli_query($GLOBALS['conn'], $query)) ? true : false;    
}

function user_id_from_username($username) {
    
    $username = sanitize($username);

    $query = "SELECT `user_id` FROM `wolves` WHERE `username` = '$username'";
    $value = mysqli_fetch_object(mysqli_query($GLOBALS['conn'], $query));
    //echo mysqli_fetch_object(mysqli_query($GLOBALS['conn'], $query)) ? $value->user_id : 0;
    return  mysqli_fetch_object(mysqli_query($GLOBALS['conn'], $query)) ? $value->user_id : 0;    
}

function login($username, $password) {
    $user_id = user_id_from_username($username);
    $username = sanitize($username);

    $password = md5(sanitize($password));
    $query = "SELECT `user_id` FROM `wolves` WHERE `username` = '$username' AND `password` = '$password' LIMIT 1";
    //echo mysqli_fetch_object(mysqli_query($GLOBALS['conn'], $query)) ? $user_id : false;
    return  mysqli_fetch_object(mysqli_query($GLOBALS['conn'], $query)) ? $user_id : false;    
}


?>