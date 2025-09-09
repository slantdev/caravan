<?php

/**
 * Caravan Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Caravan
 */

add_action('wp_enqueue_scripts', 'caravan_enqueue_styles');
function caravan_enqueue_styles()
{
  // Enqueue the parent theme stylesheet
  wp_enqueue_style('hello-elementor-theme-style', get_template_directory_uri() . '/theme.min.css');

  // Enqueue the child theme stylesheet
  // It is dependent on the parent theme's style and will load after it.
  // The version number is set to the file's last modified time for cache-busting.
  wp_enqueue_style(
    'caravan-child-style',
    get_stylesheet_uri(),
    array('hello-elementor-theme-style'),
    filemtime(get_stylesheet_directory() . '/style.css')
  );
}

/**
 * Caravan Child Theme functions and definitions
 *
 * @package Caravan
 */

// Define constants for Vite
define('VITE_SERVER', 'http://localhost:5173');
define('VITE_ENTRY_POINT', 'src/main.js');

// Enqueue Vite assets
add_action('wp_enqueue_scripts', 'caravan_enqueue_vite_assets');
function caravan_enqueue_vite_assets()
{
  $is_vite_dev = is_dev_server_running();
  if ($is_vite_dev) {
    // Enqueue the Vite client for HMR
    wp_enqueue_script('vite-client', VITE_SERVER . '/@vite/client', [], null, true);
    // Enqueue your main entry file from the Vite dev server
    wp_enqueue_script('caravan-main-js', VITE_SERVER . '/' . VITE_ENTRY_POINT, [], null, true);
  } else {
    // Production: load assets from the manifest
    $manifest_path = get_stylesheet_directory() . '/dist/.vite/manifest.json';
    if (file_exists($manifest_path)) {
      $manifest = json_decode(file_get_contents($manifest_path), true);

      // Enqueue the production JS file
      if (isset($manifest[VITE_ENTRY_POINT]['file'])) {
        wp_enqueue_script('caravan-main-js', get_stylesheet_directory_uri() . '/dist/' . $manifest[VITE_ENTRY_POINT]['file'], [], null, true);
      }

      // Enqueue the production CSS file(s)
      if (isset($manifest[VITE_ENTRY_POINT]['css'])) {
        foreach ($manifest[VITE_ENTRY_POINT]['css'] as $css_file) {
          wp_enqueue_style('caravan-main-css', get_stylesheet_directory_uri() . '/dist/' . $css_file);
        }
      }
    }
  }
}

// Helper function to check if the Vite dev server is running
function is_dev_server_running()
{
  $dev_server_url = VITE_SERVER . '/' . VITE_ENTRY_POINT;
  $response = wp_remote_get($dev_server_url, ['timeout' => 1, 'sslverify' => false]);
  return !is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200;
}

// ** ADD THIS FUNCTION TO ADD 'type="module"' to the script tag **
add_filter('script_loader_tag', 'add_type_attribute_to_script', 10, 3);
function add_type_attribute_to_script($tag, $handle, $src)
{
  // Check for your specific script handle
  if ('caravan-main-js' === $handle || 'vite-client' === $handle) {
    // Add the type="module" attribute to the script tag
    $tag = '<script type="module" src="' . esc_url($src) . '" id="' . esc_attr($handle) . '-js"></script>';
  }
  return $tag;
}


/**
 * Wrap printr for Development
 */
function preint_r($array)
{
  echo '<pre>';
  print_r($array);
  echo '</pre>';
}
