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

		$meta_information_html = Jupiterx_Classic_Global::get_employee_name_position( $post->ID ) . Jupiterx_Classic_Global::mk_employees_meta_information( $post->ID );


		?>
        <div class="mk-employee-container"  itemscope itemtype="http://schema.org/Person">
			<?php if ( $style == 'style1' ): ?>
                <div class="employee-style-1">
                    <div class="single-employee-sidebar a_display-inline-block a_float-left">
                        <div class="employee-img">
						<?php
						echo get_the_post_thumbnail( null, 'employees-large' );
						?>
                        </div>
						<?php echo $meta_information_html; ?>
                    </div>
                    <div class="single-employee-content">
						<?php the_content(); ?>
                    </div>
                </div>
			<?php elseif ( $style == 'style2' ): ?>
                <div class="mk-employee-container employee-style-2">
                    <div class="single-employee-sidebar a_display-inline-block a_float-left">
                        <div class="employee-img"><?php echo get_the_post_thumbnail( null, 'employees-large' ); ?></div>
                    </div>
                    <div class="single-employee-content">
						<?php echo $meta_information_html; ?>
						<?php the_content(); ?>
                    </div>
                </div>
			<?php else: ?>
                <div class="employee-style-3">
                    <div class="single-employee-hero-title a_align-center a_margin-bottom-20 skin-<?php echo $header_hero_skin ?>"
                         style="
                                 background-color:<?php echo $header_hero_bg_color ?>;

                                 background-image:url(<?php if ( isset( $header_hero_bg_image_url ) )
						     echo $header_hero_bg_image_url ?>);
                                 background-size: cover; background-position: center center;
                                 ">
                        <div class="employee-img"><?php echo get_the_post_thumbnail( null, 'employees-large' ); ?></div>
						<?php echo $meta_information_html; ?>
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