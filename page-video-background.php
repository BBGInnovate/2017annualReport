<?php
/**
 * @package WordPress
 * @subpackage Highend
 * Template name: Thematic Page
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
		if (have_posts()) : 
			while (have_posts()) : 
				the_post();
				remove_filter('the_content', 'wpautop');
	?>

		<div class="col-12 hb-main-content">
			<div class="single-blog-wrapper clearfix">
				<?php 
				if ( hb_options('hb_blog_enable_featured_image') && vp_metabox('general_settings.hb_hide_featured_image') == 0 )
					$page_content = get_the_content();
					$page_content = do_shortcode($page_content);

					// DONT SHOW FEATURE IMAGE IN FULL WIDTH FEATURE IMAGE SHORTCODE IS USED
					$feat_img_pos = strpos($page_content, '[full_width_featured_image]');
					if (!is_numeric($feat_img_pos)) {
						get_template_part('includes/single' , 'featured-format');
					}
				?>
				<div class="single-post-content">
					<?php
						if (!is_attachment()) {
							echo '<h2 class="title entry-title" itemprop="headline">' . get_the_title() . ' </h2>';
						}

						if (!has_post_format('quote') && !has_post_format('link') && !has_post_format('status')) {
							echo '<div class="entry-content clearfix" itemprop="articleBody">';
							echo '<div class="col-7">';
							echo 	$page_content;
							echo '</div>';
							echo 	'<div class="page-links">';
							wp_link_pages(array('next_or_number'=>'next', 'previouspagelink' => ' <i class="icon-angle-left"></i> ', 'nextpagelink'=>' <i class="icon-angle-right"></i>'));
							echo 	'</div>';
							echo '</div>';
						}
 
						if ( hb_options('hb_blog_enable_tags' ) )
							the_tags('<div class="single-post-tags"><span>Tags: </span>','','</div>'); 
					?>
				</div>

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
<?php
	endwhile;
endif;
?>
	</div><!-- END .row -->
</div><!-- END .container -->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/videoBG.js"></script>
<?php get_footer(); ?>