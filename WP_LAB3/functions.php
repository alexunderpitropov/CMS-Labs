<?php
/**
 * PitDev Theme Functions
 */

// Подключение стилей темы
function pitdev_enqueue_styles() {
    wp_enqueue_style(
        'pitdev-style',
        get_stylesheet_uri(),
        array(),
        '1.0.0'
    );
}
add_action( 'wp_enqueue_scripts', 'pitdev_enqueue_styles' );

// Поддержка функций темы
function pitdev_setup() {
    // Поддержка тегов заголовков
    add_theme_support( 'title-tag' );

    // Поддержка миниатюр записей
    add_theme_support( 'post-thumbnails' );

    // Регистрация меню навигации
    register_nav_menus( array(
        'primary' => __( 'Основное меню', 'pitdev' ),
        'footer'  => __( 'Меню подвала', 'pitdev' ),
    ) );

    // Поддержка HTML5
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );
}
add_action( 'after_setup_theme', 'pitdev_setup' );

// Регистрация боковой панели
function pitdev_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Боковая панель', 'pitdev' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Добавьте виджеты здесь', 'pitdev' ),
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Подвал 1', 'pitdev' ),
        'id'            => 'footer-1',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Подвал 2', 'pitdev' ),
        'id'            => 'footer-2',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'pitdev_widgets_init' );
