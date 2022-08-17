<?php
/**
 * Example custom post type
 *
 * Files in this folder are automatically loaded in `functions.php`
 */


$post_type = 'pokemon';
$singular = 'Pokemon';
$plural = 'Pokemon';
$plural_lower = strtolower($plural);

$args = [
  'labels' => [
    'name' => _x($plural, 'Post type general name'),
    'singular_name' => _x($singular, 'Post type singular name'),
    'menu_name' => _x($plural, 'Admin Menu text'),
    'name_admin_bar' => _x($singular, 'Add New on Toolbar'),
    'add_new' => __('Add New'),
    'add_new_item' => __("Add New $singular"),
    'new_item' => __("New $singular"),
    'edit_item' => __("Edit $singular"),
    'view_item' => __("View $singular"),
    'all_items' => __("All $plural"),
    'search_items' => __("Search $plural"),
    'parent_item_colon' => __("Parent $singular:"),
    'not_found' => __("No $plural_lower found."),
    'not_found_in_trash' => __("No $plural_lower found in Trash."),
  ],
  'public' => true,
  'publicly_queryable' => true,
  'show_ui' => true,
  'show_in_menu' => true,
  'query_var' => true,
  'rewrite' => ['slug' => $plural_lower, 'with_front' => false],
  'capability_type' => 'post',
  'has_archive' => true,
  'hierarchical' => false,
  'menu_position' => null,
  'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
];

register_post_type($post_type, $args);

