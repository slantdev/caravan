<?php

/**
 * ACF: One Column Video
 *
 * @package WordPress
 * @subpackage caravan
 * @since 1.0.0
 */

// Get ACF fields.
$one_column_video = get_sub_field('one_column_video'); // Group field.

// Bail early if no data.
if (empty($one_column_video)) {
  return;
}

// Content fields.
$headline    = $one_column_video['headline'] ?? '';
$description = $one_column_video['description'] ?? '';
$video_embed = $one_column_video['video_embed'] ?? '';
$iframe_embed = $one_column_video['iframe_embed'] ?? '';

// Don't render section if no content and no background.
if (! $headline && ! $description && ! $video_embed) {
  return;
}
?>

<section class="relative bg-gray-100">

  <div class="relative mx-auto max-w-4xl container px-4 py-12 md:py-16 lg:py-20">
    <div class="text-center">
      <?php if ($headline) : ?>
        <h1 class="!text-2xl !font-bold !my-0 md:!text-3xl lg:!text-4xl"><?php echo esc_html($headline); ?></h1>
      <?php endif; ?>
      <?php if ($description) : ?>
        <div class="mt-4 max-w-none lg:mt-8 text-center text-base md:text-lg">
          <?php echo wp_kses_post($description); ?>
        </div>
      <?php endif; ?>
    </div>

    <?php if ($video_embed || $iframe_embed) : ?>
      <div class="mt-8 lg:mt-12 [&>iframe]:aspect-video [&>iframe]:w-full [&>iframe]:h-full">
        <?php
        if ($video_embed) :
          echo $video_embed;
        elseif ($iframe_embed) :
          echo $iframe_embed;
        endif;
        ?>
      </div>
    <?php endif; ?>
  </div>

</section>