<div class="wrap">
	<div class="icon32" id="icon-options-general"><br></div>
	<h2>SSH2 Sync</h2>
	
	<?php if (!function_exists(ssh2_connect)) : global $sus_support_url; ?>
		<div id="message" class="error">
			<p><?php printf (__('Your server does not support SSH2 connections. Check the <a href="%1$s">documentation</a> for troubleshooting.', 'sus'), $sus_support_url); ?>
		</div>
	<?php endif; ?>
	
	<?php if (!sus_check_footer()) : ?>
		<div id="message" class="error">
			<p><?php _e('Your theme does not meet the requirements for this plugin to work. A `wp_footer` function call was not found in the `footer.php` file.<br/>Paste <b>'.htmlspecialchars('<?php wp_footer(); ?>').'</b> on your theme\'s `footer.php` file to fix it.','sus'); ?></p>
		</div>
	<?php endif; ?>
	
	<?php if (get_option('users_can_register')) : ?>
		<div id="message" class="error">
			<p><?php printf (__('Make sure to disable <a href="%1$s">user registration</a>, so using this plugin makes sense.', 'sus'), get_bloginfo('url').'/wp-admin/options-general.php'); ?></p>
		</div>
	<?php endif; ?>

	<form method="post" action="options.php">
		<?php wp_nonce_field('update-options'); ?>
		
		<table class="form-table">
			<tr>
				<th align="top"><?php _e('SSH2 Server', 'usu'); ?></th>
				<td><input type="text" name="sus_server" value="<?php echo get_option('sus_server'); ?>" /></td>
			</tr>
			
			<tr>
				<th align="top"><?php _e('SSH2 Port', 'usu'); ?></th>
				<td><input type="text" name="sus_port" value="<?php echo get_option('sus_port'); ?>" />&nbsp;<small>(<?php _e('default: 22', 'usu'); ?>)</small></td></td>
			</tr>
			
			<tr>
				<th align="top"><?php _e('User group', 'usu'); ?></th>
				<td><input type="text" name="sus_group" value="<?php echo get_option('sus_group'); ?>" />&nbsp;<small>(<?php _e('default: any successfull login', 'usu'); ?>)</small></td>
			</tr>
		</table>

		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="sus_server,sus_port,sus_group" />

		<p class="submit"><input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" /></p>
	</form>
	
	<h3><?php _e('Instructions', 'sus'); ?></h3>
	<ol>
		<li><?php _e('Fill the options above.'); ?></li>
		<li><?php _e('Paste <b>'.htmlspecialchars('<?php if (function_exists(sus_users_form)) sus_users_form(); ?>').'</b> code in your theme, where you want the form to appear, or just add the "SSH2 Sync Users" widget to your sidebar.'); ?></li>
	</ol>
	
</div>
