<?php use Roots\Sage\Nav\NavWalker; ?>

<?php
global $query_string;
$hasTitleStrap = ! is_front_page(); // title strap displayed everywhere but on the HP
$site = Timber::get_context();
$context['site'] = $site;
$context['hasTitleStrap'] = $hasTitleStrap;
$context['homePage'] = false;
$context['educators_page'] = new TimberPost(get_page_by_title('Education'));
$context['header_image'] = get_header_image();
$context['brands'] = Timber::get_posts(array('post_type' => 'brand', 'posts_per_page' => -1));
$context['page_title'] = get_the_title();

if (is_front_page()) {
    $context['homePage'] = get_post();
}
Timber::render('header.twig', $context);
