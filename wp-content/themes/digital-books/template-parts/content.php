<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Digital Books
 */

$digital_books_post_page_title =  get_theme_mod( 'digital_books_post_page_title', 1 );
$digital_books_post_page_meta =  get_theme_mod( 'digital_books_post_page_meta', 1 );
$digital_books_post_page_thumb = get_theme_mod( 'digital_books_post_page_thumb', 1 );
$digital_books_post_page_cat = get_theme_mod( 'digital_books_post_page_cat', 1 );
$digital_books_post_page_content =  get_theme_mod( 'digital_books_post_page_content', 1 );
?>

<div class="col-lg-6 col-md-6 col-sm-6">
    <article id="post-<?php the_ID(); ?>" <?php post_class('article-box'); ?>>
        <header class="entry-header">
            <?php if ($digital_books_post_page_title == 1 ) {?>
                <?php the_title('<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>');?>
                <hr>
            <?php }?> 
            <?php if ('post' === get_post_type()) : ?>
                <?php if ($digital_books_post_page_meta == 1 ) {?>
                    <div class="entry-meta">
                        <?php
                        digital_books_posted_on();
                        ?>
                    </div>
                <?php }?>
            <?php endif; ?>
        </header>
        <?php if ($digital_books_post_page_thumb == 1 ) {?>
            <?php if(has_post_thumbnail()){
            the_post_thumbnail();
            } else{?>
            <div class="post-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/slider.png" alt="" /></div>
          <?php } ?>
        <?php }?> 
        <?php if ($digital_books_post_page_content == 1 ) {?>
            <div class="entry-summary">
                <?php
                    the_excerpt();

                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'digital-books'),
                        'after' => '</div>',
                    ));
                ?>
            </div>
        <?php }?>
        <?php if ($digital_books_post_page_cat == 1 ) {?>
            <footer class="entry-footer">
                <?php digital_books_entry_footer(); ?>
            </footer>
        <?php }?> 
    </article>
</div>