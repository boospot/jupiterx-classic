<?php
// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $wp;
//$current_page_url = home_url( $wp->request );
/**
 * Get a custom header-employees.php file, if it exists.
 * Otherwise, get default header.
 */

get_header( 'employees' ); ?>

<section id="primary" class="content-area">
		<?php if ( have_posts() ) : ?>

            <div class="cpt-cards column-three">
				<?php
				// Start the Loop.
				while ( have_posts() ) :
					the_post();

					include Jupiterx_Classic_Global::get_template( 'employee-card', 'employee-card', 'archive' );

					// End the loop.
				endwhile;
				?>
            </div><!-- .cards -->
			<?php

			// Previous/next page navigation.
			the_posts_pagination(
				array(
					'prev_text'          => __( 'Previous page', 'jupiterx-classic' ),
					'next_text'          => __( 'Next page', 'jupiterx-classic' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'jupiterx-classic' ) . ' </span>',
				)
			);

		// If no content, include the "No posts found" template.
		else :
			wpautop( __('No Team Members Found', 'jupiterx-classic'));
		endif;
		?>

</section><!-- .content-area -->


<?php get_footer( 'employees' ); ?>
