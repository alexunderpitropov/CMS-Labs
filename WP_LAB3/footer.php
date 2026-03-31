    <footer class="site-footer">
        <div class="footer-inner">
            <div class="footer-top">
                <div class="footer-widget">
                    <h3>О сайте</h3>
                    <p><?php bloginfo( 'name' ); ?> — <?php bloginfo( 'description' ); ?>. Следите за последними новостями мира Формулы 1.</p>
                </div>

                <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
                    <?php dynamic_sidebar( 'footer-1' ); ?>
                <?php else : ?>
                <div class="footer-widget">
                    <h3>Навигация</h3>
                    <ul>
                        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a></li>
                        <?php wp_list_pages( array( 'title_li' => '', 'depth' => 1 ) ); ?>
                    </ul>
                </div>
                <?php endif; ?>

                <?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
                    <?php dynamic_sidebar( 'footer-2' ); ?>
                <?php else : ?>
                <div class="footer-widget">
                    <h3>Контакты</h3>
                    <p>Университет: USM, Факультет Математики и Информатики</p>
                    <p>Автор: Питропов Александр</p>
                    <p>Группа: I2302</p>
                </div>
                <?php endif; ?>
            </div>

            <div class="footer-bottom">
                <p>
                    &copy; <?php echo date( 'Y' ); ?>
                    <span><?php bloginfo( 'name' ); ?></span> —
                    <?php bloginfo( 'description' ); ?> |
                    Разработано в рамках курса CMS, USM
                </p>
            </div>
        </div>
    </footer>

</div><!-- .site-wrapper -->

<?php wp_footer(); ?>
</body>
</html>
