<?php
$term_id = get_queried_object()->term_id;
if ($term_id) {
  $the_id = 'term_' . $term_id;
} else {
  $the_id = get_the_ID();
}

if (have_rows('section_builder', $the_id)) :

  // Loop through rows.
  while (have_rows('section_builder', $the_id)) : the_row();

    if (get_row_layout() == 'page_banner') :
      get_template_part('template-parts/sections/page_banner');

    elseif (get_row_layout() == 'hero_slider') :
      get_template_part('template-parts/sections/hero_slider');

    endif;

  // End loop.
  endwhile;

// No value.
else :
// Do something...
endif;
