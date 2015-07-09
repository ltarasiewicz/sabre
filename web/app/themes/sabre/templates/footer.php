<?php
$reduxOptions = get_option('sabre_redux');

$address = function() use ($reduxOptions) {
    $arr = [];
    foreach ($reduxOptions as $key => $value) {
        if (preg_match('/(address-1|address-2)/', $key)) {
            $arr[$key] = $value;
        }
    }
    return $arr;
};

$context['address'] = $address();
$context['header_image'] = get_header_image();
$context['brands'] = Timber::get_posts(array('post_type' => 'brand'));
$context['meet_the_team'] = Timber::get_post(62);
$context['helper_pages'] = Timber::get_posts(array('post_type' => 'page', 'post__in' => array(64, 66)));


Timber::render('footer.twig', $context);