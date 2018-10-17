<?php
/**
 * @package WordPress
 * @subpackage Highend
 * Template name: Network Page
 */

require 'includes/shortcodes.php';

if( is_singular ( 'clients' ) ||
 	is_singular ( 'hb_pricing_table' ) ) {
	wp_redirect(home_url()); exit;
} 

get_header();
// display_logo_home_button();
?>


<div class="container">
<?php
$stored_post_class = get_post_class( get_post_format() . '-post-format single' );
$stored_post_class = implode($stored_post_class, " ");
?>
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
	<?php
		if ( have_posts() ) : while ( have_posts() ) : the_post();
			remove_filter('the_content', 'wpautop');
	?>

		<div class="col-12 hb-main-content">
			<div class="single-blog-wrapper clearfix">
				<article class="<?php echo $stored_post_class; ?>">
					<?php 
					if ( hb_options('hb_blog_enable_featured_image') && vp_metabox('general_settings.hb_hide_featured_image') == 0 )
						$page_content = get_the_content();

						// IF THE SHORTCODE FOR THE FULL WIDTH FEATURE IMAGE IS USED 
						// DO NOT SHOW THE FEATURED IMAGE IN THE DEFAULT WAY
						$feat_img_pos = strpos($page_content, '[full_width_featured_image]');
						if (!is_numeric($feat_img_pos)) {
							get_template_part('includes/single' , 'featured-format');
						}
					?>
					<div class="single-post-content">
						<?php if (! is_attachment() ) { ?>	
						<div class="row">	
							<div class="post-header">
								<h2 class="title entry-title" itemprop="headline"><?php the_title(); ?></h2>
							</div>
						</div>
						<?php } ?>
						
						<?php if ( !has_post_format('quote') && !has_post_format('link') && !has_post_format('status') ) {?>
						<div class="entry-content clearfix" itemprop="articleBody">
							<?php the_content(); ?>
							<div class="page-links"><?php wp_link_pages(array('next_or_number'=>'next', 'previouspagelink' => ' <i class="icon-angle-left"></i> ', 'nextpagelink'=>' <i class="icon-angle-right"></i>')); ?></div>
						</div>
						<?php } ?>

						<?php 
							if ( hb_options('hb_blog_enable_tags' ) )
								the_tags('<div class="single-post-tags"><span>Tags: </span>','','</div>'); 
						?>
					</div>
				</article>

				<?php
					if ( hb_options('hb_blog_author_info') && is_singular('post')) {
						get_template_part('includes/post','author-info'); 
					}
					if ( hb_options('hb_blog_enable_related_posts') ) {
						get_template_part('includes/post','related-articles'); 
					}
				?>
			</div>
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
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/videoBG.js"></script>
<?php get_footer(); ?>