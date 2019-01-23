<?php
// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// if class already defined, bail out
if ( class_exists( 'Jupiterx_Classic_Shortcodes' ) ) {
	return;
}

/**
 * Class Boorecipe_Shortcodes
 */
class Jupiterx_Classic_Shortcodes {

	/**
	 * Private static reference to this class
	 * Useful for removing actions declared here.
	 *
	 * @var    object $_this
	 */
	protected static $_this;

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	protected $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	protected $version;

	/**
	 * @var bool
	 */
	protected $style_enqueued = false;

	/**
	 * @var null|array $shortcode_atts
	 */
	protected $shortcode_atts;

	/**
	 * @var string $shortcode_css
	 */
	protected $shortcode_css;

	/**
	 * @var int
	 */
	protected $shortcode_counter = 1;

	/**
	 * @var string
	 */
	protected $shortcode_called = '';

	/**
	 * @var array
	 */
	protected $shortcodes_registered = array();

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param      string $plugin_name The name of the plugin.
	 * @param      string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		self::$_this = $this;

		$this->plugin_name    = $plugin_name;
		$this->version        = $version;
		$this->shortcode_atts = null;

	} // __construct

	/**
	 * Registering a style so that we may populate it with wp_inline_style later
	 * for displaying shortcode related configurable css
	 */
	public function register_styles() {

		wp_register_style( $this->plugin_name . '-shortcodes', false );

	}


	/**
	 * @param $atts
	 *
	 * @hooked recipes_browse shortcode registered
	 *
	 * @return mixed
	 */
	public function mk_employees( $atts ) {

		$atts = shortcode_atts(
			apply_filters( 'jxc_shortcode_atts_employees', array(
				'count'             => 10,
				'column'            => 3,
				'style'             => 'simple',
				'custom_image_size' => 'false',
				'image_size'        => 'crop',
				'image_width'       => 500,
				'image_height'      => 500,
				'rounded_image'     => 'true',
				'box_border_color'  => '',
				'box_bg_color'      => '',
				'employees'         => '',
				'categories'        => '',
				'animation'         => '',
				'description'       => 'true',
				'visibility'        => '',
				'el_class'          => '',
				'offset'            => 0,
				'orderby'           => 'date',
				'order'             => 'DESC',
				'name_color'        => '',
				'position_color'    => '',
				'about_color'       => '',
				'social_color'      => '',
				'grayscale_image'   => 'true',
			) ),
			$atts,
			'mk_employees'
		);

		$post_type = 'employees';

		extract($atts);

		switch ( $atts['column'] ) {
			case ( 1 ):
				$column_count = 'column-one';
				break;
			case ( 2 ):
				$column_count = 'column-two';
				break;
			case ( 3 ):
				$column_count = 'column-three';
				break;
			case ( 4 ):
				$column_count = 'column-four';
				break;
			case ( 5 ):
				$column_count = 'column-five';
				break;
			case ( 6 ):
				$column_count = 'column-six';
				break;
			default:
				$column_count = 'column-three';
		}


//		$this->setup_shortcode_data( $atts, 'recipes_browse', 'archive' );

//
//		if ( sanitize_key( $atts['show_in_masonry'] ) === 'yes' ) {
//			wp_enqueue_script( 'masonry' );
//		}

		wp_enqueue_style( $this->plugin_name . '-archive-employee' );

		wp_enqueue_style( 'font-awesome' );

		$query_args = array(
			'post_type'      => 'employees',
			'post_status'    => 'publish',
			'posts_per_page' => absint( $atts['count'] ),
		);


		$query = $this->mk_wp_query(array(
			'post_type' => $post_type,
			'count' => $count,
			'offset' => $offset,
			'posts' => $employees,
			'categories' => $categories,
			'orderby' => $orderby,
			'order' => $order,
		));



		$loop = $query['wp_query'] ;

//		$archive_layout = sanitize_key( $atts['recipe_archive_layout'] );
//
//		// $archive_template is required in included file
//		$archive_template = ( is_file( boorecipe_get_template( "archive-recipe-content-{$archive_layout}", 'archive' ) ) )
//
//			? boorecipe_get_template( "archive-recipe-content-{$archive_layout}", 'archive' )
//			: boorecipe_get_template( "archive-recipe-content-grid", 'archive' );


		ob_start();

		include Jupiterx_Classic_Global::get_template( 'jcx_employees', 'jcx_employees', 'shortcodes' );
		wp_reset_postdata();

		return ob_get_clean();

	}

	/**
	 * @param $atts
	 *
	 * @hooked recipes_browse shortcode registered
	 *
	 * @return mixed
	 */
	public function mk_news( $atts ) {

		$atts = shortcode_atts(
			apply_filters( 'jxc_shortcode_atts_news', array(
				'count'             => 10,
				'column'            => 3,
				'style'             => 'simple',
				'custom_image_size' => 'false',
				'image_size'        => 'crop',
				'image_width'       => 500,
				'image_height'      => 500,
				'rounded_image'     => 'true',
				'box_border_color'  => '',
				'box_bg_color'      => '',
				'news'         => '',
				'categories'        => '',
				'animation'         => '',
				'description'       => 'true',
				'visibility'        => '',
				'el_class'          => '',
				'offset'            => 0,
				'orderby'           => 'date',
				'order'             => 'DESC',
				'name_color'        => '',
				'position_color'    => '',
				'about_color'       => '',
				'social_color'      => '',
				'grayscale_image'   => 'true',
			) ),
			$atts,
			'mk_news'
		);

		$post_type = 'news';

		extract($atts);

		switch ( $atts['column'] ) {
			case ( 1 ):
				$column_count = 'column-one';
				break;
			case ( 2 ):
				$column_count = 'column-two';
				break;
			case ( 3 ):
				$column_count = 'column-three';
				break;
			case ( 4 ):
				$column_count = 'column-four';
				break;
			case ( 5 ):
				$column_count = 'column-five';
				break;
			case ( 6 ):
				$column_count = 'column-six';
				break;
			default:
				$column_count = 'column-three';
		}


//		$this->setup_shortcode_data( $atts, 'recipes_browse', 'archive' );

//
//		if ( sanitize_key( $atts['show_in_masonry'] ) === 'yes' ) {
//			wp_enqueue_script( 'masonry' );
//		}

		wp_enqueue_style( $this->plugin_name . '-archive-employee' );

//		wp_enqueue_style( 'font-awesome' );

		$query_args = array(
			'post_type'      => 'news',
			'post_status'    => 'publish',
			'posts_per_page' => absint( $atts['count'] ),
		);


		$query = $this->mk_wp_query(array(
			'post_type' => $post_type,
			'count' => $count,
			'offset' => $offset,
			'posts' => $news,
			'categories' => $categories,
			'orderby' => $orderby,
			'order' => $order,
		));



		$loop = $query['wp_query'] ;

//		$archive_layout = sanitize_key( $atts['recipe_archive_layout'] );
//
//		// $archive_template is required in included file
//		$archive_template = ( is_file( boorecipe_get_template( "archive-recipe-content-{$archive_layout}", 'archive' ) ) )
//
//			? boorecipe_get_template( "archive-recipe-content-{$archive_layout}", 'archive' )
//			: boorecipe_get_template( "archive-recipe-content-grid", 'archive' );


		ob_start();

		include Jupiterx_Classic_Global::get_template( 'mk_news', 'mk_news', 'shortcodes' );
		wp_reset_postdata();

		return ob_get_clean();

	}
	/**
	 * USed to enqueue style already registered
	 */
	protected function enqueue_shortcode_style() {


		if ( ! empty( $this->shortcode_css ) ) {
			if ( ! $this->is_already_enqueued() ) {
				wp_enqueue_style( $this->plugin_name . '-shortcodes' );
				$this->style_enqueued = true;
			}
		}

	}

	/**
	 * @return bool
	 */
	protected function is_already_enqueued() {

		return ( $this->style_enqueued ) ? true : false;

	}

	/**
	 * @param array $query_args
	 * @param array $atts
	 *
	 * @return array $query_args
	 */
	protected function setup_posts_query_with_shortcode_atts( $query_args, $atts ) {

		// array of possible query modifiers in shortcode atts
		$possible_query_modifier_args = array(

			'recipe_ids'         => '',
			'recipe_ids_exclude' => '',

			'recipe_category_ids'           => '',
			'recipe_category_slugs'         => '',
			'recipe_category_ids_exclude'   => '',
			'recipe_category_slugs_exclude' => '',

			'recipe_cuisine_ids'           => '',
			'recipe_cuisine_slugs'         => '',
			'recipe_cuisine_ids_exclude'   => '',
			'recipe_cuisine_slugs_exclude' => '',

			'recipe_tags_ids'           => '',
			'recipe_tags_slugs'         => '',
			'recipe_tags_ids_exclude'   => '',
			'recipe_tags_slugs_exclude' => '',

			'skill_level_ids'           => '',
			'skill_level_slugs'         => '',
			'skill_level_ids_exclude'   => '',
			'skill_level_slugs_exclude' => '',

			'cooking_method_ids'           => '',
			'cooking_method_slugs'         => '',
			'cooking_method_ids_exclude'   => '',
			'cooking_method_slugs_exclude' => '',
		);

		/*
		 * try to get modifiers used in the query args
		 */

		// initialize array
		$query_modifiers_in_shortcode = array();

		// populate array
		foreach ( $possible_query_modifier_args as $key => $value ) {
			if ( isset( $atts[ $key ] ) && ! empty( $atts[ $key ] ) ) {
				$query_modifiers_in_shortcode[ $key ] = $atts[ $key ];
			}
		}

		// If no args provided for query modifier, bail out early and return original $args
		if ( empty( $query_modifiers_in_shortcode ) ) {
			return $query_args;
		}


		// Loop through the $query_modifiers_in_shortcode to update $query_args
		foreach ( $query_modifiers_in_shortcode as $property => $value ) :

			// Detect the query modifier type ( post / taxonomy etc. )
			$parameter_type = $this->detect_parameter_type( $property );
			$parts          = explode( '_', $property );

			// update $query_args for $parameter_type: post
			if ( $parameter_type === 'post' ):

				$posts_array = $key_value = '';

				// Get $field, $terms and $operator
				switch ( end( $parts ) ) {
					case ( 'ids' ):
						$posts_array = boorecipe_get_array_from_csv( $value );
						$key_value   = 'post__in';
						break;

					case ( 'exclude' ):
						$posts_array = boorecipe_get_array_from_csv( $value );
						$key_value   = 'post__not_in';
						break;

					default :
				}


				// Using the parameters to update $query_args
				if ( ! empty( $posts_array ) ) {
					$query_args[ $key_value ] = $posts_array;
				}

				continue;    // continue of foreach as we are done for this $parameter_type
			endif; //$parameter_type === 'taxonomy'

			// update $query_args for $parameter_type: taxonomy
			if ( $parameter_type === 'taxonomy' ):
				// Now we need to get the following 4 vars from this array elements
				//			$taxonomy = '';
				//			$field    = '';
				//			$terms    = '';
				//			$operator = '';

				// Setting default $operator
				$taxonomy = '';
				// if exclude not found, then operator is IN
				$operator = 'IN';


				// Get $taxonomy
				switch ( $parts[1] ) {

					case ( 'category' ):
						$taxonomy = 'recipe_category';
						break;
					case ( 'cuisine' ):
						$taxonomy = 'recipe_cuisine';
						break;
					case ( 'tags' ):
						$taxonomy = 'recipe_tags';
						break;
					case ( 'level' ):
						$taxonomy = 'skill_level';
						break;
					case ( 'method' ):
						$taxonomy = 'cooking_method';
						break;
					default:

				}

				// Get $field, $terms and $operator
				switch ( end( $parts ) ) {
					case ( 'ids' ):
						$field = 'term_id';
						$terms = boorecipe_get_array_from_csv( $value );

						break;
					case ( 'slugs' ):
						$field = 'slug';
						$terms = boorecipe_get_array_from_slugs_csv( $value );
						break;

					case ( 'exclude' ):
						$operator = 'NOT IN';
						switch ( $parts[2] ) {
							case ( 'ids' ):
								$field = 'term_id';
								$terms = boorecipe_get_array_from_csv( $value );
								break;
							case ( 'slugs' ):
								$field = 'slug';
								$terms = boorecipe_get_array_from_slugs_csv( $value );
								break;
							default:
								$field = '';
						}

						break;

					default:

						$field = '';
				}

				// Using these 4 args for Taxonomy to update $query_args
				if ( ! empty( $terms ) ) {
					$query_args['tax_query'][] = array(
						'taxonomy' => $taxonomy,
						'field'    => $field,
						'terms'    => $terms,
						'operator' => $operator,
					);

				}

				continue; // break out of foreach
			endif; //$parameter_type === 'taxonomy'

		endforeach;

		return $query_args;

	}

	/**
	 * @param $property
	 *
	 * @return string 'post' or 'taxonomy'
	 */
	protected function detect_parameter_type( $property ) {

		$parts = explode( '_', $property );

		// Detect the query modifier type ( Post / Taxonomy etc. )
		switch ( $parts[1] ) {
			case ( 'ids' ) :
				$parameter_type = 'post';
				break;
			default:
				$parameter_type = 'taxonomy';

		}

		return $parameter_type;
	}

	/**
	 * reset the shortcode relate data to get ready for next shortcode added
	 *
	 * also check setup_shortcode_data()
	 *
	 */
	protected function reset_shortcode_data() {
		$this->shortcode_atts   = null;
		$this->shortcode_called = '';

		// To keep track of counter
		$this->shortcode_counter ++;
	}

	/**
	 * @param $classes_array
	 *
	 * @return mixed
	 */
	public function set_prefix_class( $classes_array ) {

		$classes_array["{$this->shortcode_called}_shortcode_counter"] = $this->get_prefix_class();

		return $classes_array;
	}

	/**
	 * @return string
	 */
	protected function get_prefix_class() {

		$prefix_class = $this->shortcode_called . "-" . $this->shortcode_counter;

		return $prefix_class;
	}

	/**
	 * @return string
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}


	/**
	 *
	 */
	public function mk_wp_query($atts) {


			extract( $atts );

			$count = isset( $count ) ? $count : 10;

			$query = array(
				'post_type' => $post_type,
				'posts_per_page' => (int) $count,
				'suppress_filters' => 0,
			);

			if ( 'attachment' == $post_type ) {
				$query['post_mime_type'] = 'image';
				$query['post_status'] = 'inherit';
			}

			if ( isset( $post_status ) && ! empty( $post_status ) && 'attachment' != $post_type ) {
				$query['post_status'] = $post_status;
			}

			if ( isset( $cat ) && ! empty( $cat ) && 'post' == $post_type ) {
				$query['cat'] = $cat;
			}
			if ( isset( $category_name ) && ! empty( $category_name ) && 'post' == $post_type ) {
				$query['category_name'] = $category_name;
			}

			if ( isset( $categories ) && ! empty( $categories ) && 'post' != $post_type ) {
				$query['tax_query'] = array(
					array(
						'taxonomy' => $post_type . '_category',
						'field' => 'slug',
						'terms' => explode( ',', $categories ),
					),
				);
			}

			if ( isset( $taxonomy_name ) && ! empty( $taxonomy_name ) ) {
				$query['tax_query'] = array(
					array(
						'taxonomy' => $taxonomy_name,
						'field' => 'slug',
						'terms' => $term_slug,
					),
				);
			}

			// Adds exclude option for blog loops post format.
			if ( ! empty( $exclude_post_format ) ) {
				$query['meta_query'] = array(
					array(
						'key' => '_single_post_type',
						'value' => explode( ',',$exclude_post_format ),
						'compare' => 'NOT IN',
					),
				);
			}

			if ( isset( $author ) && ! empty( $author ) ) {
				$query['author'] = $author;
			}
			if ( isset( $author_name ) && ! empty( $author_name ) ) {
				$query['author_name'] = $author_name;
			}
			if ( isset( $posts ) && ! empty( $posts ) ) {
				$query['post__in'] = explode( ',', $posts );
			}
			if ( isset( $orderby ) && ! empty( $orderby ) ) {
				$query['orderby'] = $orderby;
			}
			if ( isset( $order ) && ! empty( $order ) ) {
				$query['order'] = $order;
			}

			if ( isset( $year ) && ! empty( $year ) ) {
				$query['year'] = $year;
			}

			if ( isset( $monthnum ) && ! empty( $monthnum ) ) {
				$query['monthnum'] = $monthnum;
			}

			if ( isset( $m ) && ! empty( $m ) ) {
				$query['m'] = $m;
			}

			if ( isset( $second ) && ! empty( $second ) ) {
				$query['second'] = $second;
			}

			if ( isset( $minute ) && ! empty( $minute ) ) {
				$query['minute'] = $minute;
			}

			if ( isset( $hour ) && ! empty( $hour ) ) {
				$query['hour'] = $hour;
			}

			if ( isset( $w ) && ! empty( $w ) ) {
				$query['w'] = $w;
			}

			if ( isset( $day ) && ! empty( $day ) ) {
				$query['day'] = $day;
			}

			if ( isset( $tag ) && ! empty( $tag ) ) {
				$query['tag'] = $tag;
			}

			if ( isset( $paged ) && ! empty( $paged ) ) {
				$query['paged'] = $paged;
			} else {
				$paged = (get_query_var( 'paged' )) ? get_query_var( 'paged' ) : ((get_query_var( 'page' )) ? get_query_var( 'page' ) : 1);
				$query['paged'] = $paged;
			}

			if ( 1 == $paged ) {
				if ( isset( $offset ) && ! empty( $offset ) ) {
					$query['offset'] = $offset;
				}
			} else {
				if ( isset( $offset ) && ! empty( $offset ) ) {
					if ( ! isset( $post__not_in ) && empty( $post__not_in ) ) {
						$offset = $offset + (($paged - 1) * $count);
					}

					$query['offset'] = $offset;
				}
			}

			// When specific posts are selected from the shortcode settings,
			// It's not possible to set post__not_in.
			if ( empty( $posts ) ) {
				if ( isset( $post__not_in ) && ! empty( $post__not_in ) ) {

					// Set the paged to 1, otherwise we can't get all the availabe posts.
					if ( isset( $paged ) && ! empty( $paged ) ) {
						$query['paged'] = 1;
					}

					$query['post__not_in'] = $post__not_in;
				}
			}

			return array(
				'wp_query' => new WP_Query( $query ),
				'paged' => $paged,
			);

	}

}

