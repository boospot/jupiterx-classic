<?php

// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! isset( $column_count ) ) {
	$column_count = 'column-three';
}


?>

<?php
if ( $show_filter ):
	$news_categories = get_terms( array(
		'taxonomy'   => 'news_category',
		'hide_empty' => true,
	) );

	$cat_filter_html = '<div class="button-group filters-button-group news-filter-buttons">';
	$cat_filter_html .= '<button class="button is-checked" data-filter="*">show all</button>';


	foreach ( $news_categories as $category ) {
		$cat_filter_html .= ' <button class="button" data-filter=".' . $category->slug . '">' . $category->name . '</button>';
	}

	$cat_filter_html .= '</div>';


	echo $cat_filter_html;
endif;
?>

<section id="primary" class="content-area">
	<?php if ( $loop->have_posts() ) : ?>

        <div class="cards-grid news-grid <?php echo $column_count; ?>">
			<?php
			// Start the Loop.
			while ( $loop->have_posts() ) :
				$loop->the_post();

				$thumb_id = get_post_thumbnail_id();

				//$img_src = wp_get_attachment_image_src( $thumb_id ,'employees-large');

				$news_date = get_post_meta( get_the_ID(), '_news_date', true );
				$news_date = new DateTime( $news_date );

				$news_url = esc_url_raw( get_post_meta( get_the_ID(), '_news_detail_url', true ) );


				$news_cats          = get_the_terms( get_the_ID(), 'news_category' );
				$news_terms_classes = ' ';

				if ( is_array( $news_cats ) and ! empty( $news_cats ) ) {
					foreach ( $news_cats as $term ) {
						$news_terms_classes = $news_terms_classes . ' ' . $term->slug;
					}
				}

				unset( $news_cats );
				//var_dump( $news_cats); die();

				?>

                <article class="single-card news-card <?php echo $news_terms_classes; ?>"
                         data-category="<?php echo $news_terms_classes; ?>">
                    <a class="card-link" href="<?php echo $news_url; ?>" target="_blank">
                        <picture class="thumbnail card-img">
							<?php echo get_the_post_thumbnail( null, 'medium' ); ?>
                        </picture>
                        <div class="">
                            <h4 class="card-title name"><?php echo get_the_title(); ?></h4>
                            <div class="news-date"><?php echo $news_date->format( 'M d, Y' ) ?></div>
                        </div><!-- .card-content -->
                    </a>
                </article><!-- .card -->


			<?php
				// End the loop.
			endwhile;
			?>
        </div><!-- .cards -->
	<?php
	// If no content, include the "No posts found" template.
	else :
		wpautop( __( 'No News Found', 'jupiterx-classic' ) );
	endif;
	?>

</section><!-- .content-area -->
