<?php
/**
 * @package WordPress
 * @subpackage Highend
 */

?>
<?php
if( is_singular ( 'clients' ) ||
 	is_singular ( 'hb_pricing_table' ) ) {
	wp_redirect(home_url()); exit;
} 
get_header();

display_logo_home_button();
?>
<!-- BEGIN #main-content -->
<div id="main-content">
	<div class="container">

	<?php 
		$sidebar_layout = vp_metabox('layout_settings.hb_page_layout_sidebar'); 
		$sidebar_name = vp_metabox('layout_settings.hb_choose_sidebar');

		if ( $sidebar_layout == "default" || $sidebar_layout == "" ) {
			$sidebar_layout = hb_options('hb_page_layout_sidebar'); 
			$sidebar_name = hb_options('hb_choose_sidebar');
		}

		$pagination_style = vp_metabox('page_settings.hb_pagination_settings.0.hb_pagination_style');
		$blog_grid_column_class = vp_metabox('page_settings.hb_blog_grid_settings.0.hb_grid_columns');
	?>

	<div class="row <?php echo $sidebar_layout; ?> main-row">
	
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
		<!-- BEGIN .hb-main-content -->
		<?php if ( $sidebar_layout != "fullwidth") { ?>
			<div class="col-9 hb-equal-col-height hb-main-content">
		<?php } else { ?>
			<div class="col-12 hb-main-content">
		<?php } ?>
			<!-- BEGIN #single-blog-wrapper -->
			<div class="single-blog-wrapper clearfix">
				<!-- BEGIN .hentry -->
				<article id="post-<?php the_ID(); ?>" <?php post_class( get_post_format() . '-post-format single' ); ?> itemscope itemType="http://schema.org/BlogPosting">
					<!-- BEGIN .single-post-content -->
					<div class="single-post-content">
	
						<?php if (! is_attachment() ) { ?>	
						<!-- BEGIN .post-header -->
						<div class="post-header">
							<h2 class="title entry-title" itemprop="headline"><?php the_title(); ?></h2>
							
							<?php 
							if ( hb_options('hb_blog_enable_featured_image') && vp_metabox('general_settings.hb_hide_featured_image') == 0 )
								get_template_part('includes/single' , 'featured-format' ) ; 
							?>
						</div>
						<!-- END .post-header -->
						<?php } ?>
						
						<?php if ( !has_post_format('quote') && !has_post_format('link') && !has_post_format('status') ) {?>
						<!-- BEGIN .entry-content -->
						<div class="entry-content clearfix" itemprop="articleBody">
							<?php the_content(); ?>
							<div class="page-links"><?php wp_link_pages(array('next_or_number'=>'next', 'previouspagelink' => ' <i class="icon-angle-left"></i> ', 'nextpagelink'=>' <i class="icon-angle-right"></i>')); ?></div>
						</div>
						<!-- END .entry-content -->
						<?php } ?>

						<?php 
							if ( hb_options('hb_blog_enable_tags' ) )
								the_tags('<div class="single-post-tags"><span>Tags: </span>','','</div>'); 
						?>

					</div>
					<!-- END .single-post-content -->
				</article>

				<?php
					if (! is_attachment() ) {
						echo '<section class="bottom-meta-section clearfix">';
						if ( comments_open() && hb_options('hb_blog_enable_comments') ) {
							echo '<div class="float-left comments-holder">';
							echo 	'<a href="';
							echo 		get_the_permalink();
							echo 		'#comments" class="comments-link scroll-to-comments" title="';
							echo 		_e('View comments on ', 'hbthemes'); get_the_title(); 
							echo 	'">';
							echo 		comments_number( __( '0 Comments' , 'hbthemes' ) , __( '1 Comment' , 'hbthemes' ), __( '% Comments' , 'hbthemes' ) );
							echo 	'</a>';
							echo '</div>';
						}

						if ( hb_options('hb_blog_enable_likes') ) {
							echo '<div class="float-right">';
							echo 	hb_print_likes(get_the_ID());
							echo '</div>';
						}

						if ( hb_options('hb_blog_enable_share') ) {
							echo '<div class="float-right">';
							echo 	get_template_part ( 'includes/hb' , 'share' );
							echo '</div>';
						}
						echo '</section>';
					}

					if ( hb_options('hb_blog_author_info') && is_singular('post')) {
						get_template_part('includes/post','author-info'); 
					}

					if ( hb_options('hb_blog_enable_related_posts') ) {
						get_template_part('includes/post','related-articles'); 
					}
				?>

			</div>
			<!-- END #single-blog-wrapper -->
			<?php if (! is_attachment() ) {
				if ( comments_open() ) comments_template();
			} ?>

		</div>
		<!-- END .hb-main-content -->
		<?php if ( $sidebar_layout != "fullwidth" ){ ?>
			<!-- BEGIN .hb-sidebar -->
			<div class="col-3  hb-equal-col-height hb-sidebar">
			<?php 		
				if ( $sidebar_name && function_exists('dynamic_sidebar') )
					dynamic_sidebar($sidebar_name);
			?>
			</div>
			<!-- END .hb-sidebar -->
		<?php } ?>


		<?php endwhile; endif; ?>	

	</div>
		
	</div>
</div>
<!-- END #main-content -->
<?php get_footer(); ?>