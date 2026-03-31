<?php
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>

        <h2 class="comments-title">
            <?php
            $count = get_comments_number();
            printf(
                _n( '%s комментарий', '%s комментариев', $count, 'pitdev' ),
                number_format_i18n( $count )
            );
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments( array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 42,
                'callback'    => function( $comment, $args, $depth ) {
                    ?>
                    <li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'comment' ); ?>>
                        <div class="comment-author"><?php comment_author(); ?></div>
                        <div class="comment-date"><?php comment_date( 'd.m.Y' ); ?> в <?php comment_time( 'H:i' ); ?></div>
                        <div class="comment-content"><?php comment_text(); ?></div>
                    <?php
                },
            ) );
            ?>
        </ol>

        <?php the_comments_pagination(); ?>

    <?php endif; ?>

    <?php
    if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
        <p>Комментарии закрыты.</p>
    <?php endif; ?>

    <?php
    comment_form( array(
        'title_reply'         => 'Оставить комментарий',
        'label_submit'        => 'Отправить',
        'comment_field'       => '<p><textarea id="comment" name="comment" cols="45" rows="5" placeholder="Ваш комментарий..." required></textarea></p>',
        'fields'              => array(
            'author' => '<p><input type="text" name="author" placeholder="Имя *" required></p>',
            'email'  => '<p><input type="email" name="email" placeholder="Email *" required></p>',
        ),
    ) );
    ?>

</div>
