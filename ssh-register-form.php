<?php if (get_option('sus_server')) : ?>

	<form action="" id="sus_form" method="post">
		<input type="hidden" name="sus_ajax" value="1" />
		<input type="hidden" name="sus_test" value="<?php echo $sus_test; ?>" />
		<table class="sus_form_table">
			<tr>
				<td class="label" id="sus_user_label"><?php echo __('User', 'usu'); ?></td>
				<td><input type="text" class="sus_text" id="sus_user" name="sus_user" /></td>
			</tr>
			<tr>
				<td class="label" id="sus_pass_label"><?php echo __('Password', 'usu'); ?></td>
				<td><input type="password" class="sus_text" id="sus_pass" name="sus_pass" /></td>
			</tr>
			<tr>
				<td class="label" id="sus_email_label"><?php _e('Email', 'usu'); ?></td>
				<td><input type="text" class="sus_text" id="sus_email" name="sus_email" /></td>
			</tr>
			<tr>
				<td colspan="2"><input type="button" class="sus_submit" id="sus_submit" value="<?php _e('OK', 'usu'); ?>" /></td>
			</tr>
		</table>
	</form>

	<div id="sus_msg" class="sus_normal"></div>

<?php else : ?>

	<div id="sus_msg" class="sus_bad"><?php _e('No configuration found for SSH2 Sync plugin.', 'usu'); ?></div>

<?php endif; ?>
