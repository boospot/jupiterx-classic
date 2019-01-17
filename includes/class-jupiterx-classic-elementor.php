<?php
// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


final class Elementor_Test_Extension {

	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
	const MINIMUM_PHP_VERSION = '7.0';

	private static $_instance = null;

	public function __construct() {

		add_action( 'plugins_loaded', [ $this, 'init' ] );

	}

	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;

	}

	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );

			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );

			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );

			return;
		}

		/**
		 * Only when all check have passed, the extension should load
		 * all the files required to run the plugin at the correct hooks.
		 * It can be done using the following code:
		 */
		// Add Plugin actions
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
//		add_action( 'elementor/controls/controls_registered', array( $this, 'init_controls' ) );


		/**
		 * In some widgets we would like to register custom styles,
		 * this can be done with the elementor/frontend/after_enqueue_styles hook, using the following code:
		 */
		// Register Widget Styles
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );

		/**
		 * Other widgets need custom JS to run,
		 * in those cases we need to register scripts
		 * with the elementor/frontend/after_register_scripts hook,
		 * using the following code:
		 */
		// Register Widget Scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );


		/**
		 * To add a new widget to Elementor we need to register the widget class using the widget manager.
		 * It’s a pretty simple process, it is done using the elementor/widgets/widgets_registered action.
		 */
		// Include plugin files
//		$this->includes();

		// Register widgets
//		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );


		/**
		 * Registering New Controls
		 * To add a new controls to Elementor we need to
		 * register the control class using
		 * the elementor/controls/controls_registered action hook.
		 */
		// Register controls
//		add_action( 'elementor/controls/controls_registered', [ $this, 'register_controls' ] );


		// Testing Dynamic Tags
		add_action( 'elementor/dynamic_tags/register_tags', array( $this, 'register_dynamic_tags' ) );


	}

	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
		/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'elementor-test-extension' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'elementor-test-extension' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-test-extension' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
		/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-extension' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'elementor-test-extension' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-test-extension' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
		/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-extension' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'elementor-test-extension' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'elementor-test-extension' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}


	public function init_widgets() {

		// Include Widget files
		require_once( __DIR__ . '/widgets/test-widget.php' );

		// Register widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Test_Widget() );

	}

	public function init_controls() {

		// Include Control files
		require_once( __DIR__ . '/controls/test-control.php' );

		// Register control
		\Elementor\Plugin::$instance->controls_manager->register_control( 'control-type-', new \Test_Control() );

	}

	public function widget_styles() {

		wp_register_style( 'widget-1', plugins_url( 'css/widget-1.css', __FILE__ ) );
		wp_register_style( 'widget-2', plugins_url( 'css/widget-2.css', __FILE__ ) );

	}

	public function widget_scripts() {

		wp_register_script( 'some-library', plugins_url( 'js/libs/some-library.js', __FILE__ ) );
		wp_register_script( 'widget-1', plugins_url( 'js/widget-1.js', __FILE__ ) );
		wp_register_script( 'widget-2', plugins_url( 'js/widget-2.js', __FILE__ ), [ 'jquery', 'some-library' ] );

	}

	public function includes() {


		// for Registering New Widgets
		require_once( __DIR__ . '/widgets/test-widget-1.php' );
		require_once( __DIR__ . '/widgets/test-widget-2.php' );

		// for Registering New Controls
		require_once( __DIR__ . '/controls/test-control-1.php' );
		require_once( __DIR__ . '/controls/test-control-2.php' );


	}

	public function register_widgets() {

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Test_Widget1() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor_Test_Widget2() );

	}


	public function register_controls() {

		$controls_manager = \Elementor\Plugin::$instance->controls_manager;
		$controls_manager->register_control( 'control-type-1', new Test_Control1() );
		$controls_manager->register_control( 'control-type-2', new Test_Control2() );

	}


	/**
	 * Register Dunamic Tags
	 */
	public function register_dynamic_tags() {

		// In our Dynamic Tag we use a group named request-variables so we need
		// To register that group as well before the tag
		\Elementor\Plugin::$instance->dynamic_tags->register_group( 'jupiterx-post-meta', [
			'title' => 'Meta Data'
		] );

		// Include the Dynamic tag class file
		include_once( 'dynamic/class-jupiterx-classic-elementor-dynamic-tag.php' );

		// Finally register the tag
		\Elementor\Plugin::$instance->dynamic_tags->register_tag( 'Elementor_Server_Var_Tag' );
	}


}
//Elementor_Test_Extension::instance();