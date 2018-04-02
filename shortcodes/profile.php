<?php
function show_profile($atts) {
	$profile_name = $atts['name'];

	$profile_post = new WP_Query(array(
		'posts_per_page' => 1,
		'title' => $profile_name,
	));
	while ($profile_post -> have_posts()) {
		$profile_post -> the_post();
		$image = get_field('profile_photo');
		
		$profile_box  = '</div>';
		$profile_box .= '<div class="profile-grid-wrap" id="';
		$profile_box .= $profile_id;
		$profile_box .= '">';
		$profile_box .= 	'<div class="profile-container">';
		$profile_box .= 		'<div class="profile-head">';
		$profile_box .= 			'<div>';
		$profile_box .= 				'<h5>';
		$profile_box .= $profile_name;
		$profile_box .= 				'</h5>';
		$profile_box .= 			'</div>';
		$profile_box .= 		'</div>';
		$profile_box .= 		'<div class="profile-body">';
		$profile_box .= 			'<div class="profile-text">';
		$profile_box .= 				'<h6>';
		$profile_box .= get_field('occupation');
		$profile_box .= 				'</h6>';
		$profile_box .= 				'<p>';
		$profile_box .= get_the_excerpt();
		$profile_box .= 				'</p>';
		$profile_box .= 			'</div>';
		$profile_box .= 			'<div class="profile-image">';
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
add_shortcode('profile', 'show_profile');

?>