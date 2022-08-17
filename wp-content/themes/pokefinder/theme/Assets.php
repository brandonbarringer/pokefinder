<?php

final class Assets {
  const ASSET_DIR = '/assets';

  private static $styles = [];
  private static $scripts = [];

  public static function load()
  {
    self::$styles = [
      [
        'handle' => 'main-styles',
        'source' => self::getUrl('styles/main.css', false),
        'enqueue' => true
      ]
    ];

    self::$scripts = [
      [
        'handle' => 'main-script',
        'source' => self::getUrl('scripts/main.js', false),
        'dependencies' => ['jquery'],
        'in_footer' => true,
        'enqueue' => true
      ]
    ];

    add_action('wp_enqueue_scripts', function() {
      self::register();
      self::enqueue();
    });
  }

  public static function getUrl($relativePath, $includeVersion = true)
  {
    $url = get_stylesheet_directory_uri() . self::ASSET_DIR . '/' . $relativePath;
    $queryString = $includeVersion ? '?ver=' . wp_get_theme()->get('Version') : null;
    $hashIndex = strpos($url, '#');

    if ($hashIndex > -1) {
      return substr_replace($url, $queryString, $hashIndex, 0);
    }
    return $url . $queryString;
  }

  public static function register()
  {
    $version = wp_get_theme()->get('Version');

    foreach (self::$styles as $style) {
      wp_register_style(
        $style['handle'],
        $style['source'],
        $style['dependencies'] ?? [],
        $version
      );
    }

    foreach (self::$scripts as $script) {
      wp_register_script(
        $script['handle'],
        $script['source'],
        $script['dependencies'] ?? [],
        $version,
        $script['in_footer'] ?? false
      );
    }
  }

  public static function enqueue()
  {
    foreach (self::$styles as $style) {
      if ($style['enqueue']) {
        wp_enqueue_style($style['handle']);
      }
    }

    foreach (self::$scripts as $script) {
      if ($script['enqueue']) {
        wp_enqueue_script($script['handle']);
      }
    }
  }
}
