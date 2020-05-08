<?php
/**
 * 404
 *
 * @package monozuki
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="entry-page">
				<article>
					<div class="entry-header">
						<h1>Not Found</h1>
					</div><!-- ./entry-header -->
					<div class="entry-content">
						<p>ページがみつかりませんでした…</p>
					</div><!-- ./entry-content -->

					<div class="breadcrumb">
						<ul class="breadcrumb-list">
							<li class="breadcrumb-item"><a href="<?php echo home_url( '/' );?>">home</a></li>
							<li class="breadcrumb-item">Not Found</li>
						</ul>
					</div><!-- /.breadcrumb -->

				</article><!-- #post-## -->
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
