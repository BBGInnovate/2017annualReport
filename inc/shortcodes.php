<?php
add_shortcode('profile', 'show_profile');
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

add_shortcode('related-story', 'show_related_story');
function show_related_story($atts) {
	$related_story_title = $atts['title'];

	$related_story = new WP_Query(array(
		'posts_per_page' => 1,
		// $profile_name MUST BE THE TILE OF THE POST
		'title' => $related_story_title
	));
	while ($related_story -> have_posts()) {
		$related_story -> the_post();
		$story_copy = wp_trim_words(get_the_excerpt(), 25);

		$related_story  = '</div>';

		$related_story .= '<div class="related-wrapper">';
		$related_story .= 	'<div class="related-container story">';
		$related_story .= 		'<div class="related-head">';
		$related_story .= 			'<div class="related-image">';
		$related_story .= 				get_the_post_thumbnail();
		$related_story .= 			'</div>';
		$related_story .= 		'</div>';
		$related_story .= 		'<div class="related-body">';
		$related_story .= 			'<div class="related-text">';
		$related_story .= 				'<h5>';
		$related_story .= 					get_the_title();
		$related_story .= 				'</h5>';
		$related_story .= 				'<h6>';
		$related_story .= 					get_the_date();
		$related_story .= 				'</h6>';
		$related_story .= 				'<p>';
		$related_story .= 					$story_copy;
		$related_story .= 				'</p>';
		$related_story .= 			'</div>';
		$related_story .= 		'</div>';
		$related_story .= 	'</div>';
		$related_story .= '</div>';

		$related_story .= '<div class="grid-contents">';
		return $related_story;
	}
}

add_shortcode('video-bg', 'display_background_video');
function display_background_video($atts) {
	$video_src = $atts['src'];

	$bg_video  = '<div class="video-wrapper coverImgBg">';
	$bg_video .= 	'<video class="video-tag" autoplay loop>';
	$bg_video .= 		'<source src="';
	$bg_video .= 			$video_src;
	$bg_video .= 		'" type="video/mp4">';
	$bg_video .= 	'</video>';
	$bg_video .= '</div>';
	return $bg_video;
}
?>