<?php get_header(); 



global $post;
$slug = get_post( $post )->post_name;


?>

  <div id="content" class="clear page-search">
    <section id="main-content">
      
      <?php




        if ( have_posts() ) : while ( have_posts() ) : the_post(); 



        ?>
      <article>
        <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
        <a class="link" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_permalink() ?></a>
        <?php echo content(30); ?>
      </article>
      <?php endwhile; else: ?>
      <div class="alert alert-error">
        <p><?php _e('Tvärr, denna sida eller sökning fick ingen träff.'); ?></p>
      </div>
      <?php endif; ?>
    </section>



    <!-- puffar  (Slider också?) -->
    <section id="teasers" class="clear">
      <?php
       if ( have_posts() ) : while ( have_posts() ) : the_post(); 
      ?>

        <?php 

        //echo do_shortcode('[gallery]');
        echo do_shortcode('[gallery size="teaser-thumb"
                            itemtag="article"
                            icontag="figure"
                            captiontag="figcaption"
                            exclude="' . get_post_thumbnail_id( $post->ID ) . '"]'); 
        ?>
      <?php 
      endwhile; 
      endif; ?>

    </section>
  </div>

<?php get_footer(); ?>