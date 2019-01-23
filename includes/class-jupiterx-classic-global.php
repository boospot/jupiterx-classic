<?php

/**
 * Contains necessary helper functions
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Jupiterx_Classic
 * @subpackage Jupiterx_Classic/includes
 * @author     Rao <rao@booskills.com>
 */
class Jupiterx_Classic_Global {


	protected static $custom_post_types = array( 'employees', 'faq', 'news', 'testimonial' );

	/**
	 * Returns the path to a template file
	 *
	 * Looks for the file in these directories, in this order:
	 *        Current theme
	 *        Parent theme
	 *        Current theme templates folder
	 *        Parent theme templates folder
	 *        This plugin
	 *
	 * To use a custom list template in a theme, copy the
	 * file from public/templates into a templates folder in your
	 * theme. Customize as needed, but keep the file name as-is. The
	 * plugin will automatically use your custom template file instead
	 * of the ones included in the plugin.
	 *
	 * @param    string $name The name of a template file
	 * @param
	 *
	 * @return    string                        The path to the template
	 */
	public static function get_template( $template, $name, $sub_directory = null ) {

		$locations[] = "{$name}.php";
		$locations[] = "/templates/{$name}.php";

		/**
		 * Filter the locations to search for a template file
		 *
		 * @param    array $locations File names and/or paths to check
		 */
		$locations = apply_filters( 'jupiterx_classic_template_paths', $locations );

		$locate_template = locate_template( $locations, true );


		// If we cannot find template path,
		if ( ! empty( $locate_template ) ) {

			$template = $locate_template;

		} else {

			if ( $sub_directory != null ) {
				$sub_directory_path = trailingslashit( sanitize_key( $sub_directory ) );
			} else {
				$sub_directory_path = '';
			}

			$public_template = plugin_dir_path( dirname( __FILE__ ) ) . "public/templates/$sub_directory_path" . $name . '.php';

			if ( is_file( $public_template ) ) {
				$template = $public_template;
			} else {
				$try_to_get_file = apply_filters( 'jupiterx_classic_template_additional_paths', array(
					'name'               => $name,
					'sub_directory_path' => $sub_directory_path
				) );

				if ( ! is_array( $try_to_get_file ) && is_file( $try_to_get_file ) ) {
					$template = $try_to_get_file;
				}
			}


		}

		return $template;

	} // get_template()


	public static function get_cpts_to_load() {

		$jupiterx_cpts_to_load = get_option( 'jupiterx_classic_cpt' );


		if (
			$jupiterx_cpts_to_load
			&& is_array( $jupiterx_cpts_to_load )
			&& isset( $jupiterx_cpts_to_load['load_cpt'] )
			&& is_array( $jupiterx_cpts_to_load['load_cpt'] )
		) {
			return $jupiterx_cpts_to_load['load_cpt'];
		} else {
			return self::$custom_post_types;
		}


	}


	public static function mk_employees_meta_information( $post_id ) {
		$facebook      = esc_url( get_post_meta( $post_id, '_facebook', true ) );
		$linkedin      = esc_url( get_post_meta( $post_id, '_linkedin', true ) );
		$twitter       = esc_url( get_post_meta( $post_id, '_twitter', true ) );
		$email         = sanitize_email( get_post_meta( $post_id, '_email', true ) );
		$googleplus    = esc_url( get_post_meta( $post_id, '_googleplus', true ) );
		$instagram     = esc_url( get_post_meta( $post_id, '_instagram', true ) );
		$employee_name = the_title_attribute( array( 'echo' => false, 'post' => $post_id ) );


		$output = '<ul class="mk-employeee-networks s_meta">';
		if ( ! empty( $email ) ) {
			$output .= '<li><a target="_blank" href="mailto:' . antispambot( $email ) . '" title="' . esc_attr__( 'Get In Touch With', 'jupiterx-classic' ) . ' ' . $employee_name . '">' . '<i class="fa fa-envelope"></i>' . '</a></li>';
		}
		if ( ! empty( $facebook ) ) {
			$output .= '<li><a target="_blank" href="' . $facebook . '" title="' . $employee_name . ' ' . esc_attr__( 'On', 'jupiterx-classic' ) . ' Facebook">' . '<i class="fa fa-facebook"></i>' . '</a></li>';
		}
		if ( ! empty( $twitter ) ) {
			$output .= '<li><a target="_blank" href="' . $twitter . '" title="' . $employee_name . ' ' . esc_attr__( 'On', 'jupiterx-classic' ) . ' Twitter">' . '<i class="fa fa-twitter"></i>' . '</a></li>';
		}
		if ( ! empty( $googleplus ) ) {
			$output .= '<li><a target="_blank" href="' . $googleplus . '" title="' . $employee_name . ' ' . esc_attr__( 'On', 'jupiterx-classic' ) . ' Google Plus">' . '<i class="fa fa-google-plus"></i>' . '</a></li>';
		}
		if ( ! empty( $linkedin ) ) {
			$output .= '<li><a target="_blank" href="' . $linkedin . '" title="' . $employee_name . ' ' . esc_attr__( 'On', 'jupiterx-classic' ) . ' Linked In">' . '<i class="fa fa-linkedin"></i>' . '</a></li>';
		}
		if ( ! empty( $instagram ) ) {
			$output .= '<li><a target="_blank" href="' . $instagram . '" title="' . $employee_name . ' ' . esc_attr__( 'On', 'jupiterx-classic' ) . ' Instagram">' . '<i class="fa fa-instagram"></i>' . '</a></li>';
		}
		$output .= '</ul></span>';

		return $output;
	}


	/**
	 *
	 */
	public static function get_employee_name_position( $post_id ) {

		$output = '<span class="employees_meta"><h1 class="team-member team-member-name s_meta a_align-center a_display-block a_margin-top-40 a_font-weight-bold a_color-333 a_font-22" itemprop="name">' . get_the_title( $post_id ) . '</h1>';
		$output .= '<span class="team-member team-member-position s_meta a_align-center a_display-block a_margin-top-15 a_font-weight-normal a_color-777 a_font-14" itemprop="jobTitle">' . get_post_meta( $post_id, '_position', true ) . '</span>';


		return $output;
	}


}
