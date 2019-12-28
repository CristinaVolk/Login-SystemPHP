<?php 

$upOne = dirname(__DIR__, 1);
include $upOne.'\database\connect.php';

function protect_page(){
    if (is_logged() === false){
        header('Location: protected.php');
        exit();
    }
}


function array_sanitize($item){
    $item = mysqli_real_escape_string($GLOBALS['conn'], $item);
}


function sanitize($data){
    return mysqli_real_escape_string($GLOBALS['conn'], $data);
}

function output_errors($errors){ 
    return '<ul><li>'.implode('</li><li>', $errors).'</li></ul>';
}

?>