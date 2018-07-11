<?php
add_shortcode('profile', 'show_profile');
function show_profile($atts) {
	$profile_name = $atts['name'];
	$type = $atts['type'];

	$profile_post = new WP_Query(array(
		'post_type' => 'profile'
	));
	while ($profile_post -> have_posts()) {
		$profile_post -> the_post();
		if (get_the_title() == $profile_name) {
			$image = get_field('profile_snippet_thumbnail');
			if ($type == 'link') {
				$profile_name = '<a href="'. get_the_permalink() . '">' . $atts['name'] . '</a>';
			}
			
			$profile_box  = 	'</div>';
			$profile_box .= '</div>';

			$profile_box .= '<div class="outer-container">';
			$profile_box .= 	'<div class="side-related profile">';
			$profile_box .= 		'<div class="grid-container related-head">';
			$profile_box .= 			'<h5>' . $profile_name . '</h5>';
			$profile_box .= 		'</div>';
			$profile_box .= 		'<div class="main-column-large related-body">';
			$profile_box .= 			'<h6>' . get_field('profile_snippet_title') . '</h6>';
			$profile_box .= 			'<p>' . get_the_excerpt() . '</p>';
			if ($type == 'reveal') {
				$profile_box .= 		'<div class="reveal-content">';
				$profile_box .= 			get_the_content();
				$profile_box .= 		'</div>';
				$profile_box .= 		'<p class="show-more">show more</p>';
			}
			$profile_box .= 		'</div>';
			$profile_box .= 		'<div class="side-column-small">';
			$profile_box .= 			'<img src="' . $image['url'] . '" alt="' . $image['title'] . '">';
			$profile_box .= 		'</div>';
			$profile_box .= 	'</div>';
			$profile_box .= '</div>';

			$profile_box .= '<div class="outer-container">';
			$profile_box .= 	'<div class="left-content-container">';
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
		$related_story  = 	'</div>';
		$related_story .= '</div>';
		$related_story .= '<div class="outer-container">';
		$related_story .= 	'<div class="side-related">';
		$related_story .= 		'<div class="grid-container related-head">';
		$related_story .= 			'<div class="left-content-container">';
		$related_story .= 				get_the_post_thumbnail();
		$related_story .= 			'</div>';
		$related_story .= 		'</div>';
		$related_story .= 		'<div class="grid-container related-body">';
		$related_story .= 			'<h5>' . get_the_title() . '</h5>';
		$related_story .= 			'<p>' . $story_copy . '</p>';
		$related_story .= 		'</div>';
		$related_story .= 	'</div>';
		$related_story .= '</div>';
		// $related_story .= 				get_the_post_thumbnail();
		// $related_story .= 				'<h5>' . get_the_title() . '</h5>';
		// $related_story .= 				'<h6>' . get_the_date() . '</h6>';
		// $related_story .= 				'<p>' . $story_copy . '</p>';
		
		$related_story .= '<div class="outer-container">';
		$related_story .= 	'<div class="left-content-container">';
		return $related_story;
	}
}

add_shortcode('video_bg', 'display_background_video');
function display_background_video($atts) {
	$name = $atts['name'];
	$poster = $atts['poster'];
	$video_src = $atts['src'];
	if (!empty($atts['top'])) {
		$position = $atts['top'];
	} else {
		$position = "";
	}

	$bg_video  = 	'</div>';
	$bg_video .= '</div>';
	// CLOSE CONTAINER SO VIDEO EXPANDS FULL WIDTH
	$bg_video .= '<div class="' . $name . ' ' . $position .' video-wrapper coverImgBg"';
	$bg_video .= 	'style="background: url(' . $poster . '); background-size: cover;">';
	$bg_video .= 	'<video class="video-tag" autoplay loop>';
	$bg_video .= 		'<source src="' . $video_src . '" type="video/mp4">';
	$bg_video .= 	'</video>';
	$bg_video .= '</div>';
	$bg_video .= '<div class="video-overlay"></div>';
	// REOPEN CONTAINER
	$bg_video .= '<div class="outer-container">';
	$bg_video .= 	'<div class="left-content-container">';
	return $bg_video;
}

add_shortcode('move_video', 'move_video_up');
function move_video_up($atts) {
	$name = $atts['name'];
	$video_pusher  = 	'</div>';
	$video_pusher .= '</div>';
	$video_pusher .= '<div class="move-video ' . $name . '"></div>';
	$video_pusher .= '<div class="outer-container">';
	$video_pusher .= 	'<div class="left-content-container">';
	return $video_pusher;
}

add_shortcode('next_page', 'cta_next_page');
function cta_next_page($atts) {
	$cta_link  = '<a href="index.php/';
	$cta_link .= $atts['slug'];
	$cta_link .= '"><h4>Contintue</h4></a>';
	return $cta_link;
}
?>