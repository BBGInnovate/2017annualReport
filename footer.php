<?php
/**
 * @package WordPress
 * @subpackage Highend
 */
?>

<footer id="footer">
	<div class="container">
		<div class="page-content">
			<div id="footer-logo">
				<img src="<?php echo content_url(); ?>/uploads/2018/03/BBG-AR_Logo_Footer.png" alt="">
			</div>
			<div class="footer-col">
				<?php wp_nav_menu(array('theme_location' => 'footer-menu')); ?>
			</div>
		</div>
	</div>
</footer>

</div>
<!-- END #main-wrapper -->
<?php // OPENING TAGS FOR #main-wrapper and #hb-wrap ARE LOCATED IN header.php ?>
</div>
<!-- END #hb-wrap -->


<?php global $hasChart; ?>
<?php
if ($hasChart) { 
	global $hasChart, $phpTitle, $phpLabels, $phpData;
?>
	<script>
	var jsonData = '<?php echo json_encode($phpData); ?>';
	var jsonLabels = '<?php echo json_encode($phpLabels); ?>';
	var jsonTitle = '<?php echo json_encode($phpTitle); ?>';
	</script>
<?php
} else {
	$hasChart = false;
}
?>
<script>
	var hasChart = '<?php echo json_encode($hasChart); ?>';
</script>

<?php wp_footer(); ?>
</body>
</html>