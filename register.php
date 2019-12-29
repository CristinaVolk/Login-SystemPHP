<?php include 'core/init.php' ?>
<?php include 'includes/overall/over-header.php';

if (empty($_POST) === false){
    $required_fields = array('username', 'password', 'first_name', 'email');
    foreach ($_POST as $key=>$value){
        if (empty($value) && in_array($key, $required_fields) === true){
            $errors[] = 'Fields marked with an asterix are required';
            break 1;
        }
    }

    if (empty($errors) === true){
        if (if_user_exists($_POST['username']) === true){
            $errors[] = "Sorry, the username '".$_POST['username']."' is already taken";
        }
        if (preg_match("/\\s/", $_POST['username']) == true){
            $errors[] = 'Your username must not contain any spaces';
        }

        if (strlen($_POST['username']) > 32  ){
            $errors[] = 'Username is too long';
        }
        if ( strlen($_POST['password']) > 32 || strlen($_POST['password']) < 8 ){
            $errors[] = 'The password should be more than 8 and less the 32 characters';
        }
        //doesn't work!!! TODO!!!
        if (preg_match("/(@)|()/", $_POST['password']) == false){
            $errors[] = 'Your password should contain at least 1 special character and number';
        }
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){
            $errors[] = 'A valid email is required';
        }
        if (if_email_exists($_POST['email']) === true){
            $errors[] = "Sorry, the email '".$_POST['email']."' is already in use";
        }
        //additional validation
        
    }
}
?>

<h1>Register</h1>
<?php

if (isset($_GET['success']) && empty($_GET['success'])){
    echo 'You have been registered successfully! Please check your email to activate your account';
} else {
        if (empty($_POST) === false && empty($errors) === true){
            $registered_data = array(
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'email_code' => md5($_POST['username'].microtime())
            );
        
            register_user($registered_data);
            header('Location: register.php?success');
            exit();
        } else if (empty($errors) === false) {
            echo output_errors($errors);
        }

    ?>
    <form action="register.php" method="post">
        <ul>
            <li>
                Username*:<br>
                <input type="text" name="username">
            </li>
            <li>
                Password*:<br>
                <input type="text" name="password">
            </li>
            <li>
                First name*:<br>
                <input type="text" name="first_name">
            </li>
            <li>
                Last name:<br>
                <input type="text" name="last_name">
            </li>
            <li>
                Email*:<br>
                <input type="text" name="email">
            </li>
            <li>
                <input type="submit" value="Register">
            </li>
        </ul>
    </form>

    <?php
}
include 'includes/overall/over-footer.php' ?>