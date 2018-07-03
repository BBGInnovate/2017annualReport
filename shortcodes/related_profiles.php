<?php
function show_profile($atts) {
	$profile_name = $atts['name'];

	$profile_post = new WP_Query(array(
		// 'posts_per_page' => 1,
		'post_type' => 'profile'
	));
	while ($profile_post -> have_posts()) {
		$profile_post -> the_post();
		if (get_the_title() == $profile_name) {
			$image = get_field('profile_snippet_thumbnail');
			
			$profile_box  = '</div>';
			$profile_box .= '<div class="related-wrapper">';
			$profile_box .= 	'<div class="related-container profile">';
			$profile_box .= 		'<div class="related-head">';
			$profile_box .= 			'<div>';
			$profile_box .= 				'<h5>';
			$profile_box .= $profile_name;
			$profile_box .= 				'</h5>';
			$profile_box .= 			'</div>';
			$profile_box .= 		'</div>';
			$profile_box .= 		'<div class="related-body">';
			$profile_box .= 			'<div class="related-text">';
			$profile_box .= 				'<h6>';
			$profile_box .= get_field('profile_snippet_title');
			$profile_box .= 				'</h6>';
			$profile_box .= 				'<p>';
			$profile_box .= get_the_excerpt();
			$profile_box .= 				'</p>';
			$profile_box .= 			'</div>';
			$profile_box .= 			'<div class="related-image">';
			$profile_box .= 				'<img src="';
			$profile_box .= $image['url'];
			$profile_box .= 					'" alt="';
			$profile_box .= $image['title'];
			$profile_box .= 				'">';
			$profile_box .= 			'</div>';
			$profile_box .= 		'</div>';
			$profile_box .= 	'</div>';
			$profile_box .= '</div>';
			$profile_box .= '<div class="grid-contents">';
			return $profile_box;
		}
	}
}
add_shortcode('profile', 'show_profile');

?>