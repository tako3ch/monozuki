<?php
/**
 * archives
 *
 *
 * @package monozuki
 */

get_header();
?>
	<div class="contents-area">
		<main id="main" class="site-main">
			<div class="entry-page">
				<div class="entry-header">
					<h1 class="blogger_ttl"><span><?php if ( is_category() ) { $title = single_cat_title( '', false ); }
					elseif ( is_tag() ) { $title = single_tag_title( '', false ); }
					else { $title = get_the_archive_title(); }
					echo $title;?></span></h1>
					<?php
					if ( is_category() ) {
						$desc = category_description();
					} elseif ( is_tag() ) {
						if (tag_description()) {
							$desc = tag_description();
						} elseif ( is_tax() ) {
							$tax_slug = get_query_var('taxonomy');
							$term_slug = get_query_var('term');
							$term = get_term_by("slug",$term_slug,$tax_slug);
							$desc = $term->description;
						}
					}
					if ($desc != '') {
						echo $desc;
					}
					?>
				</div><!-- ./entry-header -->
				<?php get_template_part( 'tpl/newslist', 'newslist' );?>

				<div class="breadcrumb">
					<ul class="breadcrumb-list">
						<li class="breadcrumb-item"><a href="<?php echo home_url( '/' );?>">Home</a></li>
						<li class="breadcrumb-item"><?=$title;?></li>
					</ul>
				</div><!-- /.breadcrumb -->
			</div>
		</main><!-- #main -->
	</div><!-- #wrapper -->
<?php
get_footer();
