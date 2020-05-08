<?php
wp_reset_query();

?>
<div class="entry-list">
	<?php
	if (have_posts()) : while (have_posts()) : the_post();

	include locate_template( 'tpl/newslist-item.php' );

	endwhile;?>
</div>
<?php
if( is_home() || is_front_page() ) {
	$paging_chk = get_option('hakushi_home_paging_set');
	if ($paging_chk != true) { get_pagination(); }
}else{
	get_pagination();
}
endif;
wp_reset_query();
?>