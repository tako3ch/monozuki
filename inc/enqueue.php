<?php
/**
 * スクリプト
 * @package monozuki
 */

function mnzk_scripts() {
	// js
	wp_enqueue_script( 'mnzk-lib', get_template_directory_uri() . '/common/js/library.js', array(), '20200508', true );
	wp_enqueue_script( 'mnzk-basic', get_template_directory_uri() . '/common/js/basic.js', array(), '20200511', true );
}
add_action( 'wp_enqueue_scripts', 'mnzk_scripts' );

add_action('template_redirect', function(){
	ob_start(function($TypeDelete){
		$TypeDelete = str_replace(array('type="text/javascript" ', ""), '', $TypeDelete);
		$TypeDelete = str_replace(array('type="text/css" ', ""), '', $TypeDelete);
	return $TypeDelete;
	});
});