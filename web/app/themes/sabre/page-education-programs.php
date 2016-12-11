<?php
/*
 * Template Name: Education Programs
 */
$currentPage = get_the_ID();

$context['page'] = Timber::get_post($currentPage, 'SabrePost');


$postcodes = Timber::get_terms('postcode');


foreach($postcodes as $postcode) {
    $context['workshops'][$postcode->name] = Timber::get_posts(array(
        'post_type' => 'workshop',
        'posts_per_page' => -1,
        'tax_query' => [
            'taxonomy' => 'postcode',
            'field' => 'term_id',
            'terms' => $postcodes[0]->id,

        ],
        'orderby' => 'meta_value_num',
        'meta_key' => 'wpcf-workshop-date',
    ), 'SabrePost');
}

Timber::render('page-education-programs.twig', $context);
