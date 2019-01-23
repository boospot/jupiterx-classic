<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://booskills.com/rao
 * @since      1.0.0
 *
 * @package    Jupiterx_Classic
 * @subpackage Jupiterx_Classic/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Jupiterx_Classic
 * @subpackage Jupiterx_Classic/public
 * @author     Rao <rao@booskills.com>
 */
class Jupiterx_Classic_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param      string $plugin_name The name of the plugin.
	 * @param      string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Jupiterx_Classic_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Jupiterx_Classic_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/jupiterx-classic-public.css', array(), $this->version, 'all' );

		wp_register_style( $this->plugin_name . '-archive-employee', plugin_dir_url( __FILE__ ) . 'css/jupiterx-classic-archive-employee.css', array(), $this->version, 'all' );

		wp_register_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/5.4.0/css/font-awesome.min.css' );


		if ( is_singular( array( 'employees' ) ) ) {

			wp_enqueue_style( $this->plugin_name . '-single-employee', plugin_dir_url( __FILE__ ) . 'css/jupiterx-classic-single-employee.css', array(), $this->version, 'all' );

			wp_enqueue_style( 'font-awesome' );
		}


		if ( is_post_type_archive( 'employees' ) ) {
			wp_enqueue_style( $this->plugin_name . '-archive-employee' );
			wp_enqueue_style( 'font-awesome' );
		}


	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Jupiterx_Classic_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Jupiterx_Classic_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/jupiterx-classic-public.js', array( 'jquery' ), $this->version, false );

	}

}
