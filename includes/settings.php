<?php
/**
 * Settings
 *
 * @package %%TEXTDOMAIN%%
 */

/**
 * Settings class.
 *
 * @todo Change class name to be unique to your plugin.
 */
class MyPluginSettings {

	/**
	 * Current plugin options.
	 *
	 * @var [Mixed]
	 */
	public $settings;

	/**
	 * Initalize Settings.
	 */
	public function __construct() {
		/* Set menu page */
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );

		$this->settings = get_option( '%%TEXTDOMAIN%%_settings' );
	}

	/**
	 * Register settings and create options page.
	 */
	public function admin_menu() {
		register_setting( '%%TEXTDOMAIN%%_settings', '%%TEXTDOMAIN%%_settings' );
		add_options_page( '%%NAME%% Settings', '%%NAME%% Settings', 'manage_options', '%%TEXTDOMAIN%%', array( $this, 'settings_page' ) );
	}

	/**
	 * Render the settings page.
	 */
	public function settings_page() {
		?>
		<div class="wrap %%TEXTDOMAIN%%">
			<form method="post" action="options.php" >
				<h1>Template Plugin</h1>
				<hr>
				<?php
				$this->default_settings();
				submit_button();
				?>
			</form>
		</div>
		<?php
	}

	/**
	 * Render default setting fields.
	 */
	private function default_settings() {
		settings_fields( '%%TEXTDOMAIN%%_settings' );
		?>
		<h2>Default Settings</h2>
		Set default form values for plugin.
		<table class="form-table">
			<tbody>
				<tr>
					<th>Setting One</th>
					<td><input type="number" name="%%TEXTDOMAIN%%_settings[one]" value="<?php esc_attr_e( $this->settings['one'] )?>"></td>
				</tr>
				<tr>
					<th>Setting Two</th>
					<td><input type="number" name="%%TEXTDOMAIN%%_settings[two]" value="<?php esc_attr_e( $this->settings['two'] )?>"></td>
				</tr>
				<tr>
					<th>Setting Three</th>
					<td><input type="number" name="%%TEXTDOMAIN%%_settings[three]" value="<?php esc_attr_e( $this->settings['three'] )?>"></td>
				</tr>
			</tbody>
		</table>
		<?php
	}

}
