<?php
include 'core/init.php';
include 'includes/overall/over-header.php'; ?>

<?php  
if (isset($_SESSION['user_id'])){
      $profile_data = user_data($session_user_id, 'first_name', 'last_name', 'email');?>
<h1><?php echo $profile_data->first_name; ?>'s Account</h1>

<table>
      <tr>
            <td>Your firstname:</td>
            <td><strong><?php echo $profile_data->first_name; ?></strong></td>
      </tr>
      <tr>
            <td>Your lastname:</td>
            <td><strong><?php echo $profile_data->last_name; ?></strong></td>
      </tr>
      <tr>
            <td>Your email:</td>
            <td><strong><?php echo $profile_data->email; ?></strong></td>
      </tr>
            <tr>
                  <td>Your type:</td>
            <td>
                  <strong>
                        <?php
                              if (is_admin($session_user_id)){
                                    echo '<strong>Admin!</strong>';
                              }  else {
                                    echo 'User';
                              }
                         ?>
                  </strong>
            </td>
      </tr>
</table>

<?php
} else {
            echo 'Not logged in ';
      }
?>

<?php include 'includes/overall/over-footer.php'; ?>