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
$description = get_post_meta( get_the_ID(), '_desc', true );


$email      = get_post_meta( get_the_ID(), '_email', true );
$linkedin   = get_post_meta( get_the_ID(), '_linkedin', true );
$facebook   = get_post_meta( get_the_ID(), '_facebook', true );
$twitter    = get_post_meta( get_the_ID(), '_twitter', true );
$googleplus = get_post_meta( get_the_ID(), '_googleplus', true );
$instagram  = get_post_meta( get_the_ID(), '_instagram', true );
$output = '';

$output .= '<ul class="mk-employeee-networks s_meta">';
if ( ! empty( $email ) ) {
	$output .= '<li><a target="_blank" href="mailto:' . antispambot( $email ) . '" title="' . esc_attr__( 'Get In Touch With', 'jupiterx-classic' ) . ' ' . the_title_attribute( array( 'echo' => false ) ) . '">' . '<i class="fa fa-envelope"></i>' . '</a></li>';
}
if ( ! empty( $facebook ) ) {
	$output .= '<li><a target="_blank" href="' . $facebook . '" title="' . the_title_attribute( array( 'echo' => false ) ) . ' ' . esc_attr__( 'On', 'jupiterx-classic' ) . ' Facebook">' . '<i class="fa fa-facebook"></i>' . '</a></li>';
}
if ( ! empty( $twitter ) ) {
	$output .= '<li><a target="_blank" href="' . $twitter . '" title="' . the_title_attribute( array( 'echo' => false ) ) . ' ' . esc_attr__( 'On', 'jupiterx-classic' ) . ' Twitter">' . '<i class="fa fa-twitter"></i>' . '</a></li>';
}
if ( ! empty( $googleplus ) ) {
	$output .= '<li><a target="_blank" href="' . $googleplus . '" title="' . the_title_attribute( array( 'echo' => false ) ) . ' ' . esc_attr__( 'On', 'jupiterx-classic' ) . ' Google Plus">' . '<i class="fa fa-google-plus"></i>' . '</a></li>';
}
if ( ! empty( $linkedin ) ) {
	$output .= '<li><a target="_blank" href="' . $linkedin . '" title="' . the_title_attribute( array( 'echo' => false ) ) . ' ' . esc_attr__( 'On', 'jupiterx-classic' ) . ' Linked In">' . '<i class="fa fa-linkedin"></i>' . '</a></li>';
}
if ( ! empty( $instagram ) ) {
	$output .= '<li><a target="_blank" href="' . $instagram . '" title="' . the_title_attribute( array( 'echo' => false ) ) . ' ' . esc_attr__( 'On', 'jupiterx-classic' ) . ' Instagram">' . '<i class="fa fa-instagram"></i>' . '</a></li>';
}
$output .= '</ul>';


//				var_dump( $is_single);
?>

<article class="card employee-card" itemscope itemtype="http://schema.org/Person">
	<?php
	if ( $is_single ){ ?>
<link itemprop="sameAs" href="<?php echo get_the_permalink(); ?>"/>
	<a href="<?php echo get_the_permalink(); ?>">
		<?php }
		?>
		<picture class="thumbnail">
			<?php echo get_the_post_thumbnail( null, 'employees-large' ); ?>
		</picture>
		<div class="card-content">
			<h2 itemprop="name"><?php echo get_the_title(); ?></h2>

			<?php
			if ( $description ) { ?>
				<div itemprop="knowsAbout"><?php echo $description; ?></div>
			<?php }
//			var_export( $image_attributes );

			?>

			<?php
			if ( $job_title ) { ?>
				<div itemprop="jobTitle"><?php echo $job_title; ?></div>
			<?php } ?>

		</div><!-- .card-content -->
		<?php
		if ( $is_single ){ ?>
	</a>
	<div class="employee-social-links"><?php echo $output; ?></div>
<?php }
?>
</article><!-- .card -->