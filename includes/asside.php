<aside id="Just_A_Random_ID">
            
<?php
    if (is_logged()=== true){
        echo 'Logged in';
    } else {
        include 'includes/widgets/login.php';
    }    
    
?>
    
</aside>