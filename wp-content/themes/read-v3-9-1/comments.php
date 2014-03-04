<?php
	// If the current post is protected by a password and the visitor has not yet entered the password we will return early without loading the comments.
	if ( post_password_required() )
	{
		return;
	}
?>

<div id="comments" class="comments-area">
	<?php
		if ( have_comments() ) :
			?>
				<h2 class="comments-title">
					<?php
						printf( _n( '1 Comment %2$s', '%1$s Comments %2$s', get_comments_number(), 'read' ),
								number_format_i18n( get_comments_number() ),
								'<span class="on">&#8594;</span> <span>' . get_the_title() . '</span>' );
					?>
				</h2>
				<!-- end .comments-title -->
				
				<ol class="commentlist">
					<?php
						wp_list_comments( array('callback' => 'theme_comments',
												'style' => 'ol' ) );
					?>
				</ol>
				<!-- end .commentlist -->
				
				<?php
					// are there comments to navigate through
					if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
						?>
							<nav id="comment-nav-below" class="navigation" role="navigation">
								<h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'read' ); ?></h1>
								
								<div class="nav-previous">
									<?php
										previous_comments_link( __( '&larr; Older Comments', 'read' ) );
									?>
								</div>
								<!-- end .nav-previous -->
								
								<div class="nav-next">
									<?php
										next_comments_link( __( 'Newer Comments &rarr;', 'read' ) );
									?>
								</div>
								<!-- end .nav-next -->
							</nav>
							<!-- end #comment-nav-below -->
						<?php
					endif;
					// end Check for comment navigation
				?>
				
				<?php
					if ( ! comments_open() && get_comments_number() ) :
						?>
							<p class="nocomments"><?php _e( 'Comments are closed.' , 'read' ); ?></p>
						<?php
					endif;
				?>
			<?php
		endif;
	?>
	
	<?php
		$commenter = wp_get_current_commenter();
		$require_name_email = get_option( 'require_name_email' );
		$aria_required = ( $require_name_email ? " aria-required='true'" : '' );
		$fields   =  array(
			'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'read' ) . ( $require_name_email ? ' <span class="required">*</span>' : '' ) . '</label> ' .
						'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_required . ' /></p>',
			'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'read' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
						'<input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_required . ' /></p>',
			'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website', 'read' ) . '</label> ' .
						'<input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
		);

		comment_form( array(
			'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
			'comment_field'	       =>
				'<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'read' ) .
            	'</label> <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
			'title_reply'          => __( 'Leave a Reply', 'read' ),
			'title_reply_to'       => __( 'Leave a Reply to %s', 'read' ),
			'label_submit'         => __( 'Post Comment', 'read' ),
			'cancel_reply_link'    => __( 'Cancel Reply', 'read' ),
			'comment_notes_before' =>
				'<p class="comment-notes">' .
				__( 'Your email address will not be published.', 'read' ) .
				sprintf( ' ' . __('Required fields are marked %s', 'read'), '<span class="required">*</span>' ) . '</p>',
			'comment_notes_after'  =>
				'<p class="form-allowed-tags">' .
				sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'read' ),
						 ' <code>' . allowed_tags() . '</code>' ) . '</p>'
		) );
	?>
</div>
<!-- end #comments -->