<?php
function exit_hb_structure() {
	return '</div></div></article></div></div></div></div>';
}
function reopen_hb_structure() {
	global $stored_post_class;
	return '<div class="container"><div class="row main-row"><div class="col-7 hb-main-content"><div class="single-blog-wrapper clearfix"><article class="' . $stored_post_class . '"><div class="single-post-content"><div class="entry-content clearfix" itemprop="articleBody">';
}

add_shortcode('related_profile', 'show_related_profile');
function show_related_profile($atts) {
	$profile_name = $atts['name'];
	$type = $atts['type'];
	$profile_box = '';

	$profile_query = new WP_Query(array(
		'post_type' => 'profile',
		'title' => $profile_name,
		'posts_per_page' => 1
	));
	if ($profile_query->have_posts()) {
		while ($profile_query->have_posts()) {
			$profile_query->the_post();
			$image = get_field('profile_snippet_thumbnail');
			
			$profile_box  = exit_hb_structure();
			$profile_box .= '<div class="outer-container related-content">';
			$profile_box .= 	'<div class="side-related profile">';
			$profile_box .= 		'<div class="inner-container">';
			$profile_box .= 			'<div class="grid-container related-head">';
			$profile_box .= 				'<h6>' . $profile_name . '</h6>';
			$profile_box .= 			'</div>';
			$profile_box .= 			'<div class="main-column-large related-body">';
			$profile_box .= 				'<h5>' . get_field('profile_snippet_title') . '</h5>';
			$profile_box .= 				'<p class="aside">' . get_the_excerpt() . '</p>';
			if ($type == 'reveal') {
				$profile_box .= 			'<div class="reveal-content">';
				$profile_box .= 				get_the_content();
				$profile_box .= 			'</div>';
				$profile_box .= 			'<p class="show-more reveal">Show More</p>';
			}
			elseif ($type == 'link') {
				$profile_box .= 			'<p class="show-more"><a href="' . get_the_permalink() . '">Visit Page</a></p>';
			}
			$profile_box .= 			'</div>';
			$profile_box .= 			'<div class="side-column-small">';
			$profile_box .= 				'<img src="' . $image['url'] . '" alt="' . $image['title'] . '">';
			$profile_box .= 			'</div>';
			$profile_box .= 		'</div>';
			$profile_box .= 	'</div>';
			$profile_box .= '</div>';
			$profile_box .= reopen_hb_structure();
		}
		wp_reset_postdata();
	}
	return $profile_box;
}

add_shortcode('related_story', 'show_related_story');
function show_related_story($atts) {
	$related_story_title = $atts['title'];
	$related_story = '';

	$related_query = new WP_Query(array(
		'title' => $related_story_title,
		'posts_per_page' => 1
	));
	if ($related_query->have_posts()) {
		while ($related_query->have_posts()) {
			$related_query->the_post();
			$story_copy = wp_trim_words(get_the_excerpt(), 25);

			$related_story  = exit_hb_structure();
			$related_story .= '<div class="outer-container related-content">';
			$related_story .= 	'<div class="side-related">';
			$related_story .= 		'<div class="inner-container">';
			$related_story .= 			'<div class="grid-container related-head">';
			$related_story .= 				'<div class="right-sub-content-container">';
			$related_story .= 					'<a href="' . get_the_permalink() . '">';
			$related_story .= 						get_the_post_thumbnail();
			$related_story .= 					'</a>';
			$related_story .= 				'</div>';
			$related_story .= 			'</div>';
			$related_story .= 			'<div class="grid-container related-body">';
			$related_story .= 				'<h5><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h5>';
			$related_story .= 				'<p class="aside">' . $story_copy . '</p>';
			$related_story .= 				'<p class="show-more"><a href="' . get_the_permalink() . '">Read More</a></p>';
			$related_story .= 			'</div>';
			$related_story .= 		'</div>';
			$related_story .= 	'</div>';
			$related_story .= '</div>';
			$related_story .= reopen_hb_structure();
		}
		wp_reset_postdata();
	}
	return $related_story;
}

add_shortcode('related_image', 'show_related_image');
function show_related_image($atts) {
	$image_source = $atts['src'];
	$image_caption = $atts['caption'];

	$related_image_markup  = exit_hb_structure();
	$related_image_markup .= '<div class="outer-container related-content">';
	$related_image_markup .= 	'<div class="side-related">';
	$related_image_markup .= 		'<div class="inner-container">';
	$related_image_markup .= 			'<div class="grid-container related-image">';
	$related_image_markup .= 				'<img src="' . $image_source . '" title="" alt="">';
	$related_image_markup .= 				'<p class="aside">' . $image_caption . '</p>';
	$related_image_markup .= 			'</div>';
	$related_image_markup .= 		'</div>';
	$related_image_markup .= 	'</div>';
	$related_image_markup .= '</div>';
	$related_image_markup .= reopen_hb_structure();
	return $related_image_markup;
}

add_shortcode('full_width_featured_image', 'show_full_width_featured_image');
function show_full_width_featured_image() {
	$poster_src = get_the_post_thumbnail_url();

	$poster  = exit_hb_structure();
	$poster .= '<div class="featured-image-wrapper">';
	$poster .= 	'<img src=' . $poster_src . '>';
	$poster .= '</div>';
	$poster .= reopen_hb_structure();
	echo $poster;
}

add_shortcode('video_bg', 'display_background_video');
function display_background_video($atts) {
	$name = $atts['name'];
	if (!empty($atts['poster'])) {
		$poster = $atts['poster'];
	}
	if (!empty($atts['src'])) {
		$video_src = $atts['src'];
	}
	if (!empty($atts['top'])) {
		$position = $atts['top'];
	} else {
		$position = "";
	}

	$bg_video  = exit_hb_structure();
	$bg_video .= '<div class="' . $name . ' ' . $position .' video-wrapper"';
	if (!empty($atts['poster'])) {
		$bg_video .= 	'style="background: url(' . $poster . '); background-size: cover;"';
	}
	$bg_video .= '>';
	if (!empty($video_src)) {
		$bg_video .= 	'<video class="video video-tag" loop>';
		$bg_video .= 		'<source src="' . $video_src . '" type="video/mp4">';
		$bg_video .= 	'</video>';
	}
	$bg_video .= '</div>';
	$bg_video .= '<div class="video-overlay"></div>';
	$bg_video .= reopen_hb_structure();
	return $bg_video;
}

add_shortcode('move_video', 'move_video_up');
function move_video_up($atts) {
	$name = $atts['name'];

	$video_pusher  = exit_hb_structure();
	$video_pusher .= '<div class="' . $name . ' move-video"></div>';
	$video_pusher .= reopen_hb_structure();
	return $video_pusher;
}

add_shortcode('standalone_video', 'display_inner_video');
function display_inner_video($atts) {
	$video_src = $atts['src'];
	$caption = $atts['caption'];
	if (empty($atts['youtube'])) {
		$atts['youtube'] = '';
	}

	$inner_video  = exit_hb_structure();
	$inner_video .= '<div class="standalone-video-bg">';
	if ($atts['youtube'] == 'youtube') {
		$inner_video .= '<iframe class="embeded-youtube-standalone" src="' . $video_src . '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
	}
	else {
		$inner_video .= 	'<video class="video inner-video" autoplay>';
		$inner_video .= 		'<source src="' . $video_src . '" type="video/mp4">';
		$inner_video .= 	'</video>';
	}
	if (!empty($caption)) {
		$inner_video .= '<p class="inner-video" style="color: #ffffff;">' . $caption . '</p>';
	}
	$inner_video .= '</div>';
	$inner_video .= reopen_hb_structure();
	return $inner_video;
}

add_shortcode('next_page', 'cta_next_page');
function cta_next_page($atts) {
	$cta_link  = '<a href="index.php/';
	$cta_link .= $atts['slug'];
	$cta_link .= '"><h4>Contintue</h4></a>';
	return $cta_link;
}
?>