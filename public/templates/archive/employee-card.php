<?php
// exit if file is called directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$thumb_id = get_post_thumbnail_id();

//$img_src = wp_get_attachment_image_src( $thumb_id ,'employees-large');

$is_single = get_post_meta( get_the_ID(), '_single_post', true );
$is_single = ( $is_single == 'true' ) ? true : false;

$job_title   = get_post_meta( get_the_ID(), '_position', true );
$description_text = get_post_meta( get_the_ID(), '_desc', true );

$show_description = isset($description) && ($description == 'false') ? false : true;

$email      = get_post_meta( get_the_ID(), '_email', true );
$linkedin   = get_post_meta( get_the_ID(), '_linkedin', true );
$facebook   = get_post_meta( get_the_ID(), '_facebook', true );
$twitter    = get_post_meta( get_the_ID(), '_twitter', true );
$googleplus = get_post_meta( get_the_ID(), '_googleplus', true );
$instagram  = get_post_meta( get_the_ID(), '_instagram', true );
$output =  Jupiterx_Classic_Global::mk_employees_meta_information( get_the_ID());


//				var_dump( $is_single);
?>

<article class="cpt-card employee-card" itemscope itemtype="http://schema.org/Person">
	<?php

	if ( $is_single ){ ?>
<link itemprop="sameAs" href="<?php echo get_the_permalink(); ?>"/>
	<a href="<?php echo get_the_permalink(); ?>">
		<?php }
		?>
		<picture class="thumbnail">
			<?php echo get_the_post_thumbnail( null, 'employees-large' ); ?>
		</picture>
		<div class="cpt-card-content">
			<h2 itemprop="name"><?php echo get_the_title(); ?></h2>
			<?php
			if ( $job_title ) { ?>
                <div itemprop="jobTitle"><?php echo $job_title; ?></div>
			<?php } ?>

			<?php
			if ( $show_description ) { ?>
				<div itemprop="knowsAbout"><?php echo $description_text; ?></div>
			<?php }
//			var_export( $image_attributes );

			?>



		</div><!-- .card-content -->
		<?php
		if ( $is_single ){ ?>
	</a>
	<div class="employee-social-links"><?php echo $output; ?></div>
<?php }
?>
</article><!-- .card -->