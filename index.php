<?php get_header(); 

// NICE TO HAVE:
// the_content_images_only()
// the_content_text_only()

global $wp_query;
$post_id = $wp_query->post->ID;

$post = get_post( $post_id );
$slug = $post->post_name;


?>
    <section id="main-content" class="clear page<?php echo '-' . $slug; ?>">
      <article>
      <?php

      if ( have_posts() ) : while ( have_posts() ) : the_post();
        if ( is_home() ) : ?>
          <div class="one_third"><?php
            echo get_the_post_thumbnail($page->ID, 'medium'); 
             ?>
          </div>
          <div class="two_third">
            <h1><?php the_title(); ?></h1>  
            <?php the_content_text_only(); 
            // the_content_image_only(); ?>
          </div>
          <?php


          elseif (is_page( 13 )) : ?>
          <div class="three_third">
            <h1><?php the_title(); ?></h1>  
            <?php the_content(); ?>
          </div><?php


          else : ?>
         
            <h1><?php the_title(); ?></h1>  
            <?php the_content(); 

        endif;  
      endwhile;
      endif;
      wp_reset_postdata(); ?>
      </article>
    </section>  

    <?php 

    if ( have_posts() ) : ?>

 

    <!-- puffar -->
    <section id="teasers" class="clear">
      <div class="gallery">
    <?php

    // MULTIPLE ATTACHMENTS PLUGIN
    // ELLER EN HACK: http://lifeonlars.com/wordpress/how-to-add-multiple-featured-images-in-wordpress/

      $i = 1;

      if (class_exists('MultiPostThumbnails')) :
        while ($i <= 3) :
              $bottom_image = 'bottom-image-' . $i;
        if (MultiPostThumbnails::has_post_thumbnail('page', $bottom_image )) {
            echo '<article class="gallery-item">
                  <figure class="gallery-icon">';
            MultiPostThumbnails::the_post_thumbnail('page', $bottom_image );
            echo '</figure></article>';
        }

         $i++;
        endwhile;
      endif; 

    endif ;


      ?>

      </div>
    </section>
  </div>
<?php get_footer(); ?>