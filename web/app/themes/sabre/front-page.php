<?php
/*
 * Template Name: Homepage
 */

$reduxOptions = get_option('sabre_redux');
$video = function() use ($reduxOptions) {
    $arr = [];
    foreach ($reduxOptions as $key => $value) {
        if (preg_match('/(video-1|video-2|video-3)/', $key)) {
            $arr[$key] = $value;
        }
    }
    return $arr;
};

$context['video'] = $video();
$context['about_page'] = new TimberPost(get_page_by_title('About'));
$context['education_page'] = new TimberPost(get_page_by_title('Education'));
$context['brands'] = Timber::get_posts(array('post_type' => 'brand'));
$context['homePage'] = new TimberPost(get_post(get_page_by_title('Homepage')));
Timber::render('front-page.twig', $context);
