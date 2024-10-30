<?php
/*
  Plugin Name: Lime Developer Login
  Plugin URL: https://wordpress.org/plugins/lime-developer-login/
  Description: When developing locally, it can be a pain to remember your temporary account details. We solve that with a one-click, automatic login.
  Version: 1.4.0
  Author: Matthew Blackford, LimeSquare Pty Ltd
  Author URI: http://www.limeplugins.com/
  Contributors: Matthew Blackford
  License: GPLv3
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class LimeDeveloperLogin 
{
  function __construct() 
  {
    // IMPORTANT - Check if running locally. Exposing this on a production server would be insane!
    $safe = array("127.0.0.1","::1");
    if( in_array( $_SERVER["SERVER_ADDR"], $safe ) )
    {
      // Setup the actions
      add_action( 'login_enqueue_scripts', array( $this, 'lime_developer_login_scripts') );
      add_action( 'login_form', array( $this, 'lime_developer_login_links') );
      add_action( 'wp_ajax_nopriv_lime_developer_login', array( $this, 'lime_developer_login_callback' ) );
    }
  }
  
  public function lime_developer_login_scripts() 
  {
    wp_enqueue_script('jquery');
  }
  
  public function lime_developer_login_links() 
  {
    ?>
      <h4>Automatically login as:</h4>
      <br />
      <ul>
        <?php
          $users = get_users('number=10');
          foreach ($users as $user) 
          {
            echo '<li><a href="#" class="lime-developer-login" data-userid="' . $user->id . '">' . $user->user_login . ' (';
          
            $wp_roles = new WP_Roles();
            $capabilities = $user->{$user->cap_key};
          	foreach ( $wp_roles->role_names as $role => $name )
          	{
          	  $sep = '';
            	if ( array_key_exists( $role, $capabilities ) )
            	{
              	echo $sep . $role;
              	$sep = ', ';
            	}
          	}
          
            echo ')</a></li>';
          }
          
          // Build up the redirect URL
          $redirect_url = get_admin_url();
          if ($_REQUEST['redirect_to'])
          {
            $redirect_url = $_REQUEST['redirect_to'];
          }
        ?>
      </ul>
      
      <br />
      <h6>Powered by the Lime Developer Login plugin.</h6>
      
      <script type="text/javascript">
        jQuery(document).ready(function(){
          jQuery('.lime-developer-login').click(function(event) {
            event.preventDefault();
            
            // Get the user ID
            var userid = jQuery(this).attr('data-userid');
            
            // Build up the data array
            var data = {
          		action: 'lime_developer_login',
          		userid: userid,
          	};
          	
          	// Make the AJAX call
          	jQuery.post('<?php echo admin_url( 'admin-ajax.php' ) ?>', data, function(response) {
          	  if (response == 0 || response == -1) {
            	  alert('Error automatically logging in! RESPONSE CODE: ' + response);
          	  } else {
            	  // Redirect the browser
            	  window.location.href = '<?= $redirect_url; ?>';
          	  }
          	});
            
            return false;
          });
        });
      </script>
      
      <br />
    <?php
  }
  
  public function lime_developer_login_callback()
  {
    // Get the user ID
    $userid = intval( $_POST['userid'] );
    
    // Login the user
    wp_set_auth_cookie( $userid, true );
    
    // Echo success
    echo 1;
    die();
  } 
}

// Instantiate plugin's class
$GLOBALS['LimeDeveloperLogin'] = new LimeDeveloperLogin();

?>