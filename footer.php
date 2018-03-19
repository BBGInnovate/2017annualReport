<?php
/**
 * @package WordPress
 * @subpackage Highend
 */
?>

<!-- BEGIN #footer OPTION light-style -->
<footer id="footer">
	<div class="container">
		<div class="page-content">
			<div id="footer-logo">
				<img src="<?php echo content_url(); ?>/uploads/2018/03/BBG-AR_Logo_Footer.png" alt="">
			</div>
			<div class="footer-col">
				<ul>
					<li>Countering Disinformation</li>
					<li>Lorem Ipsum</li>
					<li>Dolor Sit Amet</li>
					<li>Consectetur Adipiscing Elit</li>
					<li>Eed do Eiusmod Tempor</li>
				</ul>
			</div>
			<div class="footer-col">
				<ul>
					<li>Countering Disinformation</li>
					<li>Lorem Ipsum</li>
					<li>Dolor Sit Amet</li>
					<li>Consectetur Adipiscing Elit</li>
					<li>Eed do Eiusmod Tempor</li>
				</ul></div>
			<div class="footer-col">
				<ul>
					<li>Countering Disinformation</li>
					<li>Lorem Ipsum</li>
					<li>Dolor Sit Amet</li>
					<li>Consectetur Adipiscing Elit</li>
					<li>Eed do Eiusmod Tempor</li>
				</ul>
			</div>
		</div>
	</div>
</footer>
<!-- END #footer -->
<?php global $hasChart; ?>
<script>
	var hasChart = '<?php echo json_encode($hasChart); ?>';
</script>
<?php
if ($hasChart) { 
	global $hasChart, $phpTitle, $phpLabels, $phpData;
?>
	<script>
	var jsonData = '<?php echo json_encode($phpData); ?>';
	var jsonLabels = '<?php echo json_encode($phpLabels); ?>';
	var jsonTitle = '<?php echo json_encode($phpTitle); ?>';
	</script>
<?php } ?>

<?php wp_footer(); ?>
</body>
<!-- END body -->

</html>
<!-- END html -->