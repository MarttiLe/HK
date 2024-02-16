<?php

// Don't load it if you can't comment
if ( post_password_required() ) {
	return;
}

?>

<div class="comments">

	<?php if ( have_comments() ) : ?>

		<h3 class="comments__title"><?= __('Comments', 'hiiukala-theme') ?> <span class="comments__amount">(<?= get_comments_number() ?>)</span></h3>

		<div class="comments__list">
			<?php
				wp_list_comments(array(
				'style'             => 'li',
				//'callback'          => '',
				'type'              => 'comment',
				'reply_text'        => __('Reply', 'hiiukala-theme'),
				'page'              => '',
				'per_page'          => '',
				'reverse_top_level' => true,
				'reverse_children'  => false
			) );
			?>
		</div>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav class="comments__pagination comments-pagination">
			<div class="comments-pagination__prev"><?php previous_comments_link( __( '&larr; Previous Comments', 'hiiukala-theme' ) ); ?></div>
			<div class="comments-pagination__next"><?php next_comments_link( __( 'More Comments &rarr;', 'hiiukala-theme' ) ); ?></div>
			</nav>
		<?php endif; ?>

		<?php if ( ! comments_open() ) : ?>
			<p class="comments__closed"><?= __( 'Comments are closed.' , 'hiiukala-theme' ) ?></p>
		<?php endif; ?>

	<?php endif; ?>

	<?php
		comment_form(array(
			'logged_in_as'	=> '',
			'title_reply'	=> __( 'Ask a question' , 'hiiukala-theme' ),
			'label_submit'	=> __( 'Submit' , 'hiiukala-theme' ),
			'class_submit'	=> 'button'
		));
	?>

</div>