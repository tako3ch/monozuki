<?php
/**
 *
 * @package monozuki
 */
get_header();

?>
<div class="contents-area home-area">
	<main id="main" class="site-main">
		<div class="toppage-cat-wrp">
			<?php
			if ( has_nav_menu( 'top-cat' ) ) {
				wp_nav_menu(array( 'theme_location' => 'top-cat','menu_class' => '','container' => '','walker' => new Walker_Nav_TopPage,'items_wrap' => '%3$s'));
			}else{
				echo '<div class="toppage-cat-area"><h2 class="blogger_ttl"><span>New</span></h2>';
				get_template_part( 'tpl/newslist', 'newslist' );
				echo '</div>';
			}
			wp_reset_query();
			?>



		</div>


	</main><!-- #main -->

</div><!-- #primary -->
<?php
get_footer();
