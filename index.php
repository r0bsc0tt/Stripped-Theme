<?php get_header(); ?>
      <div id="content">

        <div id="inner-content" class="wrap cf">

            <main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

              <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

              <article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article">

                <header class="article-header">

                  <h1 class="h2 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
                  <?php r0bsc0tt_author_info(); ?>

                </header>

                <section class="entry-content cf">
                  <?php the_content(); ?>
                </section>

                <footer class="article-footer cf">
                  <p class="footer-comment-count">
                    <?php comments_number( __( '<span>No</span> Comments', 'stripped' ), __( '<span>One</span> Comment', 'stripped' ), __( '<span>%</span> Comments', 'stripped' ) );?>
                  </p>


                  <?php printf( '<p class="footer-category">' . __('filed under', 'stripped' ) . ': %1$s</p>' , get_the_category_list(', ') ); ?>

                  <?php the_tags( '<p class="footer-tags tags"><span class="tags-title">' . __( 'Tags:', 'stripped' ) . '</span> ', ', ', '</p>' ); ?>


                </footer>

              </article>

              <?php endwhile; ?>

                  <?php r0bsc0tt_page_navi(); ?>

              <?php else : ?>

                  <article id="post-not-found" class="hentry cf">
                      <header class="article-header">
                        <h1><?php _e( 'Oops, Post Not Found!', 'stripped' ); ?></h1>
                    </header>
                      <section class="entry-content">
                        <p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'stripped' ); ?></p>
                    </section>
                    <footer class="article-footer">
                        <p><?php _e( 'This is the error message in the index.php template.', 'stripped' ); ?></p>
                    </footer>
                  </article>

              <?php endif; ?>


            </main>

          <?php get_sidebar('sidebar'); ?>

        </div>

      </div>
<?php get_footer(); ?>