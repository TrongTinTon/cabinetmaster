<?php if ( have_posts() ) : ?>
<div id="post-list">

<?php /* Start the Loop */ ?>
<?php 
echo '<h1 class="blog-header-wrapper"><span>' . get_theme_mod( 'blog_header' ) . '</span></h1>';
while ( have_posts() ) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="article-inner <?php flatsome_blog_article_classes(); ?>">

		<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
		<div class="entry-image-float">
	 		<?php get_template_part( 'template-parts/posts/partials/entry-image', 'default'); ?>
			<?php if ( get_theme_mod( 'blog_badge', 1 ) ) get_template_part( 'template-parts/posts/partials/entry', 'post-date' ); ?>
	 	</div>
 		<?php } ?>
		<?php get_template_part('template-parts/posts/content', 'default' ); ?>
		<div class="clearfix"></div>
		<?php get_template_part('template-parts/posts/partials/entry-footer', 'default' ); ?>
	</div>
</article>

<?php endwhile; ?>

<?php flatsome_posts_pagination(); ?>

</div>

<?php else : ?>

	<?php get_template_part( 'template-parts/posts/content','none'); ?>

<?php endif; ?>
