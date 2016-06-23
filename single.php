<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			          <article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">

			                <header class="article-header entry-header">

			                  <h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>
			                  <?php r0bsc0tt_author_info(); ?>

			                </header>

			                <section class="entry-content cf" itemprop="articleBody">
			                  <?php the_content(); ?>
			                  <?php
													wp_link_pages( array(
														'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'stripped' ) . '</span>',
														'after'       => '</div>',
														'link_before' => '<span>',
														'link_after'  => '</span>',
													));
												?>
			                </section>

			                <footer class="article-footer">

			                  <?php printf( __( 'filed under', 'stripped' ).': %1$s', get_the_category_list(', ') ); ?>

			                  <?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'stripped' ) . '</span> ', ', ', '</p>' ); ?>

			                </footer>

			                <?php comments_template(); ?>

			              </article>

						<?php endwhile; ?>

						<?php else : ?>

							<article id="post-not-found" class="hentry cf">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'stripped' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'stripped' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'This is the error message in the single.php template.', 'stripped' ); ?></p>
									</footer>
							</article>

						<?php endif; ?>

					</main>

					<?php get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>