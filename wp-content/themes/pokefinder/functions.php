<?php
require_once __DIR__ . '/theme/Helpers.php';
require_once __DIR__ . '/theme/Assets.php';
require_once __DIR__ . '/theme/Hooks.php';
require_once __DIR__ . '/theme/default-data/PokemonTypes.php';

// Setup theme
Hooks::addActions();
Hooks::addFilters();
Assets::load();

// Image sizes
// add_image_size('400x300', 400, 300);
// add_image_size('400x300crop', 400, 300, true);

// Features
// add_theme_support('post-thumbnails');

// Menus
// register_nav_menus([
//   'main-menu' => 'Main Menu',
//   'footer-menu' => 'Footer Menu'
// ]);

// Custom post types and taxonomies
add_action('init', function() {
  $post_type_files = glob(__DIR__ . '/theme/post-types/*.php');
  $taxonomy_files = glob(__DIR__ . '/theme/taxonomies/*.php');

  $files_to_load = array_merge($post_type_files, $taxonomy_files);
  foreach ($files_to_load as $file) {
    require_once $file;
  }
  

  foreach (PokemonTypes::$types as $type) {
    wp_insert_term(
        $type['term'], 
        $type['taxonomy'], 
        [
          'slug' => $type['slug'], 
          'description' => $type['description']
        ]
    );
  }
});

// ACF options pages
if (function_exists('acf_add_options_page')) {
	acf_add_options_page();
  acf_add_options_sub_page('Tracking');
}

// PSR-4 compliant autoloader for classes using "Theme" namespace prefix
// https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader-examples.md
spl_autoload_register(function($class) {
  $prefix = 'Theme\\';
  $base_dir = __DIR__ . '/theme/';

  $len = strlen($prefix);
  if (strncmp($prefix, $class, $len) !== 0) {
    return;
  }

  $relative_class = substr($class, $len);
  $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

  if (file_exists($file)) {
    require $file;
  }
});
