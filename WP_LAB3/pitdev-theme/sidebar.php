<aside class="sidebar" id="secondary">

    <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>

        <?php dynamic_sidebar( 'sidebar-1' ); ?>

    <?php else : ?>

        <div class="widget">
            <h3 class="widget-title">Свежие записи</h3>
            <ul>
                <?php
                $recent = new WP_Query( array( 'posts_per_page' => 5 ) );
                while ( $recent->have_posts() ) :
                    $recent->the_post();
                ?>
                <li>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    <br><small><?php echo get_the_date( 'd.m.Y' ); ?></small>
                </li>
                <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </ul>
        </div>

        <div class="widget">
            <h3 class="widget-title">Рубрики</h3>
            <ul>
                <?php wp_list_categories( array( 'title_li' => '', 'show_count' => true ) ); ?>
            </ul>
        </div>

        <div class="widget">
            <h3 class="widget-title">О сайте</h3>
            <p><?php bloginfo( 'name' ); ?> — ваш источник новостей мира Формулы 1. Гонки, команды, пилоты.</p>
        </div>

    <?php endif; ?>

</aside>
