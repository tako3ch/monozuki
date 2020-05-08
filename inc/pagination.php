<?php
/**
 * ページネーション
 * @package monozuki
 */

// ページネーション
function get_pagination($len = 3,$param = ""){
	$len2 = intval($len/2);
	global $wp_query;
	global $original_query;
	if(!empty($original_query)){
		$the_query = $original_query;
	}else{
		$the_query = $wp_query;
	}
	$paged = get_query_var('paged');
	$now = $paged;// 現在のページ
	$max = $the_query->max_num_pages;// 総ページ数

	if( empty($now) ){ $now = 1;}
	if( empty($max) ){ $max = 1;}
	if( $max > 1 ){
		$after = 0;
		$before = 0;
		$start = $now - $len2;
		$end = $now + $len2;
		if( $start < 1 ){ $after = 1 - $start;}
		if( $end > $max ){ $before = $end - $max;}

		echo '<nav class="pagination">';
		// 前へナビ
		echo '<div class="pagination-btn-wrp">';
		if($now > 1){
			echo '<a class="pagination-btn pagination-btn--prev" href="'.get_pagenum_link($now-1).$param.'"><i class="icon-keyboard_arrow_left"></i></a>';
		}
		echo '</div>';

		echo '<ul class="pagination-list">';
		// if( $now-$len2-$before > 1 ){ print('<li class="pagination-list__item"><a href="'.get_pagenum_link(1).$param.'" class="pagination_link">1</a></li><li class="pagination-list__item">...</li>');}
		for($i=1; $i<$max+1; $i++){
			if( $start-$before <= $i && $i <= $end+$after ){
				if( $i == $now ){
					echo '<li class="pagination-list__item pagination-list__item--active"><a class="pagination__link" href="'.get_pagenum_link($i).$param.'">'.$i.'</a></li>';
				} else {
					echo '<li class="pagination-list__item"><a class="pagination__link" href="'.get_pagenum_link($i).$param.'">'.$i.'</a></li>';
				}
			}
		}
		// if( $now+$len2+$after < $max ){ print('<li class="pagination-list__item">...</li><li class="pagination-list__item"><a href="'.get_pagenum_link($max).$param.'">'.$max.'</a></li>');}
		echo '</ul>';

		// 次へナビ
		echo '<div class="pagination-btn-wrp">';
		if($now < $max){
			echo '<a class="pagination-btn pagination-btn--next" href="'.get_pagenum_link($now+1).$param.'"><i class="icon-keyboard_arrow_right"></i></a>';
		}
		echo '</div>';
		echo '</nav>';
	}
}
