<?php
/**
 * Plugin Name: SSH2 Sync Users
 * Plugin URI: http://vmassuchetto.wordpress.com/ssh2-users-sync-wordpress-plugin
 * Description: Sync SSH2 users from a server to Wordpress.
 * Version: 0.02
 * Author: Vinicius Massuchetto
 * Author URI: http://vmassuchetto.wordpress.com
 **/

sus_init();

$sus_url = dirname(get_bloginfo('url').'/wp-content/plugins/'.plugin_basename(__FILE__));
$sus_dir = dirname(ABSPATH.'wp-content/plugins/'.plugin_basename(__FILE__));
$sus_support_url = 'http://vinicius.soylocoporti.org.br/ssh2-users-sync-wordpress-plugin';

function sus_init () {
    add_action ('init', 'sus_ajax');
    add_action ('wp_footer', 'sus_js');
    add_action ('admin_menu', 'sus_menus');
    wp_enqueue_script('jquery');
    register_sidebar_widget ('SSH2 Sync Users', 'sus_register_form');
}
    
function sus_menus () {
    add_submenu_page ('options-general.php', 'SSH2 Sync Users', 'SSH2 Sync Users', 10, 'ssh-sync-users', 'sus_options_panel'); 
}
    
function sus_ajax () {
    if (isset($_REQUEST['sus_ajax'])) {
        if (isset($_REQUEST['sus_user']))
            $msg = sus_create_user ($_REQUEST['sus_user'], $_REQUEST['sus_pass'], $_REQUEST['sus_email']);
        
        ?>
        <script type="text/javascript">
            jQuery('#sus_msg').html('<?php echo $msg; ?>');
        </script>
        <?php
        exit(1);
    }
}

function sus_js () {
    global $sus_url;
    ?>
    <script type="text/javascript">
        <?php $img_loading = '<img src=\"'.$sus_url.'/img/ajaxload.gif\" />'; ?>
        jQuery('#sus_submit').click( function() {
            jQuery('#sus_msg').html('<?php echo $img_loading; ?>');
            jQuery.post(location.href, jQuery('#sus_form').serialize(), function (data) {
                jQuery('#sus_msg').html(data);
            });
        });
    </script>
    <?php
}

function sus_check_footer () {
    $file = file_get_contents (TEMPLATEPATH.'/footer.php');
    if (preg_match('/wp_footer/', $file))
        return true;
    return false;
}

function sus_options_panel () {
    include 'ssh-panel.php';
}
    
function sus_register_form ($test = 0) {
    include 'ssh-register-form.php';
}

function sus_create_user ($user, $pass, $email) {
    require (ABSPATH.WPINC.'/registration.php');
    $ok = false;
    
    if (($user == '') || ($pass == '') || ($email == ''))
        return __('Complete all fields to register.', 'sus');
    
    if (username_exists($user))
        return __('User already exists.', 'sus');

    if (!$port = get_option('sus_port'))
        $port = 22;

    if (!@$ssh = ssh2_connect (get_option('sus_server'), $port))
        return __('Server out.', 'sus');
    
    if (!@ssh2_auth_password($ssh, $user, $pass))
        return __('Invalid user or password.', 'sus');
    
    if ($group = get_option('sus_group')) {
        if (@$stream = ssh2_exec($ssh, 'groups')) {
            stream_set_blocking ($stream, true);
            $data = ''; while ($buf = fread ($stream,4096)) $data .= $buf;
            fclose($stream);
            
            if (preg_match('/'.$group.'/', $data))
                $ok = true;
            else
                $ok = true;
        } else {
            $msg = __('There was a problem while connecting to your account. Please try again later.', 'sus');
        }
    }
    
    if ($ok) {
        wp_create_user ($user, $pass, $email);
        return __('User created. Check your e-mail for further instructions.', 'sus');
    } else {
        return __('Not a valid user to be created.', 'sus');
    }
}
		
?>
