<?php
/* *
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package sparkling
 */

if ( isset( $_SERVER['HTTP_USER_AGENT'] ) && ( strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE' ) !== false ) ) {
	header( 'X-UA-Compatible: IE=edge,chrome=1' );
} ?>
<!doctype html>
<!--[if !IE]>
<html class="no-js non-ie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>
<html class="no-js ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>
<html class="no-js ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>
<html class="no-js ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="<?php echo of_get_option( 'nav_bg_color' ); ?>">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<a class="sr-only sr-only-focusable" href="#content">Skip to main content</a>
<div id="page" class="hfeed site">

	<header id="masthead" class="site-header" role="banner">
		<nav class="navbar navbar-default 
		<?php
		if ( of_get_option( 'sticky_header' ) ) {
			echo 'navbar-fixed-top';}
?>
" role="navigation">
			<div class="container">
				<div class="row">
					<div class="site-navigation-inner col-sm-12">
						<div class="navbar-header">
							<button type="button" class="btn navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>

														<div id="logo" style="width: 80%;">
															<?php if ( get_header_image() != '' ) { ?>
																	<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>"  height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
																		<?php if ( is_home() ) { ?>
																		<h1 class="site-name hide-site-name"><a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
																	<?php
}
} else {
	echo is_home() ? '<h1 class="site-name">' : '<p class="site-name">';
	?>
																		<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
																<?php echo is_home() ? '</h1>' : '</p>'; ?>
															<?php } ?>
														</div><!-- end of #logo -->
						</div>
						<?php sparkling_header_menu(); // main navigation ?>
					</div>
				</div>
			</div>
		</nav><!-- .site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">

		<div class="top-section container">
			<?php
			if ( is_front_page() && of_get_option( 'sparkling_slider_checkbox' ) == 1 ) :
			?>
			<div class="row">
				<div class="col-md-8 mobile-no-padding">
					<?php sparkling_featured_slider(); ?>
				</div>
				<div class="col-md-4">
					<div style="margin 5px; background: #fff; height: 360px;">
					<h2>Aktuelles</h2>
					<?php
						$query = new WP_Query(
							array(
								'posts_per_page' => 3
							)
						);
						if ( $query->have_posts() ) :
							while ( $query->have_posts() ) :
								$query->the_post();
							
								$feat_image_url = get_template_directory_uri().'/assets/logo.jpg';
								if ( ( function_exists( 'has_post_thumbnail' ) ) && ( has_post_thumbnail() ) ) {
									$feat_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' )[0];
								}
								?>
									<div style="padding-top: 5px; padding-bottom: 5px;">
										<div class="newsImage" style="display: table-cell; width: 100px;">
											<?php echo '<img style="max-height: 93px; width: auto;" src="' . $feat_image_url. '">'; ?>
										</div>
										<div class="newsTitle" style="display: table-cell; vertical-align: middle; padding-left: 5px; padding-right: 20px;">
											<?php echo '<a href="'.get_permalink().'">'.get_the_title().'</a>'; ?>
										</div>
									</div>
								<?php
								//echo '<p><img style="width: 75px;" src="' . $feat_image_url[0] . '"><a href="'.get_permalink().'">'.get_the_title().'</a></p>';
								
							endwhile;
						endif;
						wp_reset_postdata();
					?>
					</div>
				</div>
			</div>
			<?php
			endif;
			?>
			<?php sparkling_call_for_action(); ?>
		</div>

		<div class="container main-content-area">
			<?php $layout_class = get_layout_class(); ?>
			<div class="row <?php echo $layout_class; ?>">
				<div class="main-content-inner <?php echo sparkling_main_content_bootstrap_classes(); ?>">
