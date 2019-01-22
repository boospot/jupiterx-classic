<?php
/**
 * Template for Single Employee
 */
global $post,
       $mk_options;
get_header();
if ( have_posts() ) {
	while ( have_posts() ) : the_post(); ?>

		<?php

		$style                = esc_attr( get_post_meta( $post->ID, '_employees_single_layout', true ) );
		$header_hero_skin     = esc_attr( get_post_meta( $post->ID, '_header_hero_skin', true ) );
		$header_hero_bg_color = esc_attr( get_post_meta( $post->ID, '_header_hero_bg_color', true ) );
		$header_hero_bg_image = esc_attr( get_post_meta( $post->ID, '_header_hero_bg_image', true ) );

		if ( (int) $header_hero_bg_image > 0 ) {
			$header_hero_bg_image_url = wp_get_attachment_image_src( $header_hero_bg_image, 'full' );
			if ( is_array( $header_hero_bg_image_url ) ) {
				$header_hero_bg_image_url = array_shift( $header_hero_bg_image_url );
			}
		}

		if ( $style != 'style3' ) {
			$image_width  = 270;
			$image_height = 270;
		} else {
			$image_width  = 150;
			$image_height = 150;
		}
		?>

		<?php

		if ( ! function_exists( 'mk_employees_meta_information' ) ) {
			function mk_employees_meta_information() {
				$facebook   = esc_url( get_post_meta( get_the_ID(), '_facebook', true ) );
				$linkedin   = esc_url( get_post_meta( get_the_ID(), '_linkedin', true ) );
				$twitter    = esc_url( get_post_meta( get_the_ID(), '_twitter', true ) );
				$email      = sanitize_email( get_post_meta( get_the_ID(), '_email', true ) );
				$googleplus = esc_url( get_post_meta( get_the_ID(), '_googleplus', true ) );
				$instagram  = esc_url( get_post_meta( get_the_ID(), '_instagram', true ) );


				$output = '<span class="employees_meta"><h1 class="team-member team-member-name s_meta a_align-center a_display-block a_margin-top-40 a_font-weight-bold a_color-333 a_font-22" itemprop="name">' . get_the_title() . '</h1>';
				$output .= '<span class="team-member team-member-position s_meta a_align-center a_display-block a_margin-top-15 a_font-weight-normal a_color-777 a_font-14" itemprop="jobTitle">' . get_post_meta( get_the_ID(), '_position', true ) . '</span>';
				$output .= '<ul class="mk-employeee-networks s_meta">';
				if ( ! empty( $email ) ) {
					$output .= '<li><a target="_blank" href="mailto:' . antispambot( $email ) . '" title="' . esc_attr__( 'Get In Touch With', 'jupiterx-classic' ) . ' ' . the_title_attribute( array( 'echo' => false ) ) . '">'  . '<i class="fa fa-envelope"></i>' . '</a></li>';
				}
				if ( ! empty( $facebook ) ) {
					$output .= '<li><a target="_blank" href="' . $facebook . '" title="' . the_title_attribute( array( 'echo' => false ) ) . ' ' . esc_attr__( 'On', 'jupiterx-classic' ) . ' Facebook">'  . '<i class="fa fa-facebook"></i>' . '</a></li>';
				}
				if ( ! empty( $twitter ) ) {
					$output .= '<li><a target="_blank" href="' . $twitter . '" title="' . the_title_attribute( array( 'echo' => false ) ) . ' ' . esc_attr__( 'On', 'jupiterx-classic' ) . ' Twitter">'  . '<i class="fa fa-twitter"></i>' . '</a></li>';
				}
				if ( ! empty( $googleplus ) ) {
					$output .= '<li><a target="_blank" href="' . $googleplus . '" title="' . the_title_attribute( array( 'echo' => false ) ) . ' ' . esc_attr__( 'On', 'jupiterx-classic' ) . ' Google Plus">'  . '<i class="fa fa-google-plus"></i>' . '</a></li>';
				}
				if ( ! empty( $linkedin ) ) {
					$output .= '<li><a target="_blank" href="' . $linkedin . '" title="' . the_title_attribute( array( 'echo' => false ) ) . ' ' . esc_attr__( 'On', 'jupiterx-classic' ) . ' Linked In">' . '<i class="fa fa-linkedin"></i>' . '</a></li>';
				}
				if ( ! empty( $instagram ) ) {
					$output .= '<li><a target="_blank" href="' . $instagram . '" title="' . the_title_attribute( array( 'echo' => false ) ) . ' ' . esc_attr__( 'On', 'jupiterx-classic' ) . ' Instagram">'  . '<i class="fa fa-instagram"></i>' . '</a></li>';
				}
				$output .= '</ul></span>';

				echo $output;
			}
		}


		?>
        <div itemscope itemtype="http://schema.org/Person">
			<?php if ( $style == 'style1' ): ?>
                <div class="mk-employee-container employee-style-1">
                    <div class="single-employee-sidebar a_display-inline-block a_float-left">
						<?php
//                        the_post_thumbnail( $post->ID  );
						echo get_the_post_thumbnail( null, 'employees-large') ;
                        ?>
						<?php mk_employees_meta_information(); ?>
                    </div>
                    <div class="single-employee-content">
						<?php the_content(); ?>
                    </div>
                </div>
			<?php elseif ( $style == 'style2' ): ?>
                <div class="mk-employee-container employee-style-2">
                    <div class="single-employee-sidebar a_display-inline-block a_float-left">
						<?php the_post_thumbnail( $post->ID ); ?>
                    </div>
                    <div class="single-employee-content">
						<?php mk_employees_meta_information(); ?>
						<?php the_content(); ?>
                    </div>
                </div>
			<?php else: ?>
                <div class="employee-style-3">
                    <div class="single-employee-hero-title a_align-center a_margin-bottom-20 skin-<?php echo $header_hero_skin ?>"
                         style="
                                 background-color:<?php echo $header_hero_bg_color ?>;

                                 background-image:url(<?php if(isset( $header_hero_bg_image_url)) echo $header_hero_bg_image_url ?>);
                                 background-size: cover; background-position: center center;
                                 ">
						<?php the_post_thumbnail( $post->ID ); ?>
						<?php mk_employees_meta_information(); ?>
                    </div>
                    <div class="mk-employee-container">
                        <div class="single-employee-content">
							<?php the_content(); ?>
                        </div>
                    </div>
                </div>
			<?php endif ?>

        </div>
	<?php endwhile;
}
get_footer();
?>