<?php

/* ***************************************************************************** */
/* VARIOUS TOOLS BUNDLED WITH THE THEME                                          */
/* ***************************************************************************** */
/* Do not customize this file                                                    */
/* If customization is needed, move the specific function to functions.php       */
/* ***************************************************************************** */


// GET MEDIA METADATA
function theme_get_attachment_meta( $attachment_id ) {
	$attachment = get_post( $attachment_id );
	return [
		'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
		'caption' => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href' => get_permalink( $attachment->ID ),
		'src' => $attachment->guid,
		'title' => $attachment->post_title
	];
}


// FETCH DESIRED ATTACHMENT META
function theme_get_attachment_meta_by_attr($attachment_id, $attr, $placeholder = '') {
	$attachment = get_post($attachment_id);

	$metadata = '';
	if($attr == 'alt'){
		$data = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );
	} elseif($attr == 'href') {
		$data = get_permalink( $attachment->ID );
	} elseif($attr == 'title') {
		$data = $attachment->post_title;
	}

	if(!empty($placeholder) && !empty($data)) {
		$metadata = $data;
	} elseif(!empty($placeholder) && empty($data)) {
		$metadata = $placeholder;
	}

	return $metadata;
}


// FORMAT PHONE NUMBERS FOR TEL OR CALLTO ANCHORS (REMOVES SPACES AND ALL SYMBOLS EXCEPT +)
function theme_get_formatted_tel($string) {
  $string = preg_replace('/[^\p{L}\p{N}\s+]/u', '', $string);
  $string = preg_replace('/\s+/', '', $string);
  return $string;
}


// TRIM STRING LENGTH
function theme_get_trimmed_text($text, $max_length, $dots = true) {
	$character_count = strlen($text);
	if ($character_count > $max_length) {
		$cropped_text = wordwrap(preg_replace( "/\r|\n|\r\n/", " ", $text), $max_length);
		$text = substr($cropped_text, 0, strpos($cropped_text, "\n"));
		if($dots) {
		  $read_more_string = '...';
		  $text = $text . $read_more_string;
		}
	}
	return $text;
}


// CUSTOM PAGINATION
function theme_pagination_nav($query = false, $classes = '') {
	if(!$query) {
		global $wp_query;
		$query = $wp_query;
	}

	$bignum = 999999999;
	if ($query->max_num_pages <= 1) {
		return;
	}

	if($classes) {
		$classes = $classes . ' ';
	}

	$output = paginate_links([
		'base' => str_replace($bignum, '%#%', esc_url(get_pagenum_link($bignum))),
		'format' => '',
		'current' => max(1, get_query_var('paged')),
		'total' => $query->max_num_pages,
		'prev_text' => icon_svg('arrow-right', 'pagination__icon icon--flip-x', false),
		'next_text' => icon_svg('arrow-right', 'pagination__icon', false),
		'type' => 'list',
		'end_size' => 3,
		'mid_size' => 3
	]);
	$output = '<nav class="'. $classes .'pagination">' . str_replace(["<ul class='page-numbers'>", '<li>', 'page-numbers', 'prev', 'next', 'current'], ['<ul class="pagination__items">', '<li class="pagination__item">', 'pagination__anchor', 'pagination__anchor--previous', 'pagination__anchor--next', 'is-active'], $output) . '</nav>';

	echo $output;
}


// CUSTOM BREADCRUMBS LIST
function theme_breadcrumbs_list($wrapper_classes = false, $echo = true) {
	if($wrapper_classes) {
		$wrapper_classes = $wrapper_classes . ' ';
	}

	$page_refs = get_field('page_refs', 'options');

	global $post;
	$page_refs = get_field('page_refs', 'options');
	$page_id = $post->ID;

	$output = '<ul class="'. $wrapper_classes .'breadcrumb-list">';
	$output .= '<li class="breadcrumb-list__item"><a href="'. home_url() .'" class="breadcrumb-list__anchor">'. __('Avaleht', 'hiiukala-theme') .'</a></li>';

	if(is_page()) {

		$ancestors = get_post_ancestors($post->ID);
		if(!empty($ancestors)) {
			foreach($ancestors as $ancestor) {
				$post_title = get_the_title($ancestor);
				$post_url = get_permalink($ancestor);
				$output .= '<li class="breadcrumb-list__item"><a href="'. $post_url .'" class="breadcrumb-list__anchor">'. $post_title .'</a></li>';
			}
		}

		$current_post_title = get_the_title(get_the_ID());
		$current_post_url = get_permalink(get_the_ID());
		$output .= '<li class="breadcrumb-list__item"><a href="'. $current_post_url .'" class="breadcrumb-list__anchor">'. $current_post_title .'</a></li>';

	} else if(is_singular('event')) {
		
		$event_page_id = $page_refs['events'];
		$event_page_url = get_permalink($event_page_id);
		$event_page_title = get_the_title($event_page_id);
		if(!empty($event_page_url) && !is_wp_error($event_page_url)) {
			$output .= '<li class="breadcrumb-list__item"><a href="'. $event_page_url .'" class="breadcrumb-list__anchor">'. $event_page_title .'</a></li>';
		}

		$current_post_title = theme_get_trimmed_text(get_the_title(get_the_ID()), 25);
		$current_post_url = get_permalink(get_the_ID());
		$output .= '<li class="breadcrumb-list__item"><a href="'. $current_post_url .'" class="breadcrumb-list__anchor">'. $current_post_title .'</a></li>';

	} else if(is_single()) {

		$blog_page_id = $page_refs['blog'];
		$blog_page_url = get_permalink($blog_page_id);
		$blog_page_title = get_the_title($blog_page_id);
		if(!empty($blog_page_url) && !is_wp_error($blog_page_url)) {
			$output .= '<li class="breadcrumb-list__item"><a href="'. $blog_page_url .'" class="breadcrumb-list__anchor">'. $blog_page_title .'</a></li>';
		}

		$current_post_title = theme_get_trimmed_text(get_the_title(get_the_ID()), 25);
		$current_post_url = get_permalink(get_the_ID());
		$output .= '<li class="breadcrumb-list__item"><a href="'. $current_post_url .'" class="breadcrumb-list__anchor">'. $current_post_title .'</a></li>';
	
	}

	$output .= '</ul>';

	if($echo) {
		echo $output;
	} else {
		return $output;
	}
}


// CUSTOM WPML LANGUAGE SWITCHER
function theme_language_switcher($wrapper_classes = false) {
	if(function_exists('icl_object_id')) {
		$args = [
			'skip_missing' => 0,
			'orderby' => 'custom',
			'order' => 'asc'
		];
		if($wrapper_classes) {
			$wrapper_classes = $wrapper_classes . ' ';
		}
		$languages = apply_filters( 'wpml_active_languages' , NULL, $args);
		if(!empty($languages) && count($languages) > 1) {
			echo '<ul class="'. $wrapper_classes .'language-switcher">';
			foreach($languages as $l) {
				$active_class = '';
				if($l['active']) {
					$active_class = ' is-active';
				}
				echo '<li class="language-switcher__item' . $active_class . '">';
				if($l['country_flag_url']) {
					echo '<a href="'. $l['url'] .'" class="language-switcher__anchor">'. theme_get_three_letter_country_name($l['language_code']) .'</a>';
				}
				echo '</li>';
			}
			echo '</ul>';
		}
	}
}


// THREE-LETTER COUNTRY CODES FOR LANGUAGE SWITCHER
function theme_get_three_letter_country_name($country_code) {
	if($country_code === 'en') {
		$country_code = 'Eng';
	}
	if($country_code === 'et') {
		$country_code = 'Est';
	}
	if($country_code === 'ru') {
		$country_code = 'Rus';
	}

	return $country_code;
}


// SVG ICONS
function icon_svg($name, $classes = '', $echo = true, $autoprefix = true) {
    if(!$name) {
        return;
    }
    if($classes) {
        $classes = ' ' . $classes;
    }

	// Handle prefix
	$prefix = 'icon-';
	if(!$autoprefix || theme_string_starts_with($name, 'icon-')) {
		$prefix = '';
	}

	// Version
	$build_ver = wp_get_theme()->get('Version');

	// Output icon
	$output = '<svg class="icon'. $classes .'"><use href="'. get_template_directory_uri() .'/assets/icons/_icon-spritesheet-'. $build_ver .'.svg#'. $prefix . $name .'"></use></svg>';
	if($echo) {
		echo $output;
	} else {
		return $output;
	}
}


// DETECT IF STRING STARTS WITH SPECIFIED CHARS
function theme_string_starts_with($haystack, $needle) {
    return substr_compare($haystack, $needle, 0, strlen($needle)) === 0;
}


// LOADER
// Generates a loader bar. Add class "loader--disabled" for disabled state.
function theme_loader($id = false, $classes = false, $echo = true) {
	if(!empty($id)) {
		$id = 'id="'. $id .'"';
	}
	if(!empty($classes)) {
		$classes = ' '. $classes;
	}
	if($echo) {
		$output = '<div '. $id .' class="loader'. $classes .'"><div class="loader__inner"><div class="loader__dot">&nbsp;</div><div class="loader__dot">&nbsp;</div><div class="loader__dot">&nbsp;</div></div></div>';
	} else {
		return $output;
	}
}


// EXTRACT FILE INFO FROM URL
function theme_get_file_info_from_url($url, $get_size = false) {
	$output = [];

	$file = file_get_contents($url);
	$output['name'] = basename($url);
	$output['ext'] = pathinfo($url, PATHINFO_EXTENSION);
	$output['name_without_ext'] = pathinfo($url, PATHINFO_FILENAME);

	if($get_size) {
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, TRUE);
		curl_setopt($ch, CURLOPT_NOBODY, TRUE);
		$data = curl_exec($ch);
		$output['size'] = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
		curl_close($ch);
	}

	return $output;
}


// FORMAT BYTES TO OTHER SIZES
function theme_get_formatted_bytes($bytes, $precision = 2) {
    $units = array('B', 'KB', 'MB', 'GB', 'TB');

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
	$pow = min($pow, count($units) - 1);

    $bytes /= pow(1024, $pow);
    //$bytes /= (1 << (10 * $pow));

    return round($bytes, $precision) . ' ' . $units[$pow];
}


// CUSTOM EXCERPT
function theme_get_excerpt($post_id = false, $max_chars = 200) {
	if(empty($post_id)) {
		global $post;
		$post_data = [
			'id'	=> $post->ID,
			'excerpt'	=> $post->excerpt,
			'content'	=> $post->post_content
		];
	} else {
		$post_data = get_post($post_id);
		$post_data = [
			'id'	=> $post_data->ID,
			'excerpt'	=> $post_data->excerpt,
			'content'	=> $post_data->post_content
		];
	}

	if(!empty($post_data['excerpt'])) {
		$excerpt = theme_get_trimmed_text($post_data['excerpt'], $max_chars);
	} else {
		$excerpt = strip_tags(theme_get_trimmed_text($post_data['content'], $max_chars));
	}

	return $excerpt;
}


// CUSTOM IMAGE GET, RETURNS ARRAY OF IMAGE DATA
function theme_get_image($attachment_id, $image_size = false, $alt_fallback = false) {
	if(!is_int($attachment_id)) {
		return;
	}
	if(!$image_size) {
		$image_size = 'full';
	}

	$url = wp_get_attachment_image_url($attachment_id, $image_size);
	$alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
	if(empty($alt)) {
		if(!empty($alt_fallback)) {
			$alt = $alt_fallback;
		} else {
			$alt = __( 'Image', 'hiiukala-theme' );
		}
	}

	$output = [
		'url'	=> $url,
		'alt'	=> $alt,
	];

	return $output;
}

// CUSTOM IMAGE GET, RETURNS WP-BUILT IMG TAG
function theme_get_wp_image($attachment_id, $image_size = false, $classes = [], $alt_fallback = false, $alt_override = false, $data_attributes = []) {
	if(empty($attachment_id) || !is_int($attachment_id)) {
		return;
	}
	if(!$image_size) {
		$image_size = 'full';
	}

	// Handle attributes
	$attributes = [
		'class' => $classes
	];

	// Handle alt override
	if(!empty($alt_override)) {
		$attributes['alt'] = $alt_override;
	}

	// Handle getting image
	$image = wp_get_attachment_image($attachment_id, $image_size, false, $attributes);

	// Handle alt fallback
	if(strpos($image, 'alt=""')) {
		$alt_fallback = 'alt="' . $alt_fallback .'"';
		$image = str_replace('alt=""', $alt_fallback, $image);
	}

	// Handle data attribute insertion
	if(!empty($data_attributes) && is_array($data_attributes)) {
		foreach($data_attributes as $key => $data_attribute) {
			$current_attribute = 'data-' . $key . '="' . $data_attribute . '"';
			$current_attribute = ' '. $current_attribute;
			$image = substr_replace($image, $current_attribute, -2, 0);
		}
	}

	return $image;
}


// GET ACF LINK DATA IN A CLEAN ARRAY
function theme_get_acf_link_data($data, $fallback_text = '', $force_external_urls_in_new_tab = true) {
	if(empty($data)) {
		return false;
	}
	
	$output = [
		'url' 	 	=> $data['url'],
		'target' 	=> '',
		'text' 		=> $fallback_text
	];

	if(!empty($data['target']) && $data['target'] === '_blank') {
		$output['target'] = ' target="_blank" rel="noopener"';
	}

	if(!empty($data['title'])) {
		$output['text'] = $data['title'];
	}

	if(empty($data['target']) && $force_external_urls_in_new_tab) {
		$domain = $_SERVER['SERVER_NAME'];
		if(!strpos($output['url'], $domain)) {
			$output['target'] = ' target="_blank" rel="noopener"';
		}
	}

	return $output;
}


// GET SOCIAL MEDIA SHARE LINK
function theme_get_social_share_url($site, $url = false) {
	if(empty($site)) {
		return;
	}

	if(!$url) {
		global $wp;
		$url = home_url($wp->request);
	}
		
	$url_encoded = urlencode($url);

	$output = '';
	switch($site) {
		case 'facebook':
			$output = 'https://www.facebook.com/sharer/sharer.php?u=' . $url_encoded;
			break;
		case 'twitter':
			$output = 'https://twitter.com/intent/tweet?text=' . $url_encoded;
			break;
		case 'linkedin':
			$output = 'https://www.linkedin.com/sharing/share-offsite/?url=' . $url_encoded;
			break;
		case 'messenger':
			$output = 'fb-messenger://share/?link=' . $url_encoded;
			break;
	}

	return $output;
}


// FORMAT PASSED ARGUMENT DATA PASSED INTO COMPONENT ATTRIBUTES
// $attr = Pass in a formatted array of attributes along with default values
// $args = The arguments array received from get_template_part
function theme_get_block_attributes($default_attributes, $args) {
    $attributes = array_merge($default_attributes, $args);

	// Handle common cases
	if(isset($attributes['wrapper_classes']) && !empty($attributes['wrapper_classes'])) {
		$attributes['wrapper_classes'] = ' ' . $attributes['wrapper_classes'];
	}

    return $attributes;
}


// GET NAV ANCHOR HTML
function theme_get_nav_anchor($anchor, $echo = true) {
	if(empty($anchor)) {
		return;
	} else {
		$output = '<div id="'. $anchor .'" class="scroll-anchor">&nbsp;</div>';

		if($echo) {
			echo $output;
		} else {
			return $output;
		}
	}
}


?>