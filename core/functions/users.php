<?php 

$upOne = dirname(__DIR__, 1);
include $upOne.'\database\connect.php';

function update_user($update_data){
    global $session_user_id;
    $update = array();
    array_walk($update_data, 'array_sanitize');

    foreach ($update_data as $field=>$data) {
        $update[] = '`'.$field.'`=\''.$data.'\'';
    }

    $query ="UPDATE `wolves` SET ".implode(', ', $update)." WHERE `user_id`=$session_user_id";
    mysqli_query($GLOBALS['conn'], $query);                   
}

function activate($email, $email_code){
    $email = mysqli_real_escape_string($GLOBALS['conn'], $email);    
    $email_code = mysqli_real_escape_string($GLOBALS['conn'], $email_code);
    $query1 = "SELECT `user_id` FROM `wolves` WHERE `email` = '$email' AND `email_code`='$email_code' LIMIT 1";    
    $result = mysqli_fetch_object(mysqli_query($GLOBALS['conn'], $query1)) ? true : false; 

    if ($result === true){
        $query2 ="UPDATE `wolves` SET `active`= 1 WHERE `email`='$email'";    
        mysqli_query($GLOBALS['conn'], $query2);
        return true;
    } else return false;
}

function change_password($user_id, $password){
    $user_id = (int)$user_id;    
    $password = md5($password);
 
    $query ="UPDATE `wolves` SET `password`='$password' WHERE `user_id`=$user_id";    
    mysqli_query($GLOBALS['conn'], $query);
}

function register_user($register_data){
    array_walk($register_data, 'array_sanitize');
    $register_data['password'] = md5($register_data['password']);
 
    $fields = '`'.implode('`, `', array_keys($register_data)).'`';
    $data = '\''.implode('\', \'', $register_data).'\''; 

    $query ="INSERT INTO `wolves` ($fields) VALUES ($data)";
    mysqli_query($GLOBALS['conn'], $query);
    email($register_data['email'], 'Activate your account', "Hello ".$register_data['first_name'].",\n\n You need to activate your account, so use the link below:\n\n http://localhost/Login-SystemPHP/activate.php?email=".$register_data['email']."&email_code=".$register_data['email_code']."\n\n - justwolf.com");                                 
}

function user_count() {     
    $query = "SELECT COUNT(`user_id`) FROM `wolves` WHERE `active` = 1";
    $row = mysqli_fetch_array(mysqli_query($GLOBALS['conn'], $query));  
    $users = $row[0];  
    return $users;    
}

function user_data($user_id) {    
    $data = array();
    $user_id = (int)$user_id;

    $func_num_args = func_num_args();
    $func_get_args = func_get_args();

    if ($func_num_args > 1){
        unset($func_get_args[0]);    

        $fields = '`'.implode('`, `', $func_get_args). '`';
        $query = "SELECT $fields FROM  `wolves` WHERE `user_id` = '$user_id'";
        $data = mysqli_query($GLOBALS['conn'], $query);
        return mysqli_fetch_object($data);
    }
}


function is_logged() {    
    return (isset($_SESSION['user_id'])) ? true : false; 
}

function if_user_exists($username) {
    
    $username = sanitize($username);
    $query = "SELECT `user_id` FROM `wolves` WHERE `username` = '$username' LIMIT 1";
    // echo mysqli_fetch_object(mysqli_query($GLOBALS['conn'], $query)) ? true : false;
    return  mysqli_fetch_object(mysqli_query($GLOBALS['conn'], $query)) ? true : false;    
}

function if_email_exists($email) {
    
    $email = sanitize($email);
    $query = "SELECT `user_id` FROM `wolves` WHERE `email` = '$email' LIMIT 1";
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