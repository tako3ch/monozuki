<?php
/**
 *
 * @package monozuki
 */
get_header();

?>
	<div class="contents-area page-area">
		<main id="main" class="site-main">
			<div class="entry-page">
				<?php while ( have_posts() ) : the_post(); $post_id = get_the_ID();?>
					<article id="post-<?php the_ID(); ?>">
						<div class="entry-header">
							<h1><?php the_title(); ?></h1>
						</div><!-- ./entry-header -->
						<div class="entry-content">
							<?php the_content(); ?>
						</div><!-- ./entry-content -->
						<?php get_template_part( 'tpl/sharebtn', 'sharebtn' );?>
						<div class="breadcrumb">
							<ul class="breadcrumb-list">
								<li class="breadcrumb-item"><a href="<?php echo home_url( '/' );?>">Home</a></li>
								<li class="breadcrumb-item"><?php the_title(); ?></li>
							</ul>
						</div><!-- /.breadcrumb -->
					</article><!-- #post-## -->
				<?php endwhile; ?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
