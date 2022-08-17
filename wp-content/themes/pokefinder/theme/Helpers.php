<?php

final class Helpers {
  public static function renderPartial($partial, $args = [])
  {
    $file = 'partials/' . $partial . '.php';
    locate_template($file, true, false, $args);
  }

  public static function isElementor($id = null)
  {
    if (class_exists('\Elementor\Plugin')) {
      if (is_admin()) {
        return \Elementor\Plugin::$instance->editor->is_edit_mode();
      } else {
        return \Elementor\Plugin::$instance->db->is_built_with_elementor($id ?: get_queried_object_id());
      }
    }
    return false;
  }

  public static function getSizedImage($image_id, $size, $default = null)
  {
    if (!$image_id) {
      return $default;
    }

    $sized_url = wp_get_attachment_image_src($image_id, $size);
    return !empty($sized_url[0]) ? $sized_url[0] : $default;
  }

  public static function getImageAlt($image_id)
  {
    if (!$image_id) {
      return;
    }

    return esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true));
  }

  public static function getAcfLinkAttributes($link_array)
  {
    if (!is_array($link_array)) {
      return;
    }

    $link_url = $link_array['url'] ?? '';
    $link_target = $link_array['target'] ?? '';
    $attrs = [];

    if ($link_url) {
      $attrs[] = 'href="' . esc_url($link_url) . '"';
    }

    if ($link_target) {
      $attrs[] = 'target="' . esc_url($link_target) . '"';
    }

    return implode(' ', $attrs);
  }

  public static function getElementorLinkAttributes(array $link_array)
  {
    $link_href = $link_array['url'];
    $link_target = $link_array['is_external'] ? '_blank' : '';
    $link_ref = $link_array['nofollow'] ? 'nofollow' : '';
    $custom_attrs = [];
    $attrs = [];

    if (class_exists('\Elementor\Utils')) {
      $custom_attrs = \Elementor\Utils::parse_custom_attributes($link_array['custom_attributes']);

      foreach ($custom_attrs as $custom_attr => $custom_attr_value) {
        $attrs[] = $custom_attr . '="' . esc_attr($custom_attr_value) . '"';
      }
    }

    if ($link_href) {
      $attrs[] = 'href="' . $link_href . '"';
    }

    if ($link_target) {
      $attrs[] = 'target="' . $link_target . '"';
    }

    if ($link_ref) {
      $attrs[] = 'ref="' . $link_ref . '"';
    }

    return implode(' ', $attrs);
  }
}
