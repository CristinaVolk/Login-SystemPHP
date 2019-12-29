<?php
include 'core/init.php';
protect_page();
include 'includes/overall/over-header.php'; 
        

$profile_data = user_data($session_user_id, 'first_name', 'last_name', 'email');
        ?>

<h1><?php echo $profile_data->first_name; ?>'s Profile</h1>
<p><?php echo $profile_data->last_name; ?></p>
<p><?php echo $profile_data->email; ?></p>

<?php include 'includes/overall/over-footer.php'; ?>