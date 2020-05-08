<?php
/**
 * 初期設定系
 * @package monozuki
 */

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles' );
remove_action('admin_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'wp_generator');
add_filter( 'emoji_svg_url', '__return_false' );
add_filter( 'adminStylesheet', '__return_false' );
add_filter( 'wp_calculate_image_srcset', '__return_false' );
add_theme_support( 'customize-selective-refresh-widgets' );

if ( ! function_exists( 'mnzk_setup' ) ) :
	function mnzk_setup() {
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		register_nav_menus( array(
			'global-menu' => esc_html__( 'global', 'monozuki' ),
			'global-sub-menu' => esc_html__( 'global-sub', 'monozuki' ),
			'top-cat' => esc_html__( 'top', 'monozuki' ),
		) );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',) );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'custom-logo', array( 'height' => 50, 'width' => 250, 'flex-width'  => true, 'flex-height' => true,) );
	}
endif;
add_action( 'after_setup_theme', 'mnzk_setup' );

// imgにクラス追加
function customize_img_async($content) {
	$re_content = preg_replace('/(<img[^>]*)\s+class="([^"]*)"/', '$1 class="$2" loading="lazy"', $content);
	return $re_content;
}
add_filter('the_content','customize_img_async');

function admin_favicon() {
	echo '<link rel="shortcut icon" type="image/x-icon" href="'.get_template_directory_uri().'/common/img/favicon.png" />';
}
add_action( 'admin_head', 'admin_favicon' );

$detect = new Mobile_Detect;
if($detect->isTablet()){
	define('DEVICE', 'TAB');
}elseif($detect->isMobile()){
	define('DEVICE', 'SP');
}else{
	define('DEVICE', 'PC');
}

add_action('wp_head', 'add_description');

function add_description() {
	$meta = '<meta name="description" content="%s" />';
	if (is_home() || is_front_page()) {
		$site_description = get_bloginfo('description', 'display');
		if ($site_description) {
			printf($meta, $site_description);
		}
	} elseif (is_singular()) {
		$id = get_the_ID();
		$post = get_post($id);
		$exc = null;
		if ($post->post_excerpt) {
			$exc = esc_attr($post->post_excerpt);
		} else {
			$exc = esc_attr(strip_tags($post->post_content));
			$exc = preg_replace("/[\r\n]/", " ", $exc);
			$exc = mb_strimwidth($exc, 0, 100, "...");
		}
		if ($exc) {
			printf(
				$meta,
				$exc
			);
		}
	} elseif (is_archive()) {
		$id = get_the_ID();
		$post = get_post($id);
		$exc = null;
		if ( is_category() ) {
			$exc = mb_substr(strip_tags( category_description(), ''), 0, 130);
			$exc = preg_replace("/[\r\n]/", " ", $exc);
		} elseif ( is_tag() ) {
			if (tag_description()) {
				$exc = mb_substr(strip_tags( tag_description(), ''), 0, 130);
				$exc = preg_replace("/[\r\n]/", " ", $exc);
			} elseif ( is_tax() ) {
				$tax_slug = get_query_var('taxonomy');
				$term_slug = get_query_var('term');
				$term = get_term_by("slug",$term_slug,$tax_slug);
				$exc = $term->description;
				$exc = preg_replace("/[\r\n]/", " ", $exc);
			} else {
				$exc = get_the_archive_title();
				$exc = preg_replace("/[\r\n]/", " ", $exc);
			}
		}
		if ($exc) {
			printf(
				$meta,
				$exc
			);
		}
	}
}

class Walker_Nav_TopPage extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth = 0, $args = Array(), $id = 0) {

		if ($item->type == 'taxonomy' && $item->object == 'category') {
			$obj_ttl = $item->title;
			echo '<div class="toppage-cat-area"><h2 class="blogger_ttl"><span>'.$obj_ttl.'</span></h2><div class="entry-list">';
			$obj_id = $item->object_id;
			$args = array( 'posts_per_page' => 8, 'cat' => $obj_id );
			$cat_link = get_category_link( $obj_id );
			$wp_query = new WP_Query($args);
			if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) :
				$wp_query->the_post();
				include locate_template( 'tpl/newslist-item.php' );
			endwhile;
			endif;
			echo '</div>';
			echo '<div class="linkbtn-wrp"><a class="linkbtn" href="'.$cat_link.'">MORE</a></div>';
			echo '</div>';
		}else{
			return;
		}
	}
}

//
function rss_post_thumbnail($content) {
	global $post;
	if(has_post_thumbnail($post->ID)) {
		$content = '<p>' . get_the_post_thumbnail($post->ID) . '</p>' . $content;
	}
	return $content;
}
add_filter('the_excerpt_rss', 'rss_post_thumbnail');
add_filter('the_content_feed', 'rss_post_thumbnail');

function change_user_meta($data){
	$data['twitter'] = 'Twitterアカウント名(例:tako3)';
	$data['facebook'] = 'facebookのURL';
	$data['instagram'] = 'Instagramアカウント名(例:tako3ch)';
	return $data;
}
add_filter('user_contactmethods', 'change_user_meta', 10, 1);

// 自動生成される画像を全部削除
add_filter( 'intermediate_image_sizes_advanced', 'disable_image_sizes' );
function disable_image_sizes( $new_sizes ) {
	unset( $new_sizes['thumbnail'] );
	unset( $new_sizes['medium'] );
	unset( $new_sizes['large'] );
	unset( $new_sizes['medium_large'] );
	unset( $new_sizes['1536x1536'] );
	unset( $new_sizes['2048x2048'] );
	return $new_sizes;
}
add_filter( 'big_image_size_threshold', '__return_false' );