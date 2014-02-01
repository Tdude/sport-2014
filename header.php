<!doctype>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title><?php wp_title('|',1,'right'); ?> <?php bloginfo('name'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Le styles -->
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url');?>">

  <link href='http://fonts.googleapis.com/css?family=Mate|Open+Sans:400,300' rel='stylesheet' type='text/css'>
  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php bloginfo( 'template_url' ); ?>/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php bloginfo( 'template_url' ); ?>/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php bloginfo( 'template_url' ); ?>/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="<?php bloginfo( 'template_url' ); ?>/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="<?php bloginfo( 'template_url' ); ?>/favicon.png">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
      <link rel="stylesheet" href="<?php bloginfo('template_url');?>/css/ie8.css">
    <![endif]-->


    <?php wp_enqueue_script("jquery"); ?>
    <?php wp_head(); ?>
    
</head>
<body id="top">
  <header id="header" class="clear">
    <aside id="global-options">
     <ul class="inline-list">


      <li class="svg-clock">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" >
          <g>
            <circle id="circle" style="stroke: #000; fill: #494949;" cx="55" cy="55" r="55"/>
            <line id="hour0" x1="100" y1="10"  x2="100" y2="0"/>
            <line id="hour1" x1="150" y1="13"  x2="145" y2="22"/>
            <line id="hour2" x1="187" y1="50"  x2="178" y2="55"/>
            <line id="hour3" x1="190" y1="100" x2="200" y2="100"/>
            <line id="hour4" x1="187" y1="150" x2="178" y2="145"/>
            <line id="hour5" x1="150" y1="187" x2="145" y2="178"/>
            <line id="hour6" x1="100" y1="190" x2="100" y2="200"/>
            <line id="hour7" x1="50"  y1="187" x2="55"  y2="178"/>
            <line id="hour8" x1="13"  y1="150" x2="22"  y2="145"/>
            <line id="hour9" x1="0"   y1="100" x2="10"  y2="100"/>
            <line id="hour10" x1="13"  y1="50"  x2="22"  y2="55" />
            <line id="hour11" x1="50"  y1="13"  x2="55"  y2="22" />
          </g>
          <g>
            <line x1="100" y1="100" x2="100" y2="45" style="stroke-width: 2px; stroke: #889;" id="hourhand"/>
            <line x1="100" y1="100" x2="100" y2="15" style="stroke-width: 2px; stroke: #99a;" id="minutehand"/>
            <line x1="100" y1="100" x2="100" y2="5"  style="stroke-width: 1px; stroke: #c00;" id="secondhand"/>
          </g>
        </svg>
      </li>

      <li class="date"><?php echo date_i18n('j F Y', time()); ?></li>

<!--
      Checkout // Login //
      <li class="envelope"><a class="contact" href="<?php echo site_url(); ?>/kontakt"><span class="envelope">Kontakta oss</a></li>
 -->     
      </ul>



      <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
        <label class="screen-reader-text" for="s">Search</label>
        <input type="text" value="" name="s" id="s" placeholder="Sök här" />
        <input type="submit" id="searchsubmit" value="Sök" />
      </form>

      <?php if ( is_active_sidebar( 'header-widget' ) ) : ?>
      <?php dynamic_sidebar( 'header-widget' ); ?>
      <?php endif; ?>
    </aside>

    <hgroup>
      <a class="navbar-brand" href="<?php echo site_url(); ?>" title="<?php bloginfo('name'); ?>" rel="home"><span id="logo-svg"><?php bloginfo('name'); ?></span></a>
      <p class="description">Sport-marketing.se</p>
    </hgroup>

    <aside id="famous-quote">
      <?php

 //     $args = array( 'post_type' => 'random_quote', 'posts_per_page' => 1, 'orderby' => 'rand' );
 //     $loop = new WP_Query( $args );
 //     while ( $loop->have_posts() ) : $loop->the_post();
 //       echo '<p>';
 //       the_title();
 //       echo '</p>';
 //       echo '<small class="author">';
 //       the_excerpt();
 //       echo '</small>';
 //     endwhile;
 //     wp_reset_postdata();

       ?>
    </aside>


    <section id="slider">
      <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="10000">
        <div class="carousel-inner">
            <?php   
            // QUERY CUSTOM POST BILDSPEL. SEE FUNCTIONS.PHP

            $temp = $wp_query;
            $wp_query= null;
            $list_data_target = null;
            $i = 0;

            
            query_posts( 'wpboot_bildspel&orderby=rand');
            if ($wp_query->have_posts()) : 

              $output='';

              while ($wp_query->have_posts()) : $wp_query->the_post(); 
                
                  if ($i < 1) {
                    $active = " active";
                  } else {
                    $active = "";
                  }
                  $i++;

                  echo '<div class="item'. $active .'">';
                  



                  //if ($get_meta = get_post_meta($post->ID, 'wpboot_img', true)){
                  //  echo '<img src="', get_post_meta($post->ID, 'wpboot_img', true), '" alt="img-'. $i .'" />';
                  //} 


                  if ( has_post_thumbnail() ) :
                    $image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'slider' );
                    echo '  <img itemprop="image" src="' . $image_attributes[0] . '" alt="img-'. $i .'">';
                  endif ; 




                  if ($get_meta = get_post_meta($post->ID, 'wpboot_spiderfood', true)){
                    echo '<p class="hidden"><strong>', get_post_meta($post->ID, 'wpboot_spiderfood', true), '</strong></p>';
                  }

                  // OBS PUNKT INNAN = LAGGER TILL DATA
                  $output .=  '<li data-target="#carousel-example-generic" data-slide-to="'. $i .'" class="'. $active .'"></li>';
                  echo '</div>'; 
              

              endwhile; ?>
          </div><!-- //carousel-inner -->

          <ol class="carousel-indicators">
            <?php echo $output ; ?>
          </ol>
          <!--
          <p><a class="btn btn-lg btn-primary" href="#" role="button">Boka idag</a></p>
          -->
          <?php 

          endif;
          $wp_query = null; 
          $wp_query = $temp;  ?>


    </section>









    <nav>
        <?php
        
        $args = array(
          'theme_location' => 'top-bar',
          'menu'           => 'top-bar',
          'depth'          => 0,
          'container'      => false,
          'menu_class'     => 'menu',
          //'show_home'      => 'Start',
          
          'before'         => '',
          'after'          => '',
        );
 
        wp_nav_menu($args);
      
        ?>
    </nav>
  </header>
