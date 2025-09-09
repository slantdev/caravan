<?php

/**
 * Template Name: Content Blocks
 *
 * @package Caravan
 */

get_header();
?>

<main id="content">
  <div class="page-content">
    <?php

    get_template_part('template-parts/page', 'builder');

    // The standard WordPress loop
    while (have_posts()) :
      the_post();

      // This is where the content from the WordPress editor (or Elementor) will be rendered.
      the_content();

    endwhile;
    ?>
  </div><!-- .page-content -->
</main><!-- #content -->

<?php
get_footer();
