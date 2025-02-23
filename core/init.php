<?php 
session_start();
//error_reporting(0);
require 'database/connect.php';
require 'functions/users.php';
require 'functions/general.php';

$current_file = explode('/', $_SERVER['SCRIPT_NAME']);
$current_file = end($current_file);


if (is_logged()===true){
    $session_user_id = $_SESSION['user_id'];
    $user_data = user_data($session_user_id, 'user_id', 'username', 'password', 'first_name', 'last_name', 'email', 'password_recover', 'type');
    echo $user_data->first_name;
    if (user_active($user_data->username)=== false) {
        session_destroy();
        header('Location: index.php');
        exit();
    }
    if ($current_file !== 'changepassword.php' && $user_data->password_recover == 1){
        header('Location: changepassword.php?force');
        exit();
    }
}

$errors = array();
?>