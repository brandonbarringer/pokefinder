<?php
/**
 * Example custom taxonomy
 *
 * Files in this folder are automatically loaded in `functions.php`
 */


$taxonomy_name = 'locations';
$post_types = ['pokemon'];
$singular = 'Location';
$plural = 'Locations';
$plural_lower = strtolower($plural);

$args = [
  'labels' => [
    'name' => _x($plural, 'taxonomy general name'),
    'singular_name' => _x($singular, 'taxonomy singular name'),
    'search_items' => __("Search $plural"),
    'all_items' => __("All $plural"),
    'parent_item' => __("Parent $singular"),
    'parent_item_colon' => __("Parent $singular:"),
    'edit_item' => __("Edit $singular"),
    'update_item' => __("Update $singular"),
    'add_new_item' => __("Add New $singular"),
    'new_item_name' => __("New $singular Name"),
    'menu_name' => __($plural),
  ],
  'hierarchical' => true,
  'show_ui' => true,
  'show_admin_column' => true,
  'query_var' => true,
  'rewrite' => ['slug' => $plural_lower],
];

register_taxonomy($taxonomy_name, $post_types, $args);

