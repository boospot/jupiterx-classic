<?php

// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

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
class Jupiterx_Classic_Post_Types {

	protected $custom_post_types = array( 'employees', 'faq', 'news', 'testimonial', 'partners' );

	protected $cpts_loaded = array();
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

	public function register_post_types() {


//		var_dump( get_option( 'jupiterx_classic_cpt' ) );

		$cpts_to_load = Jupiterx_Classic_Global::get_cpts_to_load();


		if ( array_key_exists( 'employees', $cpts_to_load ) ) {
			$this->cpts_loaded['employees'] = 'employees';

			register_post_type( 'employees', $this->get_employees_args() );

			register_taxonomy( 'employee_category', array( 'employees' ), array(
				'description'       => '',
				'labels'            => array(
					'name'                       => _x( 'Employee Categories', 'taxonomy general name', 'jupiterx-classic' ),
					'singular_name'              => _x( 'Employee Category', 'taxonomy singular name', 'jupiterx-classic' ),
					'search_items'               => __( 'Search Employee Categories', 'jupiterx-classic' ),
					'popular_items'              => __( 'Popular Employee Categories', 'jupiterx-classic' ),
					'all_items'                  => __( 'All Employee Categories', 'jupiterx-classic' ),
					'parent_item'                => __( 'Parent Employee Category', 'jupiterx-classic' ),
					'parent_item_colon'          => __( 'Parent Employee Category:', 'jupiterx-classic' ),
					'edit_item'                  => __( 'Edit Employee Category', 'jupiterx-classic' ),
					'view_item'                  => __( 'View Employee Category', 'jupiterx-classic' ),
					'update_item'                => __( 'Update Employee Category', 'jupiterx-classic' ),
					'add_new_item'               => __( 'Add New Employee Category', 'jupiterx-classic' ),
					'new_item_name'              => __( 'New Employee Category Name', 'jupiterx-classic' ),
					'separate_items_with_commas' => __( 'Separate employee Categories with commas', 'jupiterx-classic' ),
					'add_or_remove_items'        => __( 'Add or remove employee Categories', 'jupiterx-classic' ),
					'choose_from_most_used'      => __( 'Choose from the most used employee Categories', 'jupiterx-classic' ),
					'not_found'                  => __( 'No employee Categories found.', 'jupiterx-classic' ),
				),
				'public'            => true,
				'show_ui'           => true,
				'show_in_nav_menus' => true,
				'show_tagcloud'     => true,
				'meta_box_cb'       => null,
				'show_admin_column' => true,
				'hierarchical'      => true,
				'query_var'         => 'employee_category',
				'rewrite'           => array(
					'slug'         => 'employee_category',
					'with_front'   => true,
					'hierarchical' => true,
				),
				'capabilities'      => array(),
				'show_in_rest'      => true
			) );
		}

		if ( array_key_exists( 'faq', $cpts_to_load ) ) {
			$this->cpts_loaded['faq'] = 'faq';

			register_post_type( 'faq', $this->get_faq_args() );

			register_taxonomy( 'faq_category', array( 'faq' ), array(
				'description'       => 'Frequesntly Asked Questions',
				'labels'            => array(
					'name'                       => _x( 'FAQ Categories', 'taxonomy general name', 'jupiterx-classic' ),
					'singular_name'              => _x( 'FAQ Category', 'taxonomy singular name', 'jupiterx-classic' ),
					'search_items'               => __( 'Search FAQ Categories', 'jupiterx-classic' ),
					'popular_items'              => __( 'Popular FAQ Categories', 'jupiterx-classic' ),
					'all_items'                  => __( 'All FAQ Categories', 'jupiterx-classic' ),
					'parent_item'                => __( 'Parent FAQ Category', 'jupiterx-classic' ),
					'parent_item_colon'          => __( 'Parent FAQ Category:', 'jupiterx-classic' ),
					'edit_item'                  => __( 'Edit FAQ Category', 'jupiterx-classic' ),
					'view_item'                  => __( 'View FAQ Category', 'jupiterx-classic' ),
					'update_item'                => __( 'Update FAQ Category', 'jupiterx-classic' ),
					'add_new_item'               => __( 'Add New FAQ Category', 'jupiterx-classic' ),
					'new_item_name'              => __( 'New FAQ Category Name', 'jupiterx-classic' ),
					'separate_items_with_commas' => __( 'Separate fAQ Categories with commas', 'jupiterx-classic' ),
					'add_or_remove_items'        => __( 'Add or remove fAQ Categories', 'jupiterx-classic' ),
					'choose_from_most_used'      => __( 'Choose from the most used fAQ Categories', 'jupiterx-classic' ),
					'not_found'                  => __( 'No fAQ Categories found.', 'jupiterx-classic' ),
				),
				'public'            => true,
				'show_ui'           => true,
				'show_in_nav_menus' => true,
				'show_tagcloud'     => true,
				'meta_box_cb'       => null,
				'show_admin_column' => false,
				'hierarchical'      => true,
				'query_var'         => 'faq_category',
				'rewrite'           => array(
					'slug'         => 'faq_category',
					'with_front'   => true,
					'hierarchical' => true,
				),
				'capabilities'      => array(),
				'show_in_rest'      => true
			) );
		}

		if ( array_key_exists( 'news', $cpts_to_load ) ) {
			$this->cpts_loaded['news'] = 'news';

			register_post_type( 'news', $this->get_news_args() );

			register_taxonomy( 'news_category', array( 'news' ), array(
				'description'       => 'News Category',
				'labels'            => array(
					'name'                       => _x( 'News Categories', 'taxonomy general name', 'jupiterx-classic' ),
					'singular_name'              => _x( 'News Category', 'taxonomy singular name', 'jupiterx-classic' ),
					'search_items'               => __( 'Search News Categories', 'jupiterx-classic' ),
					'popular_items'              => __( 'Popular News Categories', 'jupiterx-classic' ),
					'all_items'                  => __( 'All News Categories', 'jupiterx-classic' ),
					'parent_item'                => __( 'Parent News Category', 'jupiterx-classic' ),
					'parent_item_colon'          => __( 'Parent News Category:', 'jupiterx-classic' ),
					'edit_item'                  => __( 'Edit News Category', 'jupiterx-classic' ),
					'view_item'                  => __( 'View News Category', 'jupiterx-classic' ),
					'update_item'                => __( 'Update News Category', 'jupiterx-classic' ),
					'add_new_item'               => __( 'Add New News Category', 'jupiterx-classic' ),
					'new_item_name'              => __( 'New News Category Name', 'jupiterx-classic' ),
					'separate_items_with_commas' => __( 'Separate news Categories with commas', 'jupiterx-classic' ),
					'add_or_remove_items'        => __( 'Add or remove news Categories', 'jupiterx-classic' ),
					'choose_from_most_used'      => __( 'Choose from the most used news Categories', 'jupiterx-classic' ),
					'not_found'                  => __( 'No news Categories found.', 'jupiterx-classic' ),
				),
				'public'            => true,
				'show_ui'           => true,
				'show_in_nav_menus' => true,
				'show_tagcloud'     => false,
				'meta_box_cb'       => null,
				'show_admin_column' => true,
				'hierarchical'      => true,
				'query_var'         => 'news_category',
				'rewrite'           => array(
					'slug'         => 'news_category',
					'with_front'   => true,
					'hierarchical' => true,
				),
				'capabilities'      => array(),
				'show_in_rest'      => true
			) );
		}

		if ( array_key_exists( 'testimonial', $cpts_to_load ) ) {
			$this->cpts_loaded['testimonial'] = 'testimonial';

			register_post_type( 'testimonial', $this->get_testimonial_args() );

			register_taxonomy( 'testimonial_category', array( 'testimonial' ), array(
				'description'       => 'Testimonial Categories',
				'labels'            => array(
					'name'                       => _x( 'Testimonail Categories', 'taxonomy general name', 'jupiterx-classic' ),
					'singular_name'              => _x( 'Testimonail Category', 'taxonomy singular name', 'jupiterx-classic' ),
					'search_items'               => __( 'Search Testimonail Categories', 'jupiterx-classic' ),
					'popular_items'              => __( 'Popular Testimonail Categories', 'jupiterx-classic' ),
					'all_items'                  => __( 'All Testimonail Categories', 'jupiterx-classic' ),
					'parent_item'                => __( 'Parent Testimonail Category', 'jupiterx-classic' ),
					'parent_item_colon'          => __( 'Parent Testimonail Category:', 'jupiterx-classic' ),
					'edit_item'                  => __( 'Edit Testimonail Category', 'jupiterx-classic' ),
					'view_item'                  => __( 'View Testimonail Category', 'jupiterx-classic' ),
					'update_item'                => __( 'Update Testimonail Category', 'jupiterx-classic' ),
					'add_new_item'               => __( 'Add New Testimonail Category', 'jupiterx-classic' ),
					'new_item_name'              => __( 'New Testimonail Category Name', 'jupiterx-classic' ),
					'separate_items_with_commas' => __( 'Separate testimonail Categories with commas', 'jupiterx-classic' ),
					'add_or_remove_items'        => __( 'Add or remove testimonail Categories', 'jupiterx-classic' ),
					'choose_from_most_used'      => __( 'Choose from the most used testimonail Categories', 'jupiterx-classic' ),
					'not_found'                  => __( 'No testimonail Categories found.', 'jupiterx-classic' ),
				),
				'public'            => true,
				'show_ui'           => true,
				'show_in_nav_menus' => true,
				'show_tagcloud'     => true,
				'meta_box_cb'       => null,
				'show_admin_column' => true,
				'hierarchical'      => true,
				'query_var'         => 'testimonial_category',
				'rewrite'           => array(
					'slug'         => 'testimonial_category',
					'with_front'   => true,
					'hierarchical' => true,
				),
				'capabilities'      => array(),
			) );
		}

		if ( array_key_exists( 'partners', $cpts_to_load ) ) {

			$this->cpts_loaded['partners'] = 'partners';

			register_post_type( 'partners', $this->get_partners_args() );

			register_taxonomy( 'partners_category', array( 'partners' ), array(

				'description'       => 'Partners Category',
				'labels'            => array(
					'name'                       => _x( 'Partners Categories', 'taxonomy general name', 'jupiterx-classic' ),
					'singular_name'              => _x( 'Partners Category', 'taxonomy singular name', 'jupiterx-classic' ),
					'search_items'               => __( 'Search Partners Categories', 'jupiterx-classic' ),
					'popular_items'              => __( 'Popular Partners Categories', 'jupiterx-classic' ),
					'all_items'                  => __( 'All Partners Categories', 'jupiterx-classic' ),
					'parent_item'                => __( 'Parent Partners Category', 'jupiterx-classic' ),
					'parent_item_colon'          => __( 'Parent Partners Category:', 'jupiterx-classic' ),
					'edit_item'                  => __( 'Edit Partners Category', 'jupiterx-classic' ),
					'view_item'                  => __( 'View Partners Category', 'jupiterx-classic' ),
					'update_item'                => __( 'Update Partners Category', 'jupiterx-classic' ),
					'add_new_item'               => __( 'Add New Partners Category', 'jupiterx-classic' ),
					'new_item_name'              => __( 'New Partners Category Name', 'jupiterx-classic' ),
					'separate_items_with_commas' => __( 'Separate partners Categories with commas', 'jupiterx-classic' ),
					'add_or_remove_items'        => __( 'Add or remove partners Categories', 'jupiterx-classic' ),
					'choose_from_most_used'      => __( 'Choose from the most used partners Categories', 'jupiterx-classic' ),
					'not_found'                  => __( 'No partners Categories found.', 'jupiterx-classic' ),
				),
				'public'            => true,
				'show_ui'           => true,
				'show_in_nav_menus' => true,
				'show_tagcloud'     => true,
				'meta_box_cb'       => null,
				'show_admin_column' => true,
				'hierarchical'      => true,
				'query_var'         => 'partners_category',
				'rewrite'           => array(
					'slug'         => 'partners_category',
					'with_front'   => true,
					'hierarchical' => true,
				),
				'capabilities'      => array(),
				'show_in_rest'      => true
			) );

		}

		add_image_size( 'employees-large', 500, 500, true );


	}

	/**
	 * Get Employees CPT Register Args
	 */
	protected function get_employees_args() {

		$employees_slug_option = get_option( 'jupiterx_classic_employees', true );

//		var_dump( $employees_slug_option); die();

		if ( empty( $employees_slug_option ) ) {
			$employee_slug = 'employees';
		} else {
			$employees_slug_option = ( isset( $employees_slug_option['employees_slug'] ) ) ? sanitize_key( $employees_slug_option['employees_slug'] ) : 'employees';

			$employee_slug = ! empty( $employees_slug_option ) ? $employees_slug_option : 'employees';


		}


		return apply_filters( 'jxc_cpt_args_employees', array(
			'description'          => __( 'Employees', 'jupiterx-classic' ),
			'labels'               => array(
				'name'               => _x( 'Employees', 'post type general name', 'jupiterx-classic' ),
				'singular_name'      => _x( 'Employee', 'post type singular name', 'jupiterx-classic' ),
				'menu_name'          => _x( 'Employees', 'admin menu', 'jupiterx-classic' ),
				'name_admin_bar'     => _x( 'Employee', 'add new employees on admin bar', 'jupiterx-classic' ),
				'add_new'            => _x( 'Add New', 'post_type', 'jupiterx-classic' ),
				'add_new_item'       => __( 'Add New Employee', 'jupiterx-classic' ),
				'edit_item'          => __( 'Edit Employee', 'jupiterx-classic' ),
				'new_item'           => __( 'New Employee', 'jupiterx-classic' ),
				'view_item'          => __( 'View Employee', 'jupiterx-classic' ),
				'search_items'       => __( 'Search Employees', 'jupiterx-classic' ),
				'not_found'          => __( 'No employees found.', 'jupiterx-classic' ),
				'not_found_in_trash' => __( 'No employees found in Trash.', 'jupiterx-classic' ),
				'parent_item_colon'  => __( 'Parent Employee:', 'jupiterx-classic' ),
				'all_items'          => __( 'All Employees', 'jupiterx-classic' ),
			),
			'public'               => true,
			'hierarchical'         => false,
			'exclude_from_search'  => false,
			'publicly_queryable'   => true,
			'show_ui'              => true,
			'show_in_menu'         => true,
			'show_in_nav_menus'    => true,
			'show_in_admin_bar'    => true,
			'menu_position'        => 60,
			'menu_icon'            => 'dashicons-universal-access',
			'capability_type'      => 'post',
			'capabilities'         => array(),
			'map_meta_cap'         => null,
			'supports'             => array( 'title', 'editor', 'thumbnail' ),
			'register_meta_box_cb' => null,
			'taxonomies'           => array( 'employees_category' ),
			'has_archive'          => true,
			'rewrite'              => array(
				'slug'       => $employee_slug,
				'with_front' => true,
				'feeds'      => true,
				'pages'      => true,
			),
			'query_var'            => true,
			'can_export'           => true,
			'show_in_rest'         => true,
		) );

	}

	/**
	 * Get FAQ CPT Register Args
	 */
	protected function get_faq_args() {
		return apply_filters( 'jxc_cpt_args_faqs', array(
			'description'          => __( 'Frequently Asked Questions', 'jupiterx-classic' ),
			'labels'               => array(
				'name'               => _x( 'FAQs', 'post type general name', 'jupiterx-classic' ),
				'singular_name'      => _x( 'FAQ', 'post type singular name', 'jupiterx-classic' ),
				'menu_name'          => _x( 'FAQs', 'admin menu', 'jupiterx-classic' ),
				'name_admin_bar'     => _x( 'FAQ', 'add new faq on admin bar', 'jupiterx-classic' ),
				'add_new'            => _x( 'Add New', 'post_type', 'jupiterx-classic' ),
				'add_new_item'       => __( 'Add New FAQ', 'jupiterx-classic' ),
				'edit_item'          => __( 'Edit FAQ', 'jupiterx-classic' ),
				'new_item'           => __( 'New FAQ', 'jupiterx-classic' ),
				'view_item'          => __( 'View FAQ', 'jupiterx-classic' ),
				'search_items'       => __( 'Search FAQs', 'jupiterx-classic' ),
				'not_found'          => __( 'No fAQs found.', 'jupiterx-classic' ),
				'not_found_in_trash' => __( 'No fAQs found in Trash.', 'jupiterx-classic' ),
				'parent_item_colon'  => __( 'Parent FAQ:', 'jupiterx-classic' ),
				'all_items'          => __( 'All FAQs', 'jupiterx-classic' ),
			),
			'public'               => true,
			'hierarchical'         => false,
			'exclude_from_search'  => false,
			'publicly_queryable'   => true,
			'show_ui'              => true,
			'show_in_menu'         => true,
			'show_in_nav_menus'    => true,
			'show_in_admin_bar'    => true,
			'menu_position'        => 60,
			'menu_icon'            => 'dashicons-list-view',
			'capability_type'      => 'post',
			'capabilities'         => array(),
			'map_meta_cap'         => null,
			'supports'             => array( 'title', 'editor' ),
			'register_meta_box_cb' => null,
			'taxonomies'           => array(),
			'has_archive'          => false,
			'rewrite'              => array(
				'slug'       => 'faq',
				'with_front' => true,
				'feeds'      => false,
				'pages'      => true,
			),
			'query_var'            => true,
			'can_export'           => true,
			'show_in_rest'         => true,
		) );

	}

	/**
	 * Get News CPT Register Args
	 */
	protected function get_news_args() {

		return apply_filters( 'jxc_cpt_args_news', array(
			'description'          => __( 'News', 'jupiterx-classic' ),
			'labels'               => array(
				'name'               => _x( 'News', 'post type general name', 'jupiterx-classic' ),
				'singular_name'      => _x( 'News', 'post type singular name', 'jupiterx-classic' ),
				'menu_name'          => _x( 'News', 'admin menu', 'jupiterx-classic' ),
				'name_admin_bar'     => _x( 'News', 'add new news on admin bar', 'jupiterx-classic' ),
				'add_new'            => _x( 'Add New', 'post_type', 'jupiterx-classic' ),
				'add_new_item'       => __( 'Add New News', 'jupiterx-classic' ),
				'edit_item'          => __( 'Edit News', 'jupiterx-classic' ),
				'new_item'           => __( 'New News', 'jupiterx-classic' ),
				'view_item'          => __( 'View News', 'jupiterx-classic' ),
				'search_items'       => __( 'Search News', 'jupiterx-classic' ),
				'not_found'          => __( 'No news found.', 'jupiterx-classic' ),
				'not_found_in_trash' => __( 'No news found in Trash.', 'jupiterx-classic' ),
				'parent_item_colon'  => __( 'Parent News:', 'jupiterx-classic' ),
				'all_items'          => __( 'All News', 'jupiterx-classic' ),
			),
			'public'               => true,
			'hierarchical'         => false,
			'exclude_from_search'  => false,
			'publicly_queryable'   => true,
			'show_ui'              => true,
			'show_in_menu'         => true,
			'show_in_nav_menus'    => true,
			'show_in_admin_bar'    => true,
			'menu_position'        => 60,
			'menu_icon'            => 'dashicons-megaphone',
			'capability_type'      => 'post',
			'capabilities'         => array(),
			'map_meta_cap'         => null,
			'supports'             => array( 'title', 'editor', 'thumbnail' ),
			'register_meta_box_cb' => null,
			'taxonomies'           => array( 'news_category' ),
			'has_archive'          => true,
			'rewrite'              => array(
				'slug'       => 'news',
				'with_front' => true,
				'feeds'      => true,
				'pages'      => true,
			),
			'query_var'            => true,
			'can_export'           => true,
			'show_in_rest'         => true,
		) );

	}

	/**
	 * Get Testimonial CPT Register Args
	 */
	protected function get_testimonial_args() {
		return apply_filters( 'jxc_cpt_args_testimonial', array(
			'description'          => __( 'Client Tetimonials', 'jupiterx-classic' ),
			'labels'               => array(
				'name'               => _x( 'Testimonials', 'post type general name', 'jupiterx-classic' ),
				'singular_name'      => _x( 'Testimonial', 'post type singular name', 'jupiterx-classic' ),
				'menu_name'          => _x( 'Testimonials', 'admin menu', 'jupiterx-classic' ),
				'name_admin_bar'     => _x( 'Testimonial', 'add new testimonial on admin bar', 'jupiterx-classic' ),
				'add_new'            => _x( 'Add New', 'post_type', 'jupiterx-classic' ),
				'add_new_item'       => __( 'Add New Testimonial', 'jupiterx-classic' ),
				'edit_item'          => __( 'Edit Testimonial', 'jupiterx-classic' ),
				'new_item'           => __( 'New Testimonial', 'jupiterx-classic' ),
				'view_item'          => __( 'View Testimonial', 'jupiterx-classic' ),
				'search_items'       => __( 'Search Testimonials', 'jupiterx-classic' ),
				'not_found'          => __( 'No testimonials found.', 'jupiterx-classic' ),
				'not_found_in_trash' => __( 'No testimonials found in Trash.', 'jupiterx-classic' ),
				'parent_item_colon'  => __( 'Parent Testimonial:', 'jupiterx-classic' ),
				'all_items'          => __( 'All Testimonials', 'jupiterx-classic' ),
			),
			'public'               => true,
			'hierarchical'         => false,
			'exclude_from_search'  => true,
			'publicly_queryable'   => true,
			'show_ui'              => true,
			'show_in_menu'         => true,
			'show_in_nav_menus'    => true,
			'show_in_admin_bar'    => true,
			'menu_position'        => 60,
			'menu_icon'            => 'dashicons-format-quote',
			'capability_type'      => 'post',
			'capabilities'         => array(),
			'map_meta_cap'         => null,
			'supports'             => array( 'title', 'thumbnail' ),
			'register_meta_box_cb' => null,
			'taxonomies'           => array(),
			'has_archive'          => false,
			'rewrite'              => array(
				'slug'       => 'testimonial',
				'with_front' => true,
				'feeds'      => false,
				'pages'      => true,
			),
			'query_var'            => false,
			'can_export'           => true,
			'show_in_rest'         => true,
		) );
	}

	/**
	 * Get Partners Logo CPT Register Args
	 */
	protected function get_partners_args() {


		return apply_filters( 'jxc_cpt_args_partners', array(
			'labels'               => array(
				'name'               => _x( 'Partners', 'post type general name', 'jupiterx-classic' ),
				'singular_name'      => _x( 'Partner', 'post type singular name', 'jupiterx-classic' ),
				'menu_name'          => _x( 'Partners', 'admin menu', 'jupiterx-classic' ),
				'name_admin_bar'     => _x( 'Partner', 'add new partner_logos on admin bar', 'jupiterx-classic' ),
				'add_new'            => _x( 'Add New', 'post_type', 'jupiterx-classic' ),
				'add_new_item'       => __( 'Add New Partner', 'jupiterx-classic' ),
				'edit_item'          => __( 'Edit Partner', 'jupiterx-classic' ),
				'new_item'           => __( 'New Partner', 'jupiterx-classic' ),
				'view_item'          => __( 'View Partner', 'jupiterx-classic' ),
				'search_items'       => __( 'Search Partners', 'jupiterx-classic' ),
				'not_found'          => __( 'No partners found.', 'jupiterx-classic' ),
				'not_found_in_trash' => __( 'No partners found in Trash.', 'jupiterx-classic' ),
				'parent_item_colon'  => __( 'Parent Partner:', 'jupiterx-classic' ),
				'all_items'          => __( 'All Partners', 'jupiterx-classic' ),
			),
			'public'               => true,
			'hierarchical'         => false,
			'exclude_from_search'  => true,
			'publicly_queryable'   => true,
			'show_ui'              => true,
			'show_in_menu'         => true,
			'show_in_nav_menus'    => true,
			'show_in_admin_bar'    => true,
			'menu_position'        => 60,
			'menu_icon'            => 'dashicons-awards',
			'capability_type'      => 'post',
			'capabilities'         => array(),
			'map_meta_cap'         => null,
			'supports'             => array( 'title', 'editor', 'thumbnail' ),
			'register_meta_box_cb' => null,
			'taxonomies'           => array( 'partners_category' ),
			'has_archive'          => true,
			'rewrite'              => array(
				'slug'       => 'partners',
				'with_front' => true,
				'feeds'      => true,
				'pages'      => true,
			),
			'query_var'            => true,
			'can_export'           => true,
			'show_in_rest'         => true,
		) );


	}

	/**
	 * Removes Default Jupiter X Header section that contains title, title and breadcrumbs
	 */

	public function remove_jupiterx_main_header() {


		if ( ! is_single() || ! function_exists( 'jupiterx_remove_action' ) || ! $this->is_remove_jupiterx_header() ) {
			return null;
		}

		$post_type = get_post_type( get_the_ID() );

		foreach ( $this->cpts_loaded as $cpt ) {
			if ( $post_type == $cpt ) {
				jupiterx_remove_action( 'jupiterx_main_header' );
			}
		}
//
//		if ( 'employees' == get_post_type( get_the_ID() ) && function_exists( 'jupiterx_remove_action' ) ) {
//			jupiterx_remove_action( 'jupiterx_main_header' );
//		};

	}

	/**
	 *
	 */
	public function is_remove_jupiterx_header() {

		return apply_filters( 'jxc_remove_jupiter_x_header', true );

	}

	/**
	 * Adds a default single view template for custom Post types
	 *
	 * @param    string $template The name of the template
	 *
	 * @return    mixed                        The single template
	 */
	public function load_single_template( $template ) {

		global $post;

		switch ( $post->post_type ) {
			case( 'employees' ):
				$template = Jupiterx_Classic_Global::get_template( $template, 'single-employees' );
				break;

			case( 'news' ):
				$template = Jupiterx_Classic_Global::get_template( $template, 'single-news' );
				break;

			default:

		}


		return $template;

	}

	/**
	 * Adds a default single view template for custom Post types
	 *
	 * @param    string $template The name of the template
	 *
	 * @return    mixed                        The single template
	 */
	public function load_archive_template( $template ) {

		global $post;


		switch ( $post->post_type ) {
			case( 'employees' ):
				$template = Jupiterx_Classic_Global::get_template( $template, 'archive-employees' );
				break;

			case( 'news' ):
				$template = Jupiterx_Classic_Global::get_template( $template, 'archive-news' );
				break;

			default:

		}


		return $template;

	}

	/**
	 * May be Load ACF Plugin
	 */
	public function maybe_load_acf() {

		/**
		 * Detect plugin. For use on Front End only.
		 */
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );


		if ( is_plugin_active( 'advanced-custom-fields/acf.php' ) || is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {

			// ACF is already active, no need to require the included ACF from plugin itself

		} else {

			/**
			 * Load Metabox.io helper plugin
			 */
			require_once JUPITERX_CLASSIC_PLUGIN_DIR . '/includes/lib/advanced-custom-fields/acf.php';

		}

	}

	/**
	 * Load Employees ACF Fields
	 */
	public function load_acf_fields_employees() {

		if ( function_exists( 'acf_add_local_field_group' ) ):

			acf_add_local_field_group( array(
				'key'                   => 'group_5c3c272852acb',
				'title'                 => 'Employees Settings',
				'fields'                => array(
					array(
						'key'               => 'field_5c3c2dbd0fe34',
						'label'             => 'Single Employee Page?',
						'name'              => '_single_post',
						'type'              => 'select',
						'instructions'      => 'If you enable this option, This employee member will have a single post so you can add extra content in above editor.',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'choices'           => array(
							'false' => 'No',
							'true'  => 'Yes Please',
						),
						'default_value'     => array(),
						'allow_null'        => 1,
						'multiple'          => 0,
						'ui'                => 0,
						'return_format'     => 'value',
						'ajax'              => 0,
						'placeholder'       => '',
					),
					array(
						'key'               => 'field_5c3c2f5ebd3e9',
						'label'             => 'Single Post Layout',
						'name'              => '_employees_single_layout',
						'type'              => 'select',
						'instructions'      => 'Choose single post layout style.',
						'required'          => 0,
						'conditional_logic' => array(
							array(
								array(
									'field'    => 'field_5c3c2dbd0fe34',
									'operator' => '==',
									'value'    => 'true',
								),
							),
						),
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'choices'           => array(
							'style1' => 'Style 1',
							'style2' => 'Style 2',
							'style3' => 'Style 3',
						),
						'default_value'     => array(),
						'allow_null'        => 1,
						'multiple'          => 0,
						'ui'                => 0,
						'return_format'     => 'value',
						'ajax'              => 0,
						'placeholder'       => '',
					),
					array(
						'key'               => 'field_5c3c27462ed28',
						'label'             => 'Employee Position',
						'name'              => '_position',
						'type'              => 'text',
						'instructions'      => 'Please enter team member\'s Position in the company.',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
					),
					array(
						'key'               => 'field_5c3c30612fdd3',
						'label'             => 'Header Hero Background Image',
						'name'              => '_header_hero_bg_image',
						'type'              => 'image',
						'instructions'      => 'Upload an image for single post > style 3 layout > header hero background image. Best image size for this field is 1920px * 550px. (Specific to style 3)',
						'required'          => 0,
						'conditional_logic' => array(
							array(
								array(
									'field'    => 'field_5c3c2f5ebd3e9',
									'operator' => '==',
									'value'    => 'style3',
								),
							),
						),
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'return_format'     => 'url',
						'preview_size'      => 'thumbnail',
						'library'           => 'all',
						'min_width'         => '',
						'min_height'        => '',
						'min_size'          => '',
						'max_width'         => '',
						'max_height'        => '',
						'max_size'          => '',
						'mime_types'        => '',
					),
					array(
						'key'               => 'field_5c3c30b32fdd4',
						'label'             => 'Header Hero Background Color',
						'name'              => '_header_hero_bg_color',
						'type'              => 'color_picker',
						'instructions'      => 'choose a color for single post > style 3 layout > header hero background color. (Specific to style 3)',
						'required'          => 0,
						'conditional_logic' => array(
							array(
								array(
									'field'    => 'field_5c3c2f5ebd3e9',
									'operator' => '==',
									'value'    => 'style3',
								),
							),
						),
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '#666666',
					),
					array(
						'key'               => 'field_5c3c3136c90ae',
						'label'             => 'Header Hero Content Skin',
						'name'              => '_header_hero_skin',
						'type'              => 'select',
						'instructions'      => 'Specific to style 3',
						'required'          => 0,
						'conditional_logic' => array(
							array(
								array(
									'field'    => 'field_5c3c2f5ebd3e9',
									'operator' => '==',
									'value'    => 'style3',
								),
							),
						),
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'choices'           => array(
							'light' => 'Light',
							'dark'  => 'Dark',
						),
						'default_value'     => array(),
						'allow_null'        => 0,
						'multiple'          => 0,
						'ui'                => 0,
						'return_format'     => 'value',
						'ajax'              => 0,
						'placeholder'       => '',
					),
					array(
						'key'               => 'field_5c3c324b2cfef',
						'label'             => 'About Member',
						'name'              => '_desc',
						'type'              => 'wysiwyg',
						'instructions'      => 'This text will be shown in employees loop. To show content in single employee, you should add your content into above WP editor.',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'tabs'              => 'all',
						'toolbar'           => 'full',
						'media_upload'      => 1,
						'delay'             => 0,
					),
					array(
						'key'               => 'field_5c3c32cd2cff0',
						'label'             => 'Email Address',
						'name'              => '_email',
						'type'              => 'text',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
					),
					array(
						'key'               => 'field_5c3c32eb2cff1',
						'label'             => 'Social Network (Facebook)',
						'name'              => '_facebook',
						'type'              => 'text',
						'instructions'      => 'Please enter full URL of this social network(include http://).',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
					),
					array(
						'key'               => 'field_5c3c332b2cff3',
						'label'             => 'Social Network (Twitter)',
						'name'              => '_twitter',
						'type'              => 'text',
						'instructions'      => 'Please enter full URL of this social network(include http://).',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
					),
					array(
						'key'               => 'field_5c3c33412cff4',
						'label'             => 'Social Network (Google Plus)',
						'name'              => '_googleplus',
						'type'              => 'text',
						'instructions'      => 'Please enter full URL of this social network(include http://).',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
					),
					array(
						'key'               => 'field_5c3c33512cff5',
						'label'             => 'Social Network (Linked In)',
						'name'              => '_linkedin',
						'type'              => 'text',
						'instructions'      => 'Please enter full URL of this social network(include http://).',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
					),
					array(
						'key'               => 'field_5c3c33602cff6',
						'label'             => 'Social Network (Instagram)',
						'name'              => '_instagram',
						'type'              => 'text',
						'instructions'      => 'Please enter full URL of this social network(include http://).',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
					),
				),
				'location'              => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'employees',
						),
					),
				),
				'menu_order'            => 0,
				'position'              => 'normal',
				'style'                 => 'default',
				'label_placement'       => 'left',
				'instruction_placement' => 'field',
				'hide_on_screen'        => '',
				'active'                => 1,
				'description'           => '',
			) );

		endif;

	}

	/**
	 * Load Employees ACF Fields
	 */
	public function load_acf_fields_news() {

		if ( function_exists( 'acf_add_local_field_group' ) ):

			acf_add_local_field_group( array(
				'key'                   => 'group_5c484012a05fe',
				'title'                 => 'News Settings',
				'fields'                => array(
					array(
						'key'               => 'field_5c4840404e94b',
						'label'             => 'News Date',
						'name'              => '_news_date',
						'type'              => 'date_picker',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'display_format'    => 'd/m/Y',
						'return_format'     => 'F j, Y',
						'first_day'         => 1,
					),
					array(
						'key'               => 'field_5c4840d54e94c',
						'label'             => 'News Detail URL',
						'name'              => '_news_detail_url',
						'type'              => 'url',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
					),
				),
				'location'              => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'news',
						),
					),
				),
				'menu_order'            => 0,
				'position'              => 'normal',
				'style'                 => 'default',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen'        => '',
				'active'                => 1,
				'description'           => '',
			) );

		endif;

	}

	/**
	 * Load Testimonial ACF Fields
	 */
	public function load_acf_fields_testimonial() {

		if ( function_exists( 'acf_add_local_field_group' ) ):

			acf_add_local_field_group( array(
				'key'                   => 'group_5c3f0cb931bd3',
				'title'                 => 'Testimonial Options',
				'fields'                => array(
					array(
						'key'               => 'field_5c3f0ce447124',
						'label'             => 'Author Name',
						'name'              => '_author',
						'type'              => 'text',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
					),
					array(
						'key'               => 'field_5c3f0cf447125',
						'label'             => 'Company Name / Job Title',
						'name'              => '_company',
						'type'              => 'text',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
					),
					array(
						'key'               => 'field_5c3f0d0a47126',
						'label'             => 'URL To Author\'s Website (Optional)',
						'name'              => '_url',
						'type'              => 'url',
						'instructions'      => 'include http:// or https://',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
					),
					array(
						'key'               => 'field_5c3f0d2f47127',
						'label'             => 'Quote',
						'name'              => '_desc',
						'type'              => 'wysiwyg',
						'instructions'      => 'Please fill below area with the quote',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'tabs'              => 'all',
						'toolbar'           => 'full',
						'media_upload'      => 1,
						'delay'             => 0,
					),
				),
				'location'              => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'testimonial',
						),
					),
				),
				'menu_order'            => 0,
				'position'              => 'normal',
				'style'                 => 'default',
				'label_placement'       => 'left',
				'instruction_placement' => 'field',
				'hide_on_screen'        => '',
				'active'                => 1,
				'description'           => '',
			) );

		endif;

	}

	/**
	 * Load Partners ACF Fields
	 */
	public function load_acf_fields_partners() {

		if( function_exists('acf_add_local_field_group') ):

			acf_add_local_field_group(array(
				'key' => 'group_5c5448e28cab4',
				'title' => 'Partners Settings',
				'fields' => array(
					array(
						'key' => 'field_5c5448e28f9d2',
						'label' => 'Partners Website',
						'name' => '_partners_url',
						'type' => 'url',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'partners',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'side',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => 1,
				'description' => '',
			));

		endif;

	}

	public function alter_query_to_add_recipe_posttype( $query ) {

		if ( is_admin() ) {
			return $query;
		}

		if ( $query->is_main_query() &&
		     ( is_post_type_archive( 'employees' ) || is_tax( array( 'employee_category', ) ) )
		) {

			$query->set( 'post_type', 'employees' );

			// Set Recipes Per Page
//			$recipes_per_page = ( absint( $this->get_options_value( 'recipes_per_page' ) ) > 0 ) ? absint( $this->get_options_value( 'recipes_per_page' ) ) : 9;
//
//
//			$query->set( 'posts_per_page', $recipes_per_page );
//
//
//			// Add Keyword Search to the Query
//			if ( $this->is_search_form_submitted() ) {
//
//				$search_keyword = isset( $_GET['keyword'] ) ? sanitize_text_field( $_GET['keyword'] ) : false;
//
//				if ( $search_keyword ) {
//
//					$custom_meta = array();
//
//					$current_meta = $query->get( 'meta_query' );
//
//
//					$custom_meta[] = array(
//						'key'     => 'boorecipe-recipe-meta',
//						'value'   => $search_keyword,
//						'compare' => 'LIKE'
//					);
//
//
//					$meta_query = $current_meta = $custom_meta;
//
//					$query->set( 'meta_query', array( $meta_query ) );
//
//				}
//
//			}

		}

	}

	/**
	 * Custom Post Types for Team
	 *
	 */

	protected function get_cpts_to_load() {

		$jupiterx_cpts_to_load = get_option( 'jupiterx_classic_cpt' );


		if (
			$jupiterx_cpts_to_load
			&& is_array( $jupiterx_cpts_to_load )
			&& isset( $jupiterx_cpts_to_load['load_cpt'] )
			&& is_array( $jupiterx_cpts_to_load['load_cpt'] )
		) {
			return $jupiterx_cpts_to_load['load_cpt'];
		} else {
			return $this->custom_post_types;
		}


	}

}
