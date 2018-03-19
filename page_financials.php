<?php
/**
 * @package WordPress
 * @subpackage Highend
 * Template name: Financials Page
 */
?>
<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<!-- BEGIN #main-content -->
<div id="main-content">
	<div class="container">
		<div class="page-content">
			<div id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="usa-section financials-group">
					<h2><?php the_title(); ?></h2>
					<div id="financials-copy">
						<?php the_content();?>
					</div>
					<div id="financials-chart">
					<?php
						$hasChart = false;
						$displayCharts = new WP_Query(array(
							'post_type' => 'chart',
							'category_name' => 'Financials'
						));
						if ($displayCharts->have_posts()) {
							$hasChart = true;
							while ($displayCharts->have_posts()) {
								$displayCharts->the_post();
								echo '<canvas id="chart_test"></canvas>';
								$phpTitle = get_the_title();
								$phpLabels = get_field('chart_labels');
								$phpData = get_field('chart_data');
							}
						}
					?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php endwhile; endif;?>
<?php get_footer(); ?>