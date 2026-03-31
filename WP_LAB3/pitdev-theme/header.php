<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="site-wrapper">

    <header class="site-header">
        <div class="header-inner">
            <div class="site-branding">
                <div>
                    <div class="site-title">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <span>Pit</span>Dev
                        </a>
                    </div>
                    <div class="site-description">
                        <?php bloginfo( 'description' ); ?>
                    </div>
                </div>
            </div>

            <nav class="main-navigation" aria-label="Основное меню">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'fallback_cb'    => function() {
                        echo '<ul>';
                        echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">Главная</a></li>';
                        wp_list_pages( array(
                            'title_li' => '',
                            'depth'    => 1,
                        ) );
                        echo '</ul>';
                    },
                ) );
                ?>
            </nav>
        </div>
    </header>
