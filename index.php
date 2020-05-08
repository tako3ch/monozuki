<?php
/**
 *
 * @package monozuki
 */
get_header();

?>
<div class="contents-area home-area">
	<main id="main" class="site-main">
		<div class="entry-page">
			<?php get_template_part( 'tpl/newslist', 'newslist' );?>
		</div>
	</main><!-- #main -->

</div><!-- #primary -->
<?php
get_footer();
