<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

wp_enqueue_style( 'sweting-frontpage', get_template_directory_uri() . '/assets/css/front-page.css' );
get_header(); ?>

	<div class="top-section container">
		<?php
		if ( is_front_page() && of_get_option( 'sparkling_slider_checkbox' ) == 1 ) :
		?>
		<div class="row">
			<div class="col-md-8 mobile-no-padding tablet-no-padding">
				<?php sparkling_featured_slider(); ?>
			</div>
			<div class="col-md-4 mobile-no-padding tablet-no-padding">
				<div class="news-container">
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
								<div class="newsRow" onclick="location.href= '<?php echo get_permalink();?>';">
									<div class="newsImage" style="background-image: url('<?php echo $feat_image_url; ?>');">
										<?php //echo '<a href="'.get_permalink().'"><img src="' . $feat_image_url. '"></a>'; ?>
									</div>
									<div class="newsTitle">
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
		<?php //sparkling_call_for_action(); ?>
		<div class="container" style="margin-top: 20px;">
			<div class="row">
				<?php 
					for ($panelIndex = 1; $panelIndex < 5; $panelIndex++) :
				?>
				<div class="col-sm-3 mobile-no-padding tablet-no-padding">
					<a href="<?php echo get_permalink(of_get_option( 'sparkling_little_panel'.$panelIndex.'_link', '' )); ?>">
					<?php 
					$imgUrl = get_template_directory_uri() . '/demo/demo_wichtel.jpg';
						if(of_get_option('sparkling_little_panel'.$panelIndex.'_image') != 0)
							$imgUrl = wp_get_attachment_image_src(of_get_option('sparkling_little_panel'.$panelIndex.'_image'), 'full')[0];
					?>
					<div class="action-panel" style="background-image: url('<?php echo $imgUrl;?>')">
						<div class="action-panel-content">
							<?php echo of_get_option('sparkling_little_panel'.$panelIndex.'_title');?>
						</div>
					</div>
					</a>
				</div>
				<?php
					endfor;
				?>
		</div>
	</div>

	<div class="container main-content-area">
			<div class="no-sidebar">
				<div class="main-content-inner">
	<div class="start-page-content">
		<style>
			.sp-container-heading h2{
				cursor: pointer;
			}

			.sp-container-heading .allgemein-excerpt {
				display: none;
			}
		</style>
		<?php
		$query = new WP_Query(
			array(
				'post_type'		 => 'allgemein',
				'posts_per_page' => 3,
				'meta_query'     => array(
					array(
						'key'     => '_thumbnail_id',
						'compare' => 'EXISTS',
				),
			),
			)
		);

		while ( $query->have_posts() ) :
			$query->the_post();
		
			//$feat_image_url = get_template_directory_uri().'/assets/logo.jpg';
			$feat_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), array('1170','350') )[0];
			
		?>
		
		<div class="sp-container-default" >
			<img src="<?php echo $feat_image_url;?>">
			<div class="sp-container-heading">
				<h2 class="allgemein-heading"><?php echo get_the_title(); ?></h2>
				<div class="allgemein-excerpt">
				<?php echo get_the_excerpt(); ?>
				</div>
			</div>
		</div>

		
		<?php
		endwhile;
		?>
		<script>
			jQuery(".allgemein-heading").click(function () {
				jQuery(this).parent().children(".allgemein-excerpt").slideToggle();
			});
		</script>
	</div>

<?php
//get_sidebar();
get_footer();
