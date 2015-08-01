<?php

namespace Roots\Sage\Assets;

/**
 * Scripts and stylesheets
 *
 * Enqueue stylesheets in the following order:
 * 1. /theme/dist/styles/main.css
 *
 * Enqueue scripts in the following order:
 * 1. /theme/dist/scripts/modernizr.js
 * 2. /theme/dist/scripts/main.js
 */

class JsonManifest
{
    private $manifest;

    public function __construct($manifest_path)
    {
        if (file_exists($manifest_path)) {
            $this->manifest = json_decode(file_get_contents($manifest_path), true);
        } else {
            $this->manifest = [];
        }
    }

    public function get()
    {
        return $this->manifest;
    }

    public function getPath($key = '', $default = null)
    {
        $collection = $this->manifest;
        if (is_null($key)) {
            return $collection;
        }
        if (isset($collection[$key])) {
            return $collection[$key];
        }
        foreach (explode('.', $key) as $segment) {
            if (!isset($collection[$segment])) {
                return $default;
            } else {
                $collection = $collection[$segment];
            }
        }
        return $collection;
    }
}

function asset_path($filename)
{
    $dist_path = get_template_directory_uri() . DIST_DIR;
    $directory = dirname($filename) . '/';
    $file = basename($filename);
    static $manifest;

    if (empty($manifest)) {
        $manifest_path = get_template_directory() . DIST_DIR . 'assets.json';
        $manifest = new JsonManifest($manifest_path);
    }

    if (array_key_exists($file, $manifest->get())) {
        return $dist_path . $directory . $manifest->get()[$file];
    } else {
        return $dist_path . $directory . $file;
    }
}

function assets()
{
    wp_enqueue_style('sage_css', asset_path('styles/main.css'), false, null);
    wp_enqueue_style('lightbox_css', asset_path('styles/lightbox.css'), false, null);
    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    if (is_singular( 'brand' )) {
        wp_enqueue_script('brands_flexslider_js', asset_path('scripts/jquery.flexslider.js'), ['jquery'], null, true);
        wp_enqueue_style('flexslider_css', asset_path('styles/flexslider.css'), false, null);
        wp_enqueue_style('single_brand_slider_css', asset_path('styles/single-brand-sliders.css'), ['flexslider_css'], null);
    }

    wp_enqueue_script('modernizr', asset_path('scripts/modernizr.js'), [], null, true);
    wp_enqueue_script('sage_js', asset_path('scripts/main.js'), ['jquery', 'lightbox2'], null, true);
    wp_enqueue_script('lightbox2', asset_path('scripts/lightbox2.js'), ['jquery'], null, true);

}

add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);
