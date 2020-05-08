<?php
/**
 * monozuki functions
 *
 *
 * @package monozuki
 */
require_once(dirname(__FILE__)."/common/lib/mobile_detect.php");
// 初期設定周り
require get_template_directory() . '/inc/general.php';

// updatechecker
// require get_template_directory() . '/inc/update-checker.php';

// JS
require get_template_directory() . '/inc/enqueue.php';

// blockeditor
require get_template_directory() . '/inc/blockeditor.php';

// ページネーション
require get_template_directory() . '/inc/pagination.php';

// カスタマイザー
require get_template_directory() . '/inc/customizer.php';

// コメント
require get_template_directory() . '/inc/comment.php';