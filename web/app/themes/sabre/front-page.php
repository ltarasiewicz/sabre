<?php
    $context = [];
    $context['about_page'] = new TimberPost(get_page_by_title('About'));
    $context['education_page'] = new TimberPost(get_page_by_title('Education'));
    $context['brands'] = Timber::get_posts(array('post_type' => 'brand'));
    $context['homePage'] = new TimberPost(get_post(get_page_by_title('Homepage')));
    Timber::render('front-page.twig', $context);
