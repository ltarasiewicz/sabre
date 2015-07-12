<?php
$currentPage = get_the_ID();

$context['page'] = Timber::get_post($currentPage, 'SabrePost');

$sabreCategoryId = get_category_by_slug('sabre-corp');

$context['sabre_educators'] = Timber::get_posts(array(
    'post_type' => 'educator',
    'posts_per_page' => -1,
    'category__in' => $sabreCategoryId

), 'SabrePost');

$context['artists_educators'] = Timber::get_posts(array(
    'post_type' => 'educator',
    'posts_per_page' => -1,
    'category__not_in' => $sabreCategoryId

), 'SabrePost');


Timber::render('page-education.twig', $context);