<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://booskills.com/rao
 * @since      1.0.0
 *
 * @package    Jupiterx_Classic
 * @subpackage Jupiterx_Classic/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Jupiterx_Classic
 * @subpackage Jupiterx_Classic/admin
 * @author     Rao <rao@booskills.com>
 */
class Jupiterx_Classic_Admin {

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


	private $settings_api;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param      string $plugin_name The name of this plugin.
	 * @param      string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

		add_action( 'admin_menu', array( $this, 'create_settings_page' ) );

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/jupiterx-classic-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/jupiterx-classic-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Create Settings page
	 */
	public function create_settings_page() {

		require_once JUPITERX_CLASSIC_PLUGIN_DIR . 'includes/lib/boo-settings-helper/class-boo-settings-helper.php';

		$config_array = array(
			'options_id' => 'jupiterx-classic',
			'tabs'       => false,
			'menu'       => $this->get_settings_menu(),
			'links'      => $this->get_settings_links(),
			'sections'   => $this->get_settings_sections(),
			'fields'     => $this->get_settings_fields()
		);

		$this->settings_api = new Boo_Settings_Helper( $config_array );

		$this->settings_api->admin_init();

	}

	function get_settings_menu() {
		$config_menu = array(
			//The name of this page
			'page_title' => __( 'JupiterX Classic', 'boorecipe' ),
			// //The Menu Title in Wp Admin
			'menu_title' => __( 'JupiterX Classic Settings', 'boorecipe' ),
			// The capability needed to view the page
			'capability' => 'manage_options',
			// Slug for the Menu page
			'slug'       => 'jupiterx-classic',
			// dashicons id or url to icon
			// https://developer.wordpress.org/resource/dashicons/
			'icon'       => 'dashicons-performance',
			// Required for submenu
			'submenu'    => true,
			// position
			'position'   => 10,
			// For sub menu, we can define parent menu slug (Defaults to Options Page)
			'parent'     => 'options-general.php',
		);

		return $config_menu;
	}

	function get_settings_links() {
		$links = array(
			'plugin_basename' => plugin_basename( plugin_dir_path( __FILE__ ) . $this->plugin_name . '.php' ),

			'action_links' => array(
				array(
					'text' => __( 'Configure', 'jupiterx-classic' ),
					'type' => 'default',
				),
				array(
					'text' => __( 'More Plugins', 'jupiterx-classic' ),
					'url'  => 'https://boospot.com/',
					'type' => 'external',
				),
			),


		);

		return $links;
	}

	function get_settings_sections() {

		$sections = array(
			array(
				'id'    => 'jupiterx_classic_cpt',
				'title' => __( 'Custom Post Types Control', 'jupiterx-classic' ),
			),
			array(
				'id'    => 'jupiterx_classic_settings',
				'title' => __( 'Other Settings', 'jupiterx-classic' ),
			),
		);

		return $sections;
	}

	/**
	 * Returns all the settings fields
	 *
	 * @return array settings fields
	 */
	function get_settings_fields() {
		$settings_fields = array(
			'jupiterx_classic_cpt' => array(
				array(
					'name'    => 'load_cpt',
					'label'   => __( 'Select as per your Requirement', 'jupiterx-classic' ),
					'desc'    => __( 'Only Selected Posts will be Loaded', 'jupiterx-classic' ),
					'type'    => 'multicheck',
					'default' => array( 'employees'   => 'employees',
					                    'faq'         => 'faq',
					                    'news'        => 'news',
					                    'testimonial' => 'testimonial'
					),
					'options' => array(
						'employees'   => __( 'Employees', 'jupiterx-classic' ),
						'faq'         => __( 'FAQ', 'jupiterx-classic' ),
						'news'        => __( 'News', 'jupiterx-classic' ),
						'testimonial' => __( 'Testimonial', 'jupiterx-classic' ),
					)
				),
			),

			'jupiterx_classic_settings' => array(
				array(
					'name'    => 'load_elementor',
					'label'   => __( 'Include Elementor Support', 'jupiterx-classic' ),
					'desc'    => __( 'This is in test phase, so, please activate at your own risk.', 'jupiterx-classic' ),
					'type'    => 'checkbox',
//					'options' => array(
//						'yes' => 'Yes',
//						'no'    =>  'No'
//					),
//					'default' => array( 'no'   => 'no'),
				),
			)
		);

		return $settings_fields;
	}

}
