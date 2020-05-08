<?php
	$url_encode=urlencode(get_the_permalink());
	$title_encode=urlencode(get_the_title());
	$blogname = urlencode(get_bloginfo('name'));

	$tw_id = '';
	$tw_id = get_the_author_meta('twitter');
	if ($tw_id != '') {
		$tw_via = '&amp;via='.$tw_id;
	}
?>
<div class="sharebtn">
	<ul class="sharebtn-list">
		<li><a class="sharebtn-item--fb" href="http://www.facebook.com/share.php?u=<?php echo $url_encode;?>" rel="nofollow" target="_blank"><i class="icon-facebook"></i></a></li>
		<li><a class="sharebtn-item--tw" href="http://twitter.com/intent/tweet?text=<?php echo $title_encode; echo urlencode(' | '); echo $blogname;?>&amp;<?php echo urlencode(get_permalink()); ?>&amp;url=<?php echo urlencode(get_permalink()); ?>&tw_p=tweetbutton<?php echo $tw_via;?>" rel="nofollow" target="_blank" title="Twitterで共有"><i class="icon-twitter"></i></a></li>
		<li><a class="sharebtn-item--pkt" href="http://getpocket.com/edit?url=<?php echo $url_encode;?>&title=<?php echo $title_encode;?>" rel="nofollow" rel="nofollow" target="_blank"><i class="icon-get-pocket"></i></a></li>
		<li><a class="sharebtn-item--htn" href="http://b.hatena.ne.jp/add?mode=confirm&url=<?php echo $url_encode;?>&title=<?php echo $title_encode;?>" target="_blank" rel="nofollow">B!</a></li>
	</ul>
</div><!-- ./sharebtn -->
