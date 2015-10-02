<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Config;

/**
 * Include the redux framework
 */
require_once (dirname(__FILE__) . '/redux/sample/barebones-config-legacy.php');

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Config\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }


  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');


function sabreSortMenuItems($template, $myArray, &$ordered)
{
    foreach($myArray as $k => $v) {
        if (strtolower($myArray[$k]->name) == strtolower($template[0])) {
            $ordered[] = $myArray[$k];
            array_splice($template, 0, 1);
        }
    }
    if (!empty($template)) sabreSortMenuItems($template, $myArray, $ordered);
}