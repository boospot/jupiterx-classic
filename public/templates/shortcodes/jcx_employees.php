<?php

// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if(!isset($column_count)){
	$column_count = 'column-three';
}

?>

<section id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

		<?php if ( $loop->have_posts() ) : ?>

            <section class="cards <?php echo $column_count; ?>">
				<?php
				// Start the Loop.
				while (  $loop->have_posts() ) :
					$loop->the_post();

					include Jupiterx_Classic_Global::get_template( 'employee-card', 'employee-card', 'archive' );

					// End the loop.
				endwhile;
				?>
            </section><!-- .cards -->
			<?php
		// If no content, include the "No posts found" template.
		else :
			wpautop( __('No Team Members Found', 'jupiterx-classic'));
		endif;
		?>

    </main><!-- .site-main -->
</section><!-- .content-area -->