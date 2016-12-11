<?php

use Roots\Sage\Extras;

global $query_string;
$hasTitleStrap = ! is_front_page(); // title strap displayed everywhere but on the HP
$site = Timber::get_context();
$context['site'] = $site;
$context['home_url'] = get_home_url();
$context['hasTitleStrap'] = $hasTitleStrap;
$context['homePage'] = false;
$context['educators_page'] = new TimberPost(get_page_by_title('Education'));
$context['education_programs'] = new TimberPost(get_page_by_title('Education Programs'));
$context['header_image'] = get_header_image();
$context['page_title'] = get_the_title();

$auMenuItems = Timber::get_posts(array(
                            'post_type' => 'brand',
                            'posts_per_page' => -1,
                            'category_name' => 'australia'
                        ), 'SabrePost');
$nzMenuItems = Timber::get_posts(array(
    'post_type' => 'brand',
    'posts_per_page' => -1,
    'category_name' => 'new-zeland'
), 'SabrePost');

if (is_front_page()) {
    $context['homePage'] = get_post();
}

$context['brands_australia'] = $auMenuItems;
$context['brands_new_zeland'] = $nzMenuItems;

Timber::render('header.twig', $context);
