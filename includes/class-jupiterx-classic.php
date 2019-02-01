<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://booskills.com/rao
 * @since      1.0.0
 *
 * @package    Jupiterx_Classic
 * @subpackage Jupiterx_Classic/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Jupiterx_Classic
 * @subpackage Jupiterx_Classic/includes
 * @author     Rao <rao@booskills.com>
 */
class Jupiterx_Classic {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Jupiterx_Classic_Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $plugin_name The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $version The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'PLUGIN_NAME_VERSION' ) ) {
			$this->version = PLUGIN_NAME_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'jupiterx-classic';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();


		$this->define_post_type_hooks();
		$this->define_shortcode_hooks();
		$this->initiate_elementor_integration();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Jupiterx_Classic_Loader. Orchestrates the hooks of the plugin.
	 * - Jupiterx_Classic_i18n. Defines internationalization functionality.
	 * - Jupiterx_Classic_Admin. Defines all hooks for the admin area.
	 * - Jupiterx_Classic_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-jupiterx-classic-loader.php';


		/**
		 * require helper class for registering CPT.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-jupiterx-classic-global.php';


		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-jupiterx-classic-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-jupiterx-classic-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-jupiterx-classic-public.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-jupiterx-classic-post-types.php';


		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-jupiterx-classic-shortcodes.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-jupiterx-classic-elementor.php';


		$this->loader = new Jupiterx_Classic_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Jupiterx_Classic_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Jupiterx_Classic_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {


		$plugin_admin = new Jupiterx_Classic_Admin( $this->get_plugin_name(), $this->get_version() );

//		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
//		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Jupiterx_Classic_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_post_type_hooks() {

		$plugin_cpt = new Jupiterx_Classic_Post_Types( $this->get_plugin_name(), $this->get_version() );


//		$plugin_cpt->register_post_types();

		$this->loader->add_action( 'init', $plugin_cpt, 'register_post_types' );
		$this->loader->add_action( 'wp', $plugin_cpt, 'remove_jupiterx_main_header' );

		$this->loader->add_filter( 'single_template', $plugin_cpt, 'load_single_template' );

		$this->loader->add_filter( 'archive_template', $plugin_cpt, 'load_archive_template' );


		// When using Metabox.io
//		$this->loader->add_filter( 'rwmb_meta_boxes', $plugin_cpt, 'get_testimonial_metabox' );


		// When using ACF
		$this->loader->add_action( 'plugins_loaded', $plugin_cpt, 'maybe_load_acf' );
		// Load Fields for Employees
		$this->loader->add_action( 'wp_loaded', $plugin_cpt, 'load_acf_fields_employees' );
		// Load Fields for Testimonials
		$this->loader->add_action( 'wp_loaded', $plugin_cpt, 'load_acf_fields_testimonial' );
		// Load Fields for News
		$this->loader->add_action( 'wp_loaded', $plugin_cpt, 'load_acf_fields_news' );


		// Update Query for custom post type
		$this->loader->add_action( 'pre_get_posts', $plugin_cpt, 'alter_query_to_add_recipe_posttype' );

	}


	/**
	 * Shortcode Hooks
	 */
	public function define_shortcode_hooks() {

		$plugin_shortcode = new Jupiterx_Classic_Shortcodes( $this->get_plugin_name(), $this->get_version() );

		add_shortcode( 'mk_employees', array( $plugin_shortcode, 'mk_employees' ) );

		add_shortcode( 'mk_news', array( $plugin_shortcode, 'mk_news' ) );

		add_shortcode( 'mk_news', array( $plugin_shortcode, 'mk_portfolio' ) );

	}

	/**
	 *
	 */
	public function initiate_elementor_integration() {

		$other_settings = get_option( 'jupiterx_classic_settings' );


		$load_elementor = ( ! empty( $other_settings ) && is_array( $other_settings ) && isset( $other_settings['load_elementor'] ) ) ? $other_settings['load_elementor'] : 'off';

		if ( 'on' == $load_elementor ) {
//			die();
			Elementor_Test_Extension::instance();

		}

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Jupiterx_Classic_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

}
