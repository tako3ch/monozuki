<?php
$post_id = get_the_ID();
$thumbnail_id = get_post_thumbnail_id($post_id);
$thumbnail = wp_get_attachment_image_src( $thumbnail_id , 'full' );
$thumbnail_alt = '';
if (!empty($thumbnail)) {
	$thumbnail = $thumbnail[0];
	$thumbnail_alt = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true );
}else{
	$thumbnail = get_template_directory_uri().'/common/img/ogp.png';
}

$category = get_the_category();
if ($category) {
	$cat_name = $category[0]->cat_name;
}
?>

<div class="entry-item">
	<a class="entry-item__link" href="<?php the_permalink(); ?>">
		<div class="entry-item__bg">
			<img src="<?=$thumbnail;?>" alt="<?=$thumbnail_alt;?>" loading="lazy">
		</div>
		<div class="entry-item-btm">
			<div class="entry-item-btm-meta">
				<time class="entry-item__day" datetime="<?php the_time('Y-m-d'); ?>T<?php the_time('H:i:sP'); ?>"><?php the_time("Y.m.d"); ?></time>
				<span class="entry-item__cat"><?=$cat_name;?></span>
			</div>
			<p class="entry-item__ttl"><?php the_title(); ?></p>
		</div>
	</a>
</div>