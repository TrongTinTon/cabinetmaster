<div class="entry-content">
	<?php if ( flatsome_option('blog_show_excerpt') || is_search())  { ?>
	<div class="entry-summary">
		<header class="entry-header">
		  	<div class="entry-header-text text-<?php echo get_theme_mod( 'blog_posts_title_align', 'center' );?>">
				   	<?php get_template_part( 'template-parts/posts/partials/entry', 'title');  ?>
			</div>
		</header>
		<?php the_excerpt(); ?>
		<div class="text-<?php echo get_theme_mod( 'blog_posts_title_align', 'center' );?>">
			<a class="more-link button primary is-outline is-smaller" href="<?php echo get_the_permalink(); ?>"><?php _e('Đọc tiếp <span class="meta-nav">&rarr;</span>', 'flatsome'); ?></a>
		</div>
	</div>
	<?php } else { ?>
	<?php the_content( __( 'Đọc tiếp <span class="meta-nav">&rarr;</span>', 'flatsome' ) ); ?>
	<?php
		wp_link_pages();
	?>
<?php }; ?>

</div>