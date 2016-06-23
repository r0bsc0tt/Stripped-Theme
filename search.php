<?php get_header(); ?>

      <div id="content">

        <div id="inner-content" class="wrap cf">

          <main id="main" class="m-all t-2of3 d-5of7 cf" role="main">
            <h1 class="archive-title"><span><?php _e( 'Search Results for:', 'stripped' ); ?></span> <?php echo esc_attr(get_search_query()); ?></h1>

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

              <article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article">

                <header class="entry-header article-header">

                  <h3 class="search-title entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

                </header>

                <section class="entry-content">
                    <?php the_excerpt( '<span class="read-more">' . __( 'Read more &raquo;', 'stripped' ) . '</span>' ); ?>

                </section>

                <footer class="article-footer">

                  <?php if(get_the_category_list(', ') != ''): ?>
                            <?php printf( __( 'Filed under: %1$s', 'stripped' ), get_the_category_list(', ') ); ?>
                            <?php endif; ?>

                          <?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'stripped' ) . '</span> ', ', ', '</p>' ); ?>

                </footer> <!-- end article footer -->

              </article>

            <?php endwhile; ?>

                <?php r0bsc0tt_page_navi(); ?>

              <?php else : ?>

                  <article id="post-not-found" class="hentry cf">
                    <header class="article-header">
                      <h1><?php _e( 'Sorry, No Results.', 'stripped' ); ?></h1>
                    </header>
                    <section class="entry-content">
                      <p><?php _e( 'Try your search again.', 'stripped' ); ?></p>
                    </section>
                    <footer class="article-footer">
                        <p><?php _e( 'This is the error message in the search.php template.', 'stripped' ); ?></p>
                    </footer>
                  </article>

              <?php endif; ?>

            </main>

              <?php get_sidebar(); ?>

          </div>

      </div>

<?php get_footer(); ?>