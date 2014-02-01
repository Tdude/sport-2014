<?php get_header(); 

// NICE TO HAVE:
// the_content_images_only()
// the_content_text_only()


?>

  <div id="content" class="clear">
    <section id="main-content">
      
      <?php
     
      if ( !is_page(5) ) :

        if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article>
          <h1><?php the_title(); ?></h1>  
          <?php the_content(); ?>
        </article>
        <?php endwhile; else: ?>
        <div class="alert alert-error">
          <p><?php _e('Sorry, denna sida eller sökning fick ingen träff.'); ?></p>
        </div>
        <?php
        
        endif; 
      else : ?>




 <?php 

      if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <article>
        <div class="one_third"><?php 

          if ( has_post_thumbnail() ) {
            echo get_the_post_thumbnail($post->ID, 'medium'); 
          } else {
            the_content_image_only();
          } ?>
        </div>
        <div class="two_third">
          <h1 class="hidden"><?php the_title(); ?></h1>  
          <?php the_content_text_only(); 
          // the_content_image_only(); ?>
        </div>
      
      <?php endwhile; else: ?>
        <div class="alert alert-error">
          <p><?php _e('Sorry, denna sida eller sökning fick ingen träff.'); ?></p>
        </div>
        </article><?php 

      endif; 
    endif; // NOT PAGE 18
    wp_reset_postdata(); ?>

    </section>  




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




      ?>

      </div>
    </section>
  </div>
<?php get_footer(); ?>