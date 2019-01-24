<?php
// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$thumb_id = get_post_thumbnail_id();

//$img_src = wp_get_attachment_image_src( $thumb_id ,'employees-large');

$news_date = get_post_meta( get_the_ID(), '_news_date', true );
$news_date = new DateTime( $news_date );

$news_url = esc_url_raw( get_post_meta( get_the_ID(), '_news_detail_url', true ) );


$news_cats          = get_the_terms( get_the_ID(), 'news_category' );
$news_terms_classes = ' ';
foreach ( $news_cats as $term ) {
	$news_terms_classes = $news_terms_classes . ' ' . $term->slug;
}
unset( $news_cats );
//var_dump( $news_cats); die();

?>

<article class="cpt-card news-card element-item <?php echo $news_terms_classes; ?>"
         data-category="<?php echo $news_terms_classes; ?>">
    <a class="news-link" href="<?php echo $news_url; ?>" target="_blank">
        <picture class="thumbnail news-img">
			<?php echo get_the_post_thumbnail( null, 'medium' ); ?>
        </picture>
        <div class="cpt-card-content">
            <h2 class="news-title"><?php echo get_the_title(); ?></h2>
            <div class="news-date"><?php echo $news_date->format( 'M d, Y' ) ?></div>
        </div><!-- .card-content -->
    </a>
</article><!-- .card -->