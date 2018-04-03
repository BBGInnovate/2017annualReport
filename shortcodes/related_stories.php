<?php
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
		$related_story .= 				'<h3>';
		$related_story .= 					get_the_title();
		$related_story .= 				'</h3>';
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
add_shortcode('related-story', 'show_related_story');

?>