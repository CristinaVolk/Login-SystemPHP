<?php 
//global $conn;
$conn = mysqli_connect('localhost:3305', 'admin', 'mypass');
$connect_error = "Sorry we are experiencing connection problems.";
if ($conn){
    mysqli_select_db($conn, 'wolfdb');
}
else {
    die($connect_error);
}
?>