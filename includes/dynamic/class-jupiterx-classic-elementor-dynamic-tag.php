<?php

Class Elementor_Server_Var_Tag extends \Elementor\Core\DynamicTags\Tag {

	/**
	 * Get Name
	 *
	 * Returns the Name of the tag
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return string
	 */
	public function get_name() {
		return 'special-fields';
	}

	/**
	 * Get Title
	 *
	 * Returns the title of the Tag
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return string
	 */
	public function get_title() {
		return __( 'Custom Fields', 'elementor-pro' );
	}

	/**
	 * Get Group
	 *
	 * Returns the Group of the tag
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return string
	 */
	public function get_group() {
		return 'jupiterx-post-meta';
	}

	/**
	 * Get Categories
	 *
	 * Returns an array of tag categories
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array
	 */
	public function get_categories() {
		return [
			\Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY,
//			\Elementor\Modules\DynamicTags\Module::URL_CATEGORY,
//			\Elementor\Modules\DynamicTags\Module::IMAGE_CATEGORY,
//			\Elementor\Modules\DynamicTags\Module::MEDIA_CATEGORY,
//			\Elementor\Modules\DynamicTags\Module::POST_META_CATEGORY,
		];
	}

	/**
	 * Render
	 *
	 * Prints out the value of the Dynamic tag
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function render() {


//		$post_type_selected = $this->get_settings( 'post_type' );

		$post_id  = $this->get_settings( 'post_id' );
		$meta_key = $this->get_settings( 'meta_key' );


		if ( ! $post_id ) {
			return;
		}


//		if ( ! isset( $_SERVER[ $param_name ] ) ) {
//			return;
//		}
//
//		$value = $_SERVER[ $param_name ];
		echo wp_kses_post( get_post_meta( $post_id, $meta_key , true ) );
	}

	/**
	 * Get Post Type meta
	 */
	public function get_post_type_meta( $post_type ) {


		global $wpdb;

//		$res = $wpdb->get_results( $wpdb->prepare(
//			"SELECT post_id, meta_key, meta_value FROM {$wpdb->postmeta} WHERE post_id IN
//        (SELECT ID FROM {$wpdb->posts} WHERE post_type = %s)", $post_type
//		), ARRAY_A );

		$res = array(
			'employees' => array(
				'employee_name' => 'Employee Name'
			),
			'faq'       => array(
				'question' => 'Question',
				'answer'   => 'Answer'
			),
		);


		return $res[ $post_type ];

	}

	/**
	 * Register Controls
	 *
	 * Registers the Dynamic tag controls
	 *
	 * @since 2.0.0
	 * @access protected
	 *
	 * @return void
	 */
	protected function _register_controls() {


//		$registered_post_types = [];
//		$variables = [];

//		foreach ( get_post_types( '', 'objects' ) as $post_type ) {
//			$registered_post_types[ $post_type->name ] = $post_type->label;
//		}
//
//		$this->add_control(
//			'post_type',
//			[
//				'label'   => __( 'Post Type', 'elementor-pro' ),
//				'type'    => \Elementor\Controls_Manager::SELECT,
//				'options' => $registered_post_types,
//			]
//		);


		$options = array();

		$this->add_control(
			'post_id',
			[
				'label' => __( 'Custom Post id', 'elementor-pro' ),
				'type'  => \Elementor\Controls_Manager::NUMBER,
			]
		);


		$field_group = acf_get_fields( 'group_5c3f0cb931bd3' );

//		$field_group = $field_group[0];

		$employee_meta_keys = array();

//		var_dump( $field_group );

		foreach ( $field_group as $field ) {
			$employee_meta_keys[ $field['name'] ] = $field['label'];
		}
//		var_dump( $employee_meta_keys ) ;


		$this->add_control(
			'meta_key',
			[
				'label'   => __( 'Meta Key', 'elementor-pro' ),
				'type'    => \Elementor\Controls_Manager::SELECT2,
				'options' => $employee_meta_keys,
			]
		);


//		$control_settings = $this->get_controls_settings();

//		$selected_post_id = $control_settings['$post_id'];

//		$meta_data = $this->get_post_type_meta( $selected_post_id );

//		var_dump( $meta_data );

//
//		$updated_variables[ $post_type_selected ] = $meta_data;

//		$this->update_control(
//			'meta_key',
//			[
//				'options' => array_flip( acf_get_fields( 'group_5c3c272852acb' ) ),
//			]
//		);

	}
}