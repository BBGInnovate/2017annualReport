<?php
/**
 * @package WordPress
 * @subpackage Highend
 * Template name: Main Page
 */
?>
<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<!-- BEGIN #main-content -->
<?php

// GATHER POSTS SPECIFIC TO PAGE
$cat_posts = '';
function dispayCategoryPosts($cat_name) {
	$cat_posts_arr = array(
		'post_type'      => 'post',
		'category_name'  => $cat_name,
		'posts_per_page' => 3
	);
	return $cat_posts_arr;
}

if (is_page('disinformation')) {
	putRevSlider("homepage-slider-1");
	$cat_posts = dispayCategoryPosts('disinformation');
}
if (is_page('audiences')) {
	putRevSlider("audience");
	$cat_posts = dispayCategoryPosts('audience');
}
if (is_page('access')) {
	putRevSlider("access");
	$cat_posts = dispayCategoryPosts('access');
}
if (is_page('capacity')) {
	putRevSlider("capacity");
	$cat_posts = dispayCategoryPosts('capacity');
}
?>
<div id="main-content">
	<div class="container">
		<div class="page-content">
			<div id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="content-group usa-section">
					<?php
						if (get_field('page_header')) {
							$header  =  '<h2>';
							$header .= get_field('page_header');
							$header .= '</h2>';
							echo $header;
						}
					?>
					<?php the_content();?>
				</div>

<?php $side_posts = new WP_Query($cat_posts); ?>
				<div class="post-categories usa-section">
<?php
while ($side_posts -> have_posts()) {
	$side_posts -> the_post();
	$shortContent = wp_trim_words(get_the_content(), 12);
?>
						<div class="side-cat">
							<div class="aside-image">
								<?php the_post_thumbnail('thumbnail'); ?>
							</div>
							<div class="aside-text">
								<h3 class="post-cat-title"><?php the_title(); ?></h3>
								<p class="post-cat-p"><?php echo get_the_content(); ?></p>
							</div>
						</div>
<?php } ?>
				</div>
			</div>
			<?php
			if (is_page('disinformation')) {
				echo '<canvas id="chart_test"></canvas>';
			}
			?>
		</div>
	</div>
</div>

<?php endwhile; endif;?>
<?php get_footer(); ?>