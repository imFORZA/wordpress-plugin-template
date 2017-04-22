<?php
/**
 * Settings
 *
 * @package plugin-template
 */

/**
 * TemplateSettings.
 */
class TemplateSettings {

	public $settings;

	public function __construct(){
		/* Set menu page */
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );

		$this->settings = get_option( 'template_settings' );
	}

	/**
	 * Register settings and create options page.
	 */
	public function admin_menu() {
		register_setting( 'template_settings', 'template_settings' );
		add_options_page( 'Template Settings', 'Template Settings', 'manage_options', 'plugin-template', array( $this, 'settings_page') );
	}

	public function settings_page(){?>
		<div class="wrap plugin-template">
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

	private function default_settings(){
		settings_fields( 'template_settings' );
		?>
		<h2>Default Settings</h2>
		Set default form values for plugin.
		<table class="form-table">
			<tbody>
				<tr>
					<th>Setting One</th>
					<td><input type="number" name="template_settings[one]" value="<?php esc_attr_e($this->settings['one'] )?>"></td>
				</tr>
				<tr>
					<th>Setting Two</th>
					<td><input type="number" name="template_settings[two]" value="<?php esc_attr_e($this->settings['two'] )?>"></td>
				</tr>
				<tr>
					<th>Setting Three</th>
					<td><input type="number" name="template_settings[three]" value="<?php esc_attr_e($this->settings['three'] )?>"></td>
				</tr>
			</tbody>
		</table>
		<?php
	}

}
