<?php
/**
 * コメント機能いりますかねえええええ
 *
 *
 *
 * @package monozuki
 */

if ( post_password_required() ) {
	return;
}
?>

<div class="comments-area">
	<?php if (have_comments()) :?>

		<ul class="comments-list">
			<?php wp_list_comments(array(
				'avatar_size'=>48,
				'style'=>'ul',
				'type'=>'comment',
				'callback'=>'mytheme_comments'
			)); ?>
		</ul>
		<?php if (get_comment_pages_count() > 1) : ?>
			<ul class="comments-nav">
				<li class="comments-prev"><?php previous_comments_link('＜＜ 前のコメント'); ?></li>
				<li class="comments-next"><?php next_comments_link('次のコメント ＞＞'); ?></li>
			</ul>
		<?php endif; ?>
	<?php endif; ?>
	<?php
		$comments_args = array(
			'fields' => array(
				'author' => '<p class="comments-form-author">' . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="comments-required">*</span>' : '' ) . '</label>' .'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"></p>',
				'email' => '<p class="comments-form-email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="comments-required">*</span>' : '' ) . '</label> ' .'<input id="email" name="email" type="email"' . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '"></p>'
			),
			'title_reply' => 'Comment',
			'comment_notes_before' => '<p class="comments-notes">メールアドレスは公開されませんのでご安心ください。また、<span class="comments-required">*</span> が付いている欄は必須項目となります。</p>',
			'label_submit' => '送信する',
		);
		comment_form($comments_args);
	?>
</div>
