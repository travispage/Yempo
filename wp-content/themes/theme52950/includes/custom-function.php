<?php
	// Loads child theme textdomain
	load_child_theme_textdomain( CURRENT_THEME, CHILD_DIR . '/languages' );

	require_once(CHILD_DIR. "/includes/meta-box-class/my-meta-box-init.php");

	// Add the postmeta to Clients
    require_once( 'theme-clientsmeta.php' );

	require_once( 'custom-js.php' );

	// Custom inner row
	if (!function_exists('row_custom_shortcode')) {
		function row_custom_shortcode($atts, $content = null) {
		extract(shortcode_atts(array(
		'custom_class' => '',
		), $atts));
		$output = '<div class="row '.$custom_class.'">'.do_shortcode($content).'</div>';
		return $output;
		}
		add_shortcode('row_custom', 'row_custom_shortcode');
	}

	// Extra Wrap
	if (!function_exists('extra_wrap_shortcode')) {
		function extra_wrap_shortcode($atts, $content = null) {
		extract(shortcode_atts(array(
		'custom_class' => '',
		), $atts));
		$output = '<div class="extra-wrap '.$custom_class.'">';
		$output .= do_shortcode($content);
		$output .= '</div>';

		return $output;
		}
		add_shortcode('extra_wrap', 'extra_wrap_shortcode');
	}

	// Custom list
	if ( !function_exists('custom_list_shortcode') ) {
		function custom_list_shortcode( $atts, $content = null) {
			extract(shortcode_atts(array(
			'custom_class' => '',
			), $atts));
			$output = '<div class="list styled custom-list '.$custom_class.'">';
			$output .= do_shortcode( $content );
			$output .= '</div>';

			return $output;
		}
		add_shortcode('custom_list', 'custom_list_shortcode');
	}

	// unstyled list
	if ( !function_exists('list_un_shortcode') ) {
		function list_un_shortcode( $atts, $content = null) {
			extract(shortcode_atts(array(
			'custom_class' => '',
			), $atts));
			$output = '<div class="list unstyled '.$custom_class.'">';
			$output .= do_shortcode( $content );
			$output .= '</div>';

			return $output;
		}
		add_shortcode('list_un', 'list_un_shortcode');
	}

	// Custom Extra Wrap
	if (!function_exists('extra_wrap_inner_shortcode')) {
		function extra_wrap_inner_shortcode($atts, $content = null) {
		extract(shortcode_atts(array(
		'custom_class' => '',
		), $atts));
		$output = '<div class="extra-wrap-inner '.$custom_class.'">';
		$output .= do_shortcode($content);
		$output .= '</div>';

		return $output;
		}
		add_shortcode('extra_wrap_inner', 'extra_wrap_inner_shortcode');
	}

	add_filter( 'cherry_stickmenu_selector', 'cherry_change_selector' );
		function cherry_change_selector($selector) {
		$selector = 'header .custom_poz';
		return $selector;
	}

	// Loads custom scripts.
	// require_once( 'custom-js.php' );

	//Recent Testimonials
	if (!function_exists('shortcode_recenttesti')) {

		function shortcode_recenttesti( $atts, $content = null, $shortcodename = '' ) {
			extract(shortcode_atts(array(
					'num'           => '5',
					'thumb'         => 'true',
					'excerpt_count' => '30',
					'appearance'    => 'false',
					'custom_class'  => '',
			), $atts));

			wp_enqueue_script( 'owl-carousel', CHERRY_PLUGIN_URL . 'lib/js/owl-carousel/owl.carousel.min.js', array('jquery'), '1.31', true );

			// WPML filter
			$suppress_filters = get_option('suppress_filters');

			$args = array(
					'post_type'        => 'testi',
					'numberposts'      => $num,
					'orderby'          => 'post_date',
					'suppress_filters' => $suppress_filters
				);
			$testi = get_posts($args);

			$itemcounter = 0;

			$output = '<div class="testimonials-carousel '.$custom_class.'">';

			global $post;
			global $my_string_limit_words;

			foreach ($testi as $k => $post) {
				//Check if WPML is activated
				if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
					global $sitepress;

					$post_lang = $sitepress->get_language_for_element($post->ID, 'post_testi');
					$curr_lang = $sitepress->get_current_language();
					// Unset not translated posts
					if ( $post_lang != $curr_lang ) {
						unset( $testi[$k] );
					}
					// Post ID is different in a second language Solution
					if ( function_exists( 'icl_object_id' ) ) {
						$post = get_post( icl_object_id( $post->ID, 'testi', true ) );
					}
				}
				setup_postdata( $post );
				$post_id = $post->ID;
				$excerpt = get_the_excerpt();

				// Get custom metabox value.
				$testiname  = get_post_meta( $post_id, 'my_testi_caption', true );
				$testiurl   = esc_url( get_post_meta( $post_id, 'my_testi_url', true ) );
				$testiinfo  = get_post_meta( $post_id, 'my_testi_info', true );
				$testiemail = sanitize_email( get_post_meta( $post_id, 'my_testi_email', true ) );

				$attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
				$url            = $attachment_url['0'];
				$image          = aq_resize($url, 270, 270, true);
				
				if($appearance == 'true') $appearance_class = 'testi-item-with-appearance object-hidden';

				$output .= '<div class="testi-item list-item-'.$itemcounter.' '.$appearance_class.'">';
					$output .= '<blockquote class="testi-item_blockquote">';
					
						$output .= '<div class="testi-content-holder">';
							$output .= '<a href="'.get_permalink( $post_id ).'"><div>';
								//$output .= "Excerpt Count: ".$excerpt_count;
								$output .= my_string_limit_words($excerpt,$excerpt_count);
								$output .= '" Read more...';
							$output .= '</div></a>';

							if ($thumb == 'true') {
								if ( has_post_thumbnail( $post_id ) ){
									$output .= '<figure class="featured-thumbnail">';
									$output .= '<img src="'.$image.'" alt="" />';
									$output .= '</figure>';
								}
							}

							$output .= '<div class="testi-meta">';
								if ( !empty( $testiname ) ) {
									$output .= '<div class="user">';
										$output .= $testiname;
									$output .= '</div>';
								}
						
								if ( !empty( $testiinfo ) ) {
									$output .= ' <div class="info">';
										$output .= $testiinfo;
									$output .= '</div>';
								}

								if ( !empty( $testiurl ) ) {
									$output .= '<a class="testi-url" href="'.$testiurl.'">';
										$output .= $testiurl;
									$output .= '</a><br>';
								}

								if ( !empty( $testiemail ) && is_email( $testiemail ) ) {
									$output .= '<a class="testi-email" href="mailto:' . antispambot( $testiemail, 1 ) . '" >' . antispambot( $testiemail ) . ' </a>';
								}

							$output .= '<div class="clear"></div></div>';
						$output .= '</div>';

					$output .= '</blockquote>';

				$output .= '</div>';
				$itemcounter++;

			}
			wp_reset_postdata(); // restore the global $post variable
			$output .= '</div>';

			$output .= '<script>
				$(function() {
					$(".testimonials-carousel").owlCarousel({
				        slideSpeed : 500,
				        paginationSpeed : 500,
				        singleItem:true,
				        pagination:false,
				        navigation:true,
				        navigationText : ["",""], 
			    	});
				});
			</script>';

			$output = apply_filters( 'cherry_plugin_shortcode_output', $output, $atts, $shortcodename );

			return $output;
		}
		add_shortcode('recenttesti', 'shortcode_recenttesti');
	}


	/**
 * Post Grid
 *
 */
if (!function_exists('posts_grid_shortcode')) {

	function posts_grid_shortcode( $atts, $content = null, $shortcodename = '' ) {
		extract(shortcode_atts(array(
			'type'            => 'post',
			'category'        => '',
			'custom_category' => '',
			'tag'             => '',
			'columns'         => '3',
			'rows'            => '3',
			'order_by'        => 'date',
			'order'           => 'DESC',
			'thumb_width'     => '370',
			'thumb_height'    => '250',
			'meta'            => '',
			'excerpt_count'   => '15',
			'link'            => 'yes',
			'link_text'       => __('Read more', CHERRY_PLUGIN_DOMAIN),
			'custom_class'    => ''
		), $atts));

		$spans = $columns;
		$rand  = rand();

		// columns
		switch ($spans) {
			case '1':
				$spans = 'span12';
				break;
			case '2':
				$spans = 'span6';
				break;
			case '3':
				$spans = 'span4';
				break;
			case '4':
				$spans = 'span3';
				break;
			case '6':
				$spans = 'span2';
				break;
		}

		// check what order by method user selected
		switch ($order_by) {
			case 'date':
				$order_by = 'post_date';
				break;
			case 'title':
				$order_by = 'title';
				break;
			case 'popular':
				$order_by = 'comment_count';
				break;
			case 'random':
				$order_by = 'rand';
				break;
		}

		// check what order method user selected (DESC or ASC)
		switch ($order) {
			case 'DESC':
				$order = 'DESC';
				break;
			case 'ASC':
				$order = 'ASC';
				break;
		}

		// show link after posts?
		switch ($link) {
			case 'yes':
				$link = true;
				break;
			case 'no':
				$link = false;
				break;
		}

			global $post;
			global $my_string_limit_words;

			$numb = $columns * $rows;

			// WPML filter
			$suppress_filters = get_option('suppress_filters');

			$args = array(
				'post_type'         => $type,
				'category_name'     => $category,
				$type . '_category' => $custom_category,
				'tag'               => $tag,
				'numberposts'       => $numb,
				'orderby'           => $order_by,
				'order'             => $order,
				'suppress_filters'  => $suppress_filters
			);

			$posts      = get_posts($args);
			$i          = 0;
			$count      = 1;
			$output_end = '';
			$countul = 0;

			if ($numb > count($posts)) {
				$output_end = '</ul>';
			}

			$output = '<ul class="posts-grid row-fluid unstyled '. $custom_class .' ul-item-'.$countul.'">';


			foreach ( $posts as $j => $post ) {
				$post_id = $posts[$j]->ID;
				//Check if WPML is activated
				if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
					global $sitepress;

					$post_lang = $sitepress->get_language_for_element( $post_id, 'post_' . $type );
					$curr_lang = $sitepress->get_current_language();
					// Unset not translated posts
					if ( $post_lang != $curr_lang ) {
						unset( $posts[$j] );
					}
					// Post ID is different in a second language Solution
					if ( function_exists( 'icl_object_id' ) ) {
						$posts[$j] = get_post( icl_object_id( $posts[$j]->ID, $type, true ) );
					}
				}

				setup_postdata($posts[$j]);
				$excerpt        = get_the_excerpt();
				$attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'full' );
				$url            = $attachment_url['0'];
				$image          = aq_resize($url, $thumb_width, $thumb_height, true);
				$mediaType      = get_post_meta($post_id, 'tz_portfolio_type', true);
				$prettyType     = 0;

				if ($count > $columns) {
					$count = 1;
					$countul ++;
					$output .= '<ul class="posts-grid row-fluid unstyled '. $custom_class .' ul-item-'.$countul.'">';
				}

				$output .= '<li class="'. $spans .' list-item-'.$count.'">';
					if(has_post_thumbnail($post_id) && $mediaType == 'Image') {

						$prettyType = 'prettyPhoto-'.$rand;

						$output .= '<figure class="featured-thumbnail thumbnail">';
						//$output .= '<a href="'.$url.'" title="'.get_the_title($post_id).'" rel="' .$prettyType.'">';
						$output .= '<a href="'.get_permalink($post_id).'" title="'.get_the_title($post_id).'">';
						$output .= '<img  src="'.$image.'" alt="'.get_the_title($post_id).'" />';
						$output .= '<span class="zoom-icon"></span></a></figure>';
					} elseif ($mediaType != 'Video' && $mediaType != 'Audio') {

						$thumbid = 0;
						$thumbid = get_post_thumbnail_id($post_id);

						$images = get_children( array(
							'orderby'        => 'menu_order',
							'order'          => 'ASC',
							'post_type'      => 'attachment',
							'post_parent'    => $post_id,
							'post_mime_type' => 'image',
							'post_status'    => null,
							'numberposts'    => -1
						) );

						if ( $images ) {

							$k = 0;
							//looping through the images
							foreach ( $images as $attachment_id => $attachment ) {
								$prettyType = "prettyPhoto-".$rand ."[gallery".$i."]";
								//if( $attachment->ID == $thumbid ) continue;

								$image_attributes = wp_get_attachment_image_src( $attachment_id, 'full' ); // returns an array
								$img = aq_resize( $image_attributes[0], $thumb_width, $thumb_height, true ); //resize & crop img
								$alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
								$image_title = $attachment->post_title;

								if ( $k == 0 ) {
									if (has_post_thumbnail($post_id)) {
										$output .= '<figure class="featured-thumbnail thumbnail">';
										//$output .= '<a href="'.$image_attributes[0].'" title="'.get_the_title($post_id).'" rel="' .$prettyType.'">';
										$output .= '<a href="'.get_permalink($post_id).'" title="'.get_the_title($post_id).'">';
										$output .= '<img src="'.$image.'" alt="'.get_the_title($post_id).'" />';
									} else {
										$output .= '<figure class="featured-thumbnail thumbnail">';
										//$output .= '<a href="'.$image_attributes[0].'" title="'.get_the_title($post_id).'" rel="' .$prettyType.'">';
										$output .= '<a href="'.get_permalink($post_id).'" title="'.get_the_title($post_id).'">';
										$output .= '<img  src="'.$img.'" alt="'.get_the_title($post_id).'" />';
									}
								} else {
									$output .= '<figure class="featured-thumbnail thumbnail" style="display:none;">';
									//$output .= '<a href="'.$image_attributes[0].'" title="'.get_the_title($post_id).'" rel="' .$prettyType.'">';
									$output .= '<a href="'.get_permalink($post_id).'" title="'.get_the_title($post_id).'">';
								}
								$output .= '<span class="zoom-icon"></span></a></figure>';
								$k++;
							}
						} elseif (has_post_thumbnail($post_id)) {
							$prettyType = 'prettyPhoto-'.$rand;
							$output .= '<figure class="featured-thumbnail thumbnail">';
							//$output .= '<a href="'.$url.'" title="'.get_the_title($post_id).'" rel="' .$prettyType.'">';
							$output .= '<a href="'.get_permalink($post_id).'" title="'.get_the_title($post_id).'">';
							$output .= '<img  src="'.$image.'" alt="'.get_the_title($post_id).'" />';
							$output .= '<span class="zoom-icon"></span></a></figure>';
						}
					} else {

						// for Video and Audio post format - no lightbox
						$output .= '<figure class="featured-thumbnail thumbnail"><a href="'.get_permalink($post_id).'" title="'.get_the_title($post_id).'">';
						$output .= '<img  src="'.$image.'" alt="'.get_the_title($post_id).'" />';
						$output .= '</a></figure>';
					}

					$output .= '<div class="clear"></div>';

					$output .= '<h5><a href="'.get_permalink($post_id).'" title="'.get_the_title($post_id).'">';
						$output .= get_the_title($post_id);
					$output .= '</a></h5>';

					$output .= '<div class="post_metabox">';
						$output .= get_post_meta(get_the_ID(), 'tm_text_field_id', true);
					$output .= '</div>';

					if ($meta == 'yes') {
						// begin post meta
						$output .= '<div class="post_meta">';

							// post category
							$output .= '<span class="post_category">';
							if ($type!='' && $type!='post') {
								$terms = get_the_terms( $post_id, $type.'_category');
								if ( $terms && ! is_wp_error( $terms ) ) {
									$out = array();
									$output .= '<em>Posted in </em>';
									foreach ( $terms as $term )
										$out[] = '<a href="' .get_term_link($term->slug, $type.'_category') .'">'.$term->name.'</a>';
										$output .= join( ', ', $out );
								}
							} else {
								$categories = get_the_category($post_id);
								if($categories){
									$out = array();
									$output .= '<em>Posted in </em>';
									foreach($categories as $category)
										$out[] = '<a href="'.get_category_link($category->term_id ).'" title="'.$category->name.'">'.$category->cat_name.'</a> ';
										$output .= join( ', ', $out );
								}
							}
							$output .= '</span>';

							// post date
							$output .= '<span class="post_date">';
							$output .= '<time datetime="'.get_the_time('Y-m-d\TH:i:s', $post_id).'">' .get_the_date('<b>d</b>M'). '</time>';
							$output .= '</span>';

							// post author
							$output .= '<span class="post_author">';
							$output .= '<em> by </em>';
							$output .= '<a href="'.get_author_posts_url(get_the_author_meta( 'ID' )).'">'.get_the_author_meta('display_name').'</a>';
							$output .= '</span>';

							// post comment count
							$num = 0;
							$queried_post = get_post($post_id);
							$cc = $queried_post->comment_count;
							if( $cc == $num || $cc > 1 ) : $cc = $cc.' Comments';
							else : $cc = $cc.' Comment';
							endif;
							$permalink = get_permalink($post_id);
							$output .= '<span class="post_comment">';
							$output .= '<a href="'. $permalink . '" class="comments_link">' . $cc . '</a>';
							$output .= '</span>';
						$output .= '</div>';
						// end post meta
					}
					$output .= cherry_get_post_networks(array('post_id' => $post_id, 'display_title' => false, 'output_type' => 'return'));
					if($excerpt_count >= 1){
						$output .= '<p class="excerpt">';
							$output .= wp_trim_words($excerpt,$excerpt_count);
						$output .= '</p>';
					}
					if($link){
						$output .= '<a href="'.get_permalink($post_id).'" class="btn btn-primary" title="'.get_the_title($post_id).'">';
						$output .= $link_text;
						$output .= '</a>';
					}
					$output .= '</li>';
					if ($j == count($posts)-1) {
						$output .= $output_end;
					}
				if ($count % $columns == 0) {
					$output .= '</ul><!-- .posts-grid (end) -->';
				}
			$count++;
			$i++;

		} // end for
		wp_reset_postdata(); // restore the global $post variable

		$output = apply_filters( 'cherry_plugin_shortcode_output', $output, $atts, $shortcodename );

		return $output;
	}
	add_shortcode('posts_grid', 'posts_grid_shortcode');
}

/**
 * Service Box
 *
 */
if (!function_exists('service_box_shortcode')) {

	function service_box_shortcode( $atts, $content = null, $shortcodename = '' ) {
		extract(shortcode_atts(
			array(
				'title'        => '',
				'subtitle'     => '',
				'icon'         => '',
				'icon_link'    => '',
				'text'         => '',
				'btn_text'     => __('Read more', CHERRY_PLUGIN_DOMAIN),
				'btn_link'     => '',
				'btn_size'     => '',
				'target'       => '',
				'custom_class' => '',
		), $atts));

		$output =  '<div class="service-box '.$custom_class.'">';

		if($icon != 'no'){
			$icon_url = CHERRY_PLUGIN_URL . 'includes/images/' . strtolower($icon) . '.png' ;
			if( defined ('CHILD_DIR') ) {
				if(file_exists(CHILD_DIR.'/images/'.strtolower($icon).'.png')){
					$icon_url = CHILD_URL.'/images/'.strtolower($icon).'.png';
				}
			}
			if ( empty( $icon_link ) ) {
				$output .= '<figure class="icon"><img src="'.$icon_url.'" alt="" /></figure>';
			} else {
				$output .= '<figure class="icon"><a href="' . esc_url( $icon_link ) . '"><img src="' . $icon_url . '" alt="" /></a></figure>';
			}
		}

		$output .= '<div class="service-box_body">';
		//Adding link to whole content 
		$output .= '<a href="'.$btn_link.'" title="'.$title.'">';
		if ($title!="") {
			$output .= '<h2 class="title">';
			$output .= $title;
			$output .= '</h2>';
		}
		if ($subtitle!="") {
			$output .= '<h5 class="sub-title">';
			$output .= $subtitle;
			$output .= '</h5>';
		}
		if ($text!="") {
			$output .= '<div class="service-box_txt">';
			$output .= $text;
			$output .= '</div>';
		}
		//Adding link to whole content 
		$output .= '</a>';
		if ($btn_link!="") {
			$output .=  '<div class="btn-align"><a href="'.$btn_link.'" title="'.$btn_text.'" class="btn btn-inverse btn-'.$btn_size.' btn-primary " target="'.$target.'">';
			$output .= $btn_text;
			$output .= '</a></div>';
		}
		$output .= '</div>';
		$output .= '</div><!-- /Service Box -->';

		$output = apply_filters( 'cherry_plugin_shortcode_output', $output, $atts, $shortcodename );

		return $output;
	}
	add_shortcode('service_box', 'service_box_shortcode');
}
/**
 * Hero Unit
 *
 */
if (!function_exists('hero_unit_shortcode')) {

	function hero_unit_shortcode( $atts, $content = null, $shortcodename = '' ) {
		extract(shortcode_atts(
			array(
				'title'        => '',
				'text'         => '',
				'btn_text'     => __('Read more', CHERRY_PLUGIN_DOMAIN),
				'btn_link'     => '',
				'btn_style'    => '',
				'btn_size'     => '',
				'target'       => '',
				'custom_class' => ''
		), $atts));

		
		$output =  '<div class="hero-unit '.$custom_class.'">';
		if ($btn_link!="") { 
			$output .=  '<a href="'.$btn_link.'" title="'.$btn_text.'" target="'.$target.'">';
		}
		if ($title!="") {
			$output .= '<h1>';
			$output .= $title;
			$output .= '</h1>';
		}

		if ($text!="") {
			$output .= '<p>';
			$output .= $text;
			$output .= '</p>';
		}
		if ($btn_link!="") {
			$output .=  '<div class="btn-align"><div class="btn btn-'.$btn_style.' btn-'.$btn_size.' btn-primary">';
			$output .= $btn_text;
			$output .= '</div></div>';
			
			//$output .=  '<div class="btn-align"><a href="'.$btn_link.'" title="'.$btn_text.'" class="btn btn-'.$btn_style.' btn-'.$btn_size.' btn-primary" target="'.$target.'">';
			//$output .= $btn_text;
			//$output .= '</a></div>';
		}
		if ($btn_link!="") { 
			$output .=  '</a>';
		}
		$output .= '</div><!-- .hero-unit (end) -->';
		
		$output = apply_filters( 'cherry_plugin_shortcode_output', $output, $atts, $shortcodename );

		return $output;
	}
	add_shortcode('hero_unit', 'hero_unit_shortcode');

}

function yempo_script_loader_src( $src, $handle ) {
	if ( preg_match( '/post\-scraper/', $src ) && preg_match( '/editor\-plugin/', $src ) && preg_match( '/wptextpattern/', $src ) ) {
		$src = add_query_arg( '_', time(), $src );
	}

	return $src;
}
add_filter( 'script_loader_src', 'yempo_script_loader_src', 10, 2 );


add_action( 'wp_ajax_my_ajax', 'my_ajax' );
add_action( 'wp_ajax_nopriv_my_ajax', 'my_ajax' );

function my_ajax() {
	wp_mail('vanessa.betito@yempo-solutions.com', 'Test Subject', 'Test Message');
	mail('vanessa.betito@yempo-solutions.com', 'Test Subject 2', 'Test Message 2');
	wp_mail('appdev542@outlook.com', 'Test Subject 3', 'Test Message 3');
	mail('appdev542@outlook.com', 'Test Subject 4', 'Test Message 4');

}
function __mailtest($error) {
  echo 'test';
  var_dump($error);
}
add_action('wp_mail_failed', '_mailtest');