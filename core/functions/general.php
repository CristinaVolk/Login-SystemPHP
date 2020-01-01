<?php 

$upOne = dirname(__DIR__, 1);
include $upOne.'\database\connect.php';

function email($to, $subject, $body){
    $headers = 'From: volkkristina314@gmail.com';
    mail($to, $subject, $body, $headers);
}

function logged_in_redirect(){
    if (is_logged() === true){
        header('Location: index.php');
        exit();
    }
}

function admin_protect(){
    global $user_data;
    if (is_admin($user_data->user_id) === false){
        header('Location: index.php');
        exit();
    }
}

function protect_page(){
    if (is_logged() === false){
        header('Location: protected.php');
        exit();
    }
}


function array_sanitize($item){
    $item = strip_tags(mysqli_real_escape_string($GLOBALS['conn'], $item));
}


function sanitize($data){
    return strip_tags(mysqli_real_escape_string($GLOBALS['conn'], $data));
}

function output_errors($errors){ 
    return '<ul><li>'.implode('</li><li>', $errors).'</li></ul>';
}

?>