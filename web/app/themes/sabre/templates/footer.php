<?php
$reduxOptions = get_option('sabre_redux');

$address = function() use ($reduxOptions) {
    $arr = [];
    foreach ($reduxOptions as $key => $value) {
        if (preg_match('/(address-1|address-2|primary-email|footer-logo)/', $key)) {
            $arr[$key] = $value;
        }
    }
    return $arr;
};

$context['address'] = $address();
$context['header_image'] = get_header_image();
$context['brands'] = Timber::get_posts(array('post_type' => 'brand', 'posts_per_page' => -1));
$context['helper_pages'] = Timber::get_posts(array('post_type' => 'page', 'post__in' => array(89, 91)));
$context['educators_page'] = new TimberPost(get_page_by_title('Education'));

Timber::render('footer.twig', $context);