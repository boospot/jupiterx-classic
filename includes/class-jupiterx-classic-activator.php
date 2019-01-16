<?php

/**
 * Fired during plugin activation
 *
 * @link       https://booskills.com/rao
 * @since      1.0.0
 *
 * @package    Jupiterx_Classic
 * @subpackage Jupiterx_Classic/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Jupiterx_Classic
 * @subpackage Jupiterx_Classic/includes
 * @author     Rao <rao@booskills.com>
 */
class Jupiterx_Classic_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		self::register_post_type();

		self::flush_permalink();


	}


	public static function register_post_type() {

		require_once( JUPITERX_CLASSIC_PLUGIN_DIR . 'public/class-jupiterx-classic-post-types.php' );

		$plugin_cpt = new Jupiterx_Classic_Post_Types( JUPITERX_CLASSIC_NAME, JUPITERX_CLASSIC_VERSION );

		$plugin_cpt->register_post_types();

	}


	public static function flush_permalink() {

		flush_rewrite_rules();

	}

}
