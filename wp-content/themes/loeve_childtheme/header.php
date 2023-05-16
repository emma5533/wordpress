<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
	<link rel="preconnect" href="https://fonts.googleapis.com"> 
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
	/*STYLING AF HEADER*/
	/*navigation placeres i kolonne, og styles*/
	.main-navigation .main-menu {
  display: flex;
  gap: 0.4rem;
  margin: 0;
  padding: 0;
  flex-direction: column;
  font-family: "Outfit", sans-serif;
  	font-weight: light;
	font-size: 0.7rem;
}
#menu-navigation li a{
	color: black !important;
}
#menu-navigation li a:hover{
	color: orange !important;
}


/*placering af headerens elementer i grid*/
.site-branding {
	display: grid;
	grid-template-columns: 20px repeat(3, 1fr) 20px;
}
.site-logo{
	grid-column: 2/5;
	grid-row: 1/2;
	display: flex;
	justify-content: center;
}
.main-navigation{
	grid-column: 2/3;	
	grid-row: 2/3;
}


/*media query????*/
@media(min-width:700px){
	.site-logo{
		display: flex;
		justify-content: center;
	}
}

</style>

</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content">
		<?php
		/* translators: Hidden accessibility text. */
		_e( 'Skip to content', 'twentynineteen' );
		?>
	</a>

		<header id="masthead" class="<?php echo is_singular() && twentynineteen_can_show_post_thumbnail() ? 'site-header featured-image' : 'site-header'; ?>">

			<div class="site-branding-container">
				<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>
			</div><!-- .site-branding-container -->

			<?php if ( is_singular() && twentynineteen_can_show_post_thumbnail() ) : ?>
				<div class="site-featured-image">
					<?php
						twentynineteen_post_thumbnail();
						the_post();
						$discussion = ! is_page() && twentynineteen_can_show_post_thumbnail() ? twentynineteen_get_discussion_data() : null;

						$classes = 'entry-header';
					if ( ! empty( $discussion ) && absint( $discussion->responses ) > 0 ) {
						$classes = 'entry-header has-discussion';
					}
					?>
					<div class="<?php echo $classes; ?>">
						<?php get_template_part( 'template-parts/header/entry', 'header' ); ?>
					</div><!-- .entry-header -->
					<?php rewind_posts(); ?>
				</div>
			<?php endif; ?>
		
		</header><!-- #masthead -->

	<div id="content" class="site-content">
