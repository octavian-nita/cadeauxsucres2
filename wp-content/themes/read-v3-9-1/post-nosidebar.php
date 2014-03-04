<?php
	get_header();
?>

<div id="primary" class="site-content">
	<div id="content" role="main">
		<div class="readable-content blog-single">
			<?php
				if ( have_posts() ) :
					while ( have_posts() ) : the_post();
						?>
							<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>
								<header class="entry-header">
									<?php
										$hide_post_title = get_option( $post->ID . 'hide_post_title', false );
										
										if ( $hide_post_title )
										{
											$hide_post_title_out = 'style="display: none;"';
										}
										else
										{
											$hide_post_title_out = "";
										}
									?>
									<h1 class="entry-title" <?php echo $hide_post_title_out; ?>><?php the_title(); ?></h1>
								</header>
								<!-- end .entry-header -->
								
								<div class="entry-meta">
									<span class="post-date">
										<a rel="bookmark" title="<?php the_time(); ?>" href="<?php the_permalink(); ?>"><time class="entry-date" datetime="2012-11-09T23:15:57+00:00"><?php echo get_the_date(); ?></time></a>
									</span>
									<!-- end .post-date -->
									
									<?php
										$post_share_links_single = get_option( 'post_share_links_single', 'Yes' );
										
										if ( $post_share_links_single == 'Yes' )
										{
											get_template_part( 'part', 'share' );
										}
									?>
									
									<?php
										edit_post_link( __( 'Edit', 'read' ), '<span class="edit-link" style="margin-top: 8px;">', '</span>' );
									?>
								</div>
								<!-- end .entry-meta -->
								
								<?php
									if ( has_post_thumbnail() )
									{
										?>
											<div class="featured-image">
												<?php
													the_post_thumbnail( 'full', array( 'alt' => get_the_title(), 'title' => "" ) );
												?>
											</div>
											<!-- end .featured-image -->
										<?php
									}
									// end if
								?>
								
								<div class="entry-content clearfix">
									<?php
										the_content();
									?>
									
									<?php
										wp_link_pages( array( 'before' => '<div class="page-links clearfix">' . __( 'Pages:', 'read' ), 'after' => '</div>' ) );
									?>
								</div>
								<!-- end .entry-content -->
								
								<?php
									if ( get_the_tags() != "" )
									{
										?>
											<footer class="entry-meta post-tags">
												<?php
													the_tags( "", ', ', "" );
												?>
											</footer>
											<!-- end .entry-meta -->
										<?php
									}
									// end if
								?>
							</article>
							<!-- end .hentry -->
							
							<?php
							$previous_post = get_previous_post_link(
								'<h4>' . __( 'PREVIOUS POST', 'read' ) . '</h4>%link',
								'<span class="meta-nav">&#8592;</span> %title'
							);
							$next_post = get_next_post_link(
								'<h4>' . __( 'NEXT POST', 'read' ) . '</h4>%link',
								'%title <span class="meta-nav">&#8594;</span>'
							);
							if ( $previous_post || $next_post ):
							?>
							<nav class="row-fluid nav-single">
								<div class="span6 nav-previous">
									<?php echo $previous_post; ?>
								</div>
								<div class="span6 nav-next">
									<?php echo $next_post; ?>
								</div>
							</nav>
							<?php endif; ?>
							
							<?php comments_template( "", true ); ?>
						<?php
					endwhile;
				endif;
				wp_reset_query();
			?>
		</div>
		<!-- end .blog-single -->
	</div>
	<!-- end #content -->
</div>
<!-- end #primary -->

<?php
	get_footer();
?>