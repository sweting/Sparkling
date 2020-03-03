<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package sparkling
 */

 get_header(); ?>

<div class="container main-content-area">
			<?php $layout_class = get_layout_class(); ?>
			<div class="row <?php echo $layout_class; ?>">
				<div class="main-content-inner <?php echo sparkling_main_content_bootstrap_classes(); ?>">

	 <div id="primary" class="content-area">
		 <main id="main" class="site-main" role="main">

			<?php
			if ( have_posts() ) :
			?>

				<header class="page-header archive-title">
					<?php
					 the_archive_title( '<h1 class="page-title">', '</h1>' );
					 the_archive_description( '<div class="archive-description">', '</div>' );
					?>
				</header><!-- .page-header -->

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					* Include the Post-Format-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Format name) and that will be used instead.
					*/
					get_template_part( 'template-parts/content', get_post_format() );

				endwhile;

				the_posts_pagination(
					array(
						'prev_text' => '<i class="fa fa-chevron-left"></i> ' . __( 'Neuere', 'sparkling' ),
						'next_text' => __( 'Ältere', 'sparkling' ) . ' <i class="fa fa-chevron-right"></i>',
					)
				);

		 else :

				get_template_part( 'template-parts/content', 'none' );

		 endif;
			?>

		 </main><!-- #main -->
	 </div><!-- #primary -->

	<?php
	get_sidebar();
	get_footer();
