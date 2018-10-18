<?php
function full_width_essential_grid() {
	$full_width_ess_grid = get_field('essential_grid_shortcode');
	if (!empty($full_width_ess_grid)) {
		$full_width_ess_grid = do_shortcode($full_width_ess_grid);
		return $full_width_ess_grid;
	}
}
?>