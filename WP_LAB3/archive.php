<?php get_header(); ?>

    <div class="content-area">
        <div class="main-content-sidebar">

            <main class="main-content" id="main">

                <div class="archive-header">
                    <h1>
                        <?php
                        if ( is_category() ) {
                            echo 'Рубрика: ' . single_cat_title( '', false );
                        } elseif ( is_tag() ) {
                            echo 'Метка: ' . single_tag_title( '', false );
                        } elseif ( is_author() ) {
                            echo 'Автор: ' . get_the_author();
                        } elseif ( is_year() ) {
                            echo 'Архив за ' . get_the_date( 'Y' ) . ' год';
                        } elseif ( is_month() ) {
                            echo 'Архив за ' . get_the_date( 'F Y' );
                        } elseif ( is_day() ) {
                            echo 'Архив за ' . get_the_date( 'd.m.Y' );
                        } else {
                            echo 'Архив';
                        }
                        ?>
                    </h1>
                    <?php the_archive_description( '<p>', '</p>' ); ?>
                </div>

                <?php if ( have_posts() ) : ?>

                    <div class="posts-grid">
                        <?php while ( have_posts() ) : the_post(); ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
                            <div class="post-card-body">
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
                                </div>
                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <p><?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?></p>
                                <a href="<?php the_permalink(); ?>" class="read-more">Читать далее &rarr;</a>
                            </div>
                        </article>

                        <?php endwhile; ?>
                    </div>

                    <div class="pagination">
                        <?php echo paginate_links(); ?>
                    </div>

                <?php else : ?>

                    <div class="no-posts">
                        <h2>Записей не найдено</h2>
                        <p>По вашему запросу ничего не найдено.</p>
                    </div>

                <?php endif; ?>

            </main>

            <?php get_sidebar(); ?>

        </div>
    </div>

<?php get_footer(); ?>
