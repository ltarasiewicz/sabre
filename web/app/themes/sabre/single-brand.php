<?php
$context = [];
$currentPost = get_the_ID();
$context['page'] = Timber::get_post($currentPost, 'SabrePost');
$brandBannersStr = types_render_field('banner-image', array('separator' => '|'));
$brandBannersArr = preg_split('/\|/', $brandBannersStr);
$brandBanners = [];

foreach($brandBannersArr as $singleBanner) {
    $brandBanners[] = $singleBanner;
}
$context['banners'] = $brandBanners;


Timber::render('single-brand.twig', $context);


