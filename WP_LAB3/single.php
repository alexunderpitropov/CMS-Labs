<?php get_header(); ?>

    <div class="content-area">
        <div class="main-content-sidebar">

            <main class="main-content" id="main">

                <?php while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post' ); ?>>

                    <div class="post-header">
                        <div class="post-meta">
                            <span class="category">
                                <?php
                                $categories = get_the_category();
                                if ( ! empty( $categories ) ) {
                                    echo esc_html( $categories[0]->name );
                                }
                                ?>
                            </span>
                            <span><?php echo get_the_date( 'd.m.Y' ); ?></span>
                            <span><?php the_author(); ?></span>
                        </div>
                        <h1><?php the_title(); ?></h1>
                    </div>

                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-thumbnail" style="margin-bottom: 25px;">
                            <?php the_post_thumbnail( 'large', array( 'style' => 'width:100%; border-radius:6px;' ) ); ?>
                        </div>
                    <?php endif; ?>

                    <div class="post-content">
                        <?php the_content(); ?>
                    </div>

                    <div class="post-navigation">
                        <?php
                        $prev = get_previous_post();
                        $next = get_next_post();
                        if ( $prev ) {
                            echo '<a href="' . get_permalink( $prev ) . '">&larr; ' . esc_html( get_the_title( $prev ) ) . '</a>';
                        }
                        if ( $next ) {
                            echo '<a href="' . get_permalink( $next ) . '">' . esc_html( get_the_title( $next ) ) . ' &rarr;</a>';
                        }
                        ?>
                    </div>

                </article>

                <?php comments_template(); ?>

                <?php endwhile; ?>

            </main>

            <?php get_sidebar(); ?>

        </div>
    </div>

<?php get_footer(); ?>
