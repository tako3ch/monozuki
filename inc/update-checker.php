<?php
/**
 * update
 * @package monozuki
 */

// update
require(__DIR__."/../common/lib/update-checker.php");
$example_update_checker = new ThemeUpdateChecker(
	'monozuki',
	'https://mono.tako3.photo/download/update-info.json'
);