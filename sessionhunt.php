<?php
/**
 * Plugin Name: SessionHunt
 * Plugin URI: https://sessionhunt.com
 * Description: Hunting your daily web sessions in real time
 * Author: SessionHunt
 * Version: 1.0.0
 */

add_action( 'admin_menu', 'SessionHunt_add_admin_menu' );
add_action( 'admin_init', 'SessionHunt_settings_init' );
add_action( 'wp_head', 'SessionHunt_header' );

function SessionHunt_header() {
  $options = get_option( 'SessionHunt_settings' );
  echo $options['SessionHunt_embed'];
}

function SessionHunt_add_admin_menu() {
	add_menu_page( 'SessionHunt', 'SessionHunt', 'manage_options', 'sessionhunt', 'SessionHunt_options_page' );
}

function SessionHunt_settings_init() {
	register_setting( 'pluginPage', 'SessionHunt_settings' );

	add_settings_section(
		'SessionHunt_pluginPage_section',
		__( '', 'wordpress' ),
		'SessionHunt_settings_section_callback',
		'pluginPage'
	);

	add_settings_field(
		'SessionHunt_embed',
		__( 'Your embed code:', 'wordpress' ),
		'SessionHunt_embed_field',
		'pluginPage',
		'SessionHunt_pluginPage_section'
	);
}


function SessionHunt_embed_field() {
	$options = get_option( 'SessionHunt_settings' );
	?>
	<textarea cols='55' rows='5' name='SessionHunt_settings[SessionHunt_embed]'><?php echo $options['SessionHunt_embed']; ?></textarea>
	<?php
}


function SessionHunt_settings_section_callback() {
	echo __( '', 'wordpress' );
}


function SessionHunt_options_page() {
	?>
	<form action='options.php' method='post'>
		<h1>SessionHunt</h1>
		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>
	</form>
	<?php
}

?>
