<?php get_header(); ?>

    <div class="content-area">
        <div class="main-content-sidebar">

            <main class="main-content" id="main">

                <?php while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class( 'page-content' ); ?>>

                    <h1><?php the_title(); ?></h1>

                    <?php if ( has_post_thumbnail() ) : ?>
                        <div style="margin-bottom: 25px;">
                            <?php the_post_thumbnail( 'large', array( 'style' => 'width:100%; border-radius:6px;' ) ); ?>
                        </div>
                    <?php endif; ?>

                    <div class="post-content">
                        <?php the_content(); ?>
                    </div>

                </article>

                <?php comments_template(); ?>

                <?php endwhile; ?>

            </main>

            <?php get_sidebar(); ?>

        </div>
    </div>

<?php get_footer(); ?>
