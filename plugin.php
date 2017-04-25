<?php
/**
 * Template code for a WordPress plugin.
 *
 * @package %%TEXTDOMAIN%%
 */

/*
-------------------------------------------------------------------------------
	Plugin Name: %%PLUGIN_NAME%%
	Plugin URI: %%PLUGIN_URI%%
	Description: %%PLUGIN_DESCRIPTION%%
	Version: 1.0.0
	Author: %%AUTHOR%%
	Contributors: %%CONTRIBUTORS%%
	Text Domain: %%TEXTDOMAIN%%
	Author URI: %%AUTHOR_URI%%
	License: GPLv3 or later
	License URI: https://www.gnu.org/licenses/gpl-3.0.en.html
------------------------------------------------------------------------------
*/

/* Exit if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) { exit; }

/** Instantiate the plugin. */
new TemplatePlugin();

/**
 * TemplatePlugin class.
 *
 * @package %%TEXTDOMAIN%%
 **/
class TemplatePlugin {

	/**
	 * Plugin Basename.
	 *
	 * ie: wordpress-plugin-template/plugin-template.php
	 *
	 * @var [String]
	 */
	public static $PLUGIN_BASE_NAME;

	/**
	 * Path to current plugin directory.
	 *
	 * @var [String]
	 */
	public static $PLUGIN_BASE_DIR;

	/**
	 * Path to plugin base file.
	 *
	 * @var [String]
	 */
	public static $PLUGIN_FILE;

	/**
	 * Plugin Constructor.
	 */
	public function __construct() {
		/* Define Constants */
		static::$PLUGIN_BASE_NAME = plugin_basename( __FILE__ ) ;
		static::$PLUGIN_BASE_DIR = plugin_dir_path( __FILE__ );
		static::$PLUGIN_FILE = __FILE__;

		/* Include dependencies */
		include_once( 'includes.php' );

		$this->init();
	}

	/**
	 * Initialize Plugin.
	 */
	private function init() {
		/* Language Support */
		load_plugin_textdomain( '%%TEXTDOMAIN%%', false, dirname( static::$PLUGIN_BASE_NAME ) . '/languages' );

		/* Plugin Activation/De-Activation. */
		register_activation_hook( static::$PLUGIN_FILE, array( $this, 'activate' ) );
		register_deactivation_hook( static::$PLUGIN_FILE, array( $this, 'deactivate' ) );

		/* Set menu page */
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );

		/** Enqueue css and js files */
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_scripts' ) );

		/* Add link to settings in plugins admin page */
		add_filter( 'plugin_action_links_' . static::$PLUGIN_BASE_NAME , array( $this, 'plugin_links' ) );

		new TemplateSettings();
	}

	/**
	 * Method that runs on admin_menu hook.
	 */
	public function admin_menu() {
	}

	/**
	 * Enqueue CSS.
	 */
	public function admin_scripts() {
		wp_register_style( 'plugin-template-css', plugins_url( 'assets/css/plugin-template.css', static::$PLUGIN_FILE ) );
		wp_enqueue_style( 'plugin-template-css' );
	}

	public function frontend_scripts() {

	}

	/**
	 * Method that executes on plugin activation.
	 */
	public function activate() {
		flush_rewrite_rules();
	}

	/**
	 * Method that executes on plugin de-activation.
	 */
	public function deactivate() {
		flush_rewrite_rules();
	}

	/**
	 * Add Tools link on plugin page.
	 *
	 * @param  [Array] $links : Array of links on plugin page.
	 * @return [Array]        : Array of links on plugin page.
	 */
	public function plugin_links( $links ) {
		$settings_link = '<a href="options-general.php?page=plugin-template">Settings</a>';
		array_unshift( $links, $settings_link );
		return $links;
	}
}
