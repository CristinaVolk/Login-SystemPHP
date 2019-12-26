<?php 

$upOne = dirname(__DIR__, 1);
include $upOne.'\database\connect.php';

function sanitize($data){
    return mysqli_real_escape_string($GLOBALS['conn'], $data);
}


?>