      <footer itemscope itemtype="http://schema.org/WPFooter">
        <div id="inner-footer" class="wrap cf">
          
          <div class="copyright">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>.</p>
          </div>
          
          <?php if (function_exists('r0bsc0tt_social_callback')) { ?> 
          <div class="r0bsc0tt-social-media">
            <?php r0bsc0tt_social_callback(); ?>
          </div>
          <?php } ?>

          <nav role="navigation">
            <?php wp_nav_menu(array(
              'container' => 'div',
              'container_class' => 'footer-links cf',
              'menu' => __( 'Footer Links', 'stripped' ),
              'menu_class' => 'nav footer-nav cf',
              'theme_location' => 'footer-menu',
              'before' => '',
              'after' => '',
              'link_before' => '',
              'link_after' => '',
              'depth' => 0,
              'fallback_cb' => 'r0bsc0tt_footer_links_fallback'
            )); ?>
          </nav>

        </div>
      </footer>
  </div>
  <?php wp_footer(); ?>
</body>
</html>
