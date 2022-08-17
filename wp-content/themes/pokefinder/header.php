<!DOCTYPE html>
<html <?php echo get_language_attributes(); ?>>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title(''); ?></title>
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo Assets::getUrl('images/apple-touch-icon.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo Assets::getUrl('images/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo Assets::getUrl('images/favicon-16x16.png') ?>">
    <?php echo get_field('tracking_head', 'option'); ?>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <?php echo get_field('tracking_body_start', 'options'); ?>
