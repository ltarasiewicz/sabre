<?php
/*
 * Template Name: Homepage
 */
$context = [];
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

preg_match('/embed\/(.+)$/', $context['video']['video-1-src'], $videoOneId);
preg_match('/embed\/(.+)$/', $context['video']['video-2-src'], $videoTwoId);
preg_match('/embed\/(.+)$/', $context['video']['video-3-src'], $videoThreeId);

$context['video_1_id'] = $videoOneId[1];
$context['video_2_id'] = $videoTwoId[1];
$context['video_3_id'] = $videoThreeId[1];


$context['about_page'] = new TimberPost(get_page_by_title('About'));
$context['education_page'] = new TimberPost(get_page_by_title('Education'));
$context['brands'] = Timber::get_posts(array('post_type' => 'brand'));

$context['homePage'] = Timber::get_post(get_page_by_title('Homepage'), 'SabrePost');

Timber::render('front-page.twig', $context);
