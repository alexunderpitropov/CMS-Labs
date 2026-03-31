<?php get_header(); ?>

    <div class="hero-banner">
        <div class="container">
            <h1><span>Pit</span>Dev</h1>
            <p><?php bloginfo( 'description' ); ?></p>
        </div>
    </div>

    <div class="content-area">
        <div class="main-content-sidebar">

            <main class="main-content" id="main">

                <?php if ( have_posts() ) : ?>

                    <div class="posts-grid">
                        <?php
                        $args = array(
                            'posts_per_page' => 5,
                        );
                        $latest_posts = new WP_Query( $args );

                        while ( $latest_posts->have_posts() ) :
                            $latest_posts->the_post();
                        ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
                            <div class="post-card-body">
                                <div class="post-meta">
                                    <span class="category">
                                        <?php
                                        $categories = get_the_category();
                                        if ( ! empty( $categories ) ) {
                                            echo esc_html( $categories[0]->name );
                                        } else {
                                            echo 'Новости';
                                        }
                                        ?>
                                    </span>
                                    <span><?php echo get_the_date( 'd.m.Y' ); ?></span>
                                    <span><?php the_author(); ?></span>
                                </div>

                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                                <p><?php echo wp_trim_words( get_the_excerpt(), 25, '...' ); ?></p>

                                <a href="<?php the_permalink(); ?>" class="read-more">Читать далее &rarr;</a>
                            </div>
                        </article>

                        <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>

                    <div class="pagination">
                        <?php
                        echo paginate_links( array(
                            'prev_text' => '&laquo;',
                            'next_text' => '&raquo;',
                        ) );
                        ?>
                    </div>

                <?php else : ?>

                    <div class="no-posts">
                        <h2>Записей пока нет</h2>
                        <p>Скоро здесь появятся новости мира Формулы 1.</p>
                    </div>

                <?php endif; ?>

            </main>

            <?php get_sidebar(); ?>

        </div>
    </div>

<?php get_footer(); ?>
