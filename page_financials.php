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
						$has_chart = false;
						$display_charts = new WP_Query(array(
							'post_type' => 'chart',
							'category_name' => 'Financials'
						));
						if ($display_charts -> have_posts()) {
							$has_chart = true;
							$chart_set = array();
							while ($display_charts -> have_posts()) {
								$display_charts -> the_post();
								$chart_data = array(
									'php_title' => get_the_title(),
									'php_type' => get_field('chart_type'),
									'php_labels' => get_field('chart_labels'),
									'php_data' => get_field('chart_data')
								);
								array_push($chart_set, $chart_data);
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

<?php if ($has_chart) { ?>
<script>
	var hasChart = '<?php echo json_encode($has_chart); ?>';
</script>
<?php foreach ($chart_set as $chart_data) { ?>
	<script>
		// var jsonTitle = '<?php //echo $chart_data['php_title']; ?>';
		// var jsonType = '<?php //echo $chart_data['php_type']; ?>';
		// var jsonLabels = '<?php //echo $chart_data['php_labels']; ?>';
		// var jsonData = '<?php //echo $chart_data['php_data']; ?>';
		// console.log('test jQ: ' + jsonTitle);
		// displayChart(hasChart, jsonTitle, jsonType, jsonLabels, jsonData);
	</script>
<?php
	}
} else {
	$has_chart = false;
}
?>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/charts.js"></script>

<?php get_footer(); ?>