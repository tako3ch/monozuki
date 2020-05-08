<?php
/**
 * cmnt
 * @package monozuki
 */

// cmnt
function mytheme_comments($comment, $args, $depth){
	$GLOBALS['comment'] = $comment;

	if ( 'div' === $args['style'] ) {
	        $tag       = 'div';
	        $add_below = 'comment';
	    } else {
	        $tag       = 'li';
	        $add_below = 'div-comment';
	    }
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comments-wrapper">
			<div class="comments-meta">
				<span><?php echo get_avatar( $comment, $args['avatar_size']) ?></span>
				<ul class="comments-meta-list">
					<li class="comments-date">
						<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
							<?php printf(__('%1$s at %2$s'), get_comment_date(), get_comment_time()) ?></a>
							<span><?php edit_comment_link('（編集する）','','') ?></span>
					</li>
					<li class="comments-author-name">
						<?php printf('<cite class="fn">%s</cite>', get_comment_author_link()) ?>
					</li>
					<li class="comments-title">
						<?php if ($comment->comment_approved == '0') { echo '<span class="comments-approval">このコメントは承認待ちです。</span>';}	?>
					</li>
				</ul>
			</div>
			<!-- comment-meta -->
	<div class="comments-content">
	<?php comment_text() ?>
	</div>
	<div class="comments-reply">
	<?php comment_reply_link(array_merge( $args, array(
	'reply_text'=>'返信する',
	'add_below' =>$add_below,
	'depth' =>$depth,
	'max_depth' =>$args['max_depth'])))
	?>
	</div>
	</div>
	<!-- comment-comment_ID -->
	<?php
	}
