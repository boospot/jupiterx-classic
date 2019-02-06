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

$taxonomy               = 'partners_category';
$taxonomy_terms_classes = '';
$filter_grid_class      = '';
$filter_card_class      = '';

if ( $show_filter ):

	$categories_to_include = str_getcsv( strtolower( $categories ) );
	$categories_to_include = array_map( 'trim', $categories_to_include );

	$filter_grid_class = ' filter-grid ';
	$filter_card_class = ' filter-card ';

	$post_type_categories = get_terms( array(
		'taxonomy'   => $taxonomy,
		'hide_empty' => true,
		'slug'    => $categories_to_include
	) );


	$cat_filter_html = '<div class="button-group filters-button-group partners-filter-buttons">';
	$cat_filter_html .= '<button class="button is-checked" data-filter="*">show all</button>';

	foreach ( $post_type_categories as $category ) :

		$cat_filter_html .= ' <button class="button" data-filter=".' . $category->slug . '">'
		                    . $category->name
		                    . '</button>';
	endforeach;

	$cat_filter_html .= '</div>';

	echo $cat_filter_html;
endif;
?>

<section id="primary" class="content-area">
	<?php if ( $loop->have_posts() ) : ?>

        <div class="cards-grid partners-grid <?php echo $column_count . " " . $filter_grid_class; ?>">
			<?php
			// Start the Loop.
			while ( $loop->have_posts() ) :
				$loop->the_post();


				$thumb_id = get_post_thumbnail_id();


				$partners_url = esc_url_raw( get_post_meta( get_the_ID(), '_partners_url', true ) );


				if ( $show_filter ):
					$taxonomy_terms         = get_the_terms( get_the_ID(), $taxonomy );
					$taxonomy_terms_classes = ' ';

					if ( is_array( $taxonomy_terms ) and ! empty( $taxonomy_terms ) ) {
						foreach ( $taxonomy_terms as $term ) {
							$taxonomy_terms_classes = $taxonomy_terms_classes . ' ' . $term->slug;
						}
					}

					unset( $taxonomy_terms );
					//var_dump( $news_cats); die();

				endif;


				?>

                <article class="single-card partners-card <?php echo $taxonomy_terms_classes . " " . $filter_card_class; ?>"
                        data-category="<?php echo $taxonomy_terms_classes; ?>">
                    <a class="card-link" href="<?php echo $partners_url; ?>" target="_blank">
                        <picture class="thumbnail card-img">
							<?php echo get_the_post_thumbnail( null, 'medium' ); ?>
                        </picture>
                        <div class="">
                            <h4 class="card-title name"><?php echo get_the_title(); ?></h4>
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
		wpautop( __( 'No Partners Found', 'jupiterx-classic' ) );
	endif;
	?>

</section><!-- .content-area -->
