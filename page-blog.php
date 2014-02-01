<?php
/*
 * Template Name: Page blog
 * Description: A Page Template with a listing of posts...perhaps
 */
get_header(); 

// THIS IS THE BLOG INDEX PAGE
// NICE TO HAVE:
// the_content_images_only()
// the_content_text_only()

global $wp_query;
$post_id = $wp_query->post->ID;

$post = get_post( $post_id );
$slug = $post->post_name;


$wp_query           = new WP_Query( array( 
  'taxonomy'        => 'category',
  'post_type'       => 'post',
  'order'           => 'DESC',
  'posts_per_page'  => 10,
  'paged'=> $paged 
  ));
?>


    <section id="main-content" class="clear page<?php echo '-' . $slug; ?>">
      <?php
    
        if ( have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
      <article onclick="location.href='<?php the_permalink(); ?>'" title="Läs mer på sidan <?php the_title(); ?>">
        <a href="#"><h2><?php the_title(); ?></h2></a>  
        <?php echo content(45);?>
      </article>

      <?php endwhile; else: ?>
      <div class="alert alert-error">
        <p><?php _e('Sorry, denna sida eller sökning fick ingen träff.'); ?></p>
        <p>Försök klicka på något i menyn eller prova en sökning nedan!</p>
        <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
          <label class="screen-reader-text" for="s">Sök</label>
          <input type="text" value="" name="s" id="s" placeholder="Sök här" />
          <input type="submit" id="searchsubmit" value="Sök" />
        </form>
      </div>
      <?php
      
      endif; 
    ?>

    </section>



<?php get_footer(); ?>
