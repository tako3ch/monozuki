<?php
/**
 * blockeditor
 *
 * @package monozuki
 */

function add_mnzk_orgblock()
{
  if (is_child_theme()) {
    wp_enqueue_style('block-style', get_template_directory_uri() . '/common/css/block_style.css');
    wp_enqueue_script('block-custom', get_template_directory_uri() . '/common/js/blockeditor.js', array(), "", true);
  } else {
    wp_enqueue_style('block-style', get_stylesheet_directory_uri() . '/common/css/block_style.css');
    wp_enqueue_script('block-custom', get_stylesheet_directory_uri() . '/common/js/blockeditor.js', array(), "", true);

  }
}

add_action('enqueue_block_editor_assets', 'add_mnzk_orgblock');

function mnzk_orgblock_category($categories, $post)
{
  return array_merge(
      $categories,
      array(
          array(
              'slug' => 'mnzk_orgblock',
              'title' => '[monozuki]Blocks',
              'icon' => 'dashicons-star-empty',
          ),
      )
  );
}

add_filter('block_categories', 'mnzk_orgblock_category', 10, 2);