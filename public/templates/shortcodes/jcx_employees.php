<?php

// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if(!isset($column_count)){
	$column_count = 'column-three';
}

?>

<section class="content-area">
		<?php if ( $loop->have_posts() ) : ?>

            <div class="cpt-cards <?php echo $column_count; ?>">
				<?php
				// Start the Loop.
				while (  $loop->have_posts() ) :
					$loop->the_post();

					include Jupiterx_Classic_Global::get_template( 'employee-card', 'employee-card', 'archive' );

					// End the loop.
				endwhile;
				?>
            </div><!-- .cards -->
			<?php
		// If no content, include the "No posts found" template.
		else :
			wpautop( __('No Team Members Found', 'jupiterx-classic'));
		endif;
		?>
</section><!-- .content-area -->