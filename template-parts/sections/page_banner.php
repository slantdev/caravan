<?php

/**
 * ACF: Page Banner
 *
 * @package WordPress
 * @subpackage caravan
 * @since 1.0.0
 */

// Get ACF fields.
$page_banner = get_sub_field('page_banner'); // Group field.

// Bail early if no data.
if (empty($page_banner)) {
  return;
}

// Content fields.
$headline    = $page_banner['headline'] ?? '';
$description = $page_banner['description'] ?? '';

// Background fields.
$background               = $page_banner['background'] ?? array(); // Group.
$background_image         = $background['background_image'] ?? null;
$background_overlay_color = $background['background_overlay'] ?? ''; // Assuming this is a color value from ACF.

// Prepare image attributes.
$background_image_url = $background_image['url'] ?? '';
$background_image_alt = $background_image['alt'] ?? ($headline ?: 'Page banner background'); // Fallback alt text.

// Don't render section if no content and no background.
if (! $headline && ! $description && ! $background_image_url) {
  return;
}
?>

<section class="relative overflow-hidden bg-gray-800 text-white">

  <?php if ($background_image_url) : ?>
    <div class="absolute inset-0">
      <img src="<?php echo esc_url($background_image_url); ?>" alt="<?php echo esc_attr($background_image_alt); ?>" class="!h-full w-full object-cover">
      <?php if ($background_overlay_color) : ?>
        <div class="absolute inset-0" style="background-color: <?php echo esc_attr($background_overlay_color); ?>;"></div>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <div class="relative mx-auto max-w-screen-xl container px-4 py-12 md:py-20 lg:py-28 xl:py-44">
    <div class="w-full lg:w-2/3">
      <?php if ($headline) : ?>
        <h1 class="!text-3xl !font-bold !text-white !my-0 md:!text-4xl lg:!text-6xl xl:!text-7xl"><?php echo esc_html($headline); ?></h1>
      <?php endif; ?>
      <?php if ($description) : ?>
        <div class="mt-4 max-w-none lg:mt-8">
          <?php echo wp_kses_post($description); ?>
        </div>
      <?php endif; ?>
    </div>
  </div>

</section>