<?php
/*
 * Template Name: Page contact
 * Description: A Page Template with a contact form a la Malmstrom.
 */


get_header(); ?>


    <section id="contact-content" class="clear page<?php echo '-' . $slug; ?>">
      <article>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="col-md-4 leftalign padding-l-30">
          <!-- <h1><?php the_title(); ?></h1> --> 
          <?php the_content_text_only(); ?>

          <?php endwhile; else: ?>
          <div class="alert alert-error">
            <p><?php _e('Sorry, denna sida eller sökning fick ingen träff.'); ?></p>
          </div>
        <?php endif; ?>
        </div>


        <div class="col-md-3 leftalign">
          <?php echo do_shortcode( '[contact-form-7 id="52" title="Contact form 1_copy"]' ); ?>
        </div>

          <?php  // echo do_shortcode( '[contact-form-7 id="26" title="Contact form 1"]' ); ?>


          <div class="col-md-3 leftalign">
          <h2>BESTÄLL BOKEN</h2>
          <p>Fyll i uppgifterna sa skickar vi dig en bok.</p>
          <form id="order-form" class="form-horizontal" action="http://klickomaten.com/" method="post" name="form1" onsubmit="return submitCheck()">
            <!-- Använd http://gimpews.lxir.se/order13utf8.asp för unicode -->
            <input type="hidden" name="ERROR-URL" value="">
            <input type="hidden" name="OK-URL" value="">
            <input type="hidden" name="ClientId" value="752">

          <fieldset>

          <!-- Form Name -->
          <legend>Beställformulär</legend>



          <!-- Text input-->
          <div class="form-group">
            <label class="control-label" for="ShipToFirstname">FÖRNAMN</label>  
            <div class="controls">
            <input id="ShipToFirstname" name="ShipToFirstname" type="text" placeholder="FÖRNAMN" class="form-control input-md" required="" autofocus>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label" for="ShipToLastname">EFTERNAMN</label>  
            <div class="controls">
            <input id="ShipToLastname" name="ShipToLastname" type="text" placeholder="EFTERNAMN" class="form-control input-md" required="">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label" for="ShipToEmail">E-POST</label>  
            <div class="controls">
            <input id="ShipToEmail" name="ShipToEmail" type="text" placeholder="E-POST" class="form-control input-md" required="">
            </div>
          </div>






          <div id="sliding-content">

            <!-- Text input-->
            <div class="form-group">
              <label class="control-label" for="ShipToCompany">FÖRETAG</label>  
              <div class="controls">
              <input id="ShipToCompany" name="ShipToCompany" type="text" placeholder="EV. FÖRETAGSNAMN" class="form-control input-md">
              </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
              <label class="control-label" for="ShipToAddress">ADRESS</label>  
              <div class="controls">
              <input id="ShipToAddress" name="ShipToAddress" type="text" placeholder="ADRESS" class="form-control input-md" required="">
                
              </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
              <label class="control-label" for="ShipToPostalCode">POSTNUMMER</label>  
              <div class="controls">
              <input id="ShipToPostalCode" name="ShipToPostalCode" type="text" placeholder="POSTNUMMER" class="form-control input-md" required="">
                
              </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
              <label class="control-label" for="ShipToCity">ORT</label>  
              <div class="controls">
              <input id="ShipToCity" name="ShipToCity" type="text" placeholder="ORT" class="form-control input-md" required="">
                
              </div>
            </div>

            <!-- Select Basic -->
            <div class="form-group">
              <label class="control-label" for="ShipToCountry">LAND</label>
              <div class="controls">
                <select id="ShipToCountry" name="ShipToCountry" placeholder="LAND" class="form-control">
                  <option value="1">SVERIGE</option>
                  <option value="2">NORDEN</option>
                  <option value="3">EU</option>
                  <option value="4">VÄRLDEN</option>
                </select>
              </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
              <label class="control-label" for="ShipToPhone">TELEFON</label>  
              <div class="controls">
              <input id="ShipToPhone" name="ShipToPhone" type="text" placeholder="TELEFON" class="form-control input-md">
                
              </div>
            </div>

            <!-- Textarea -->
            <div class="form-group">
              <label class="control-label" for="Text1">MEDDELANDE</label>
              <div class="controls">                     
                <textarea class="form-control" id="Text1" name="Text1" placeholder="EV. MEDDELANDE"></textarea>
              </div>
            </div>

            <!-- Appended Input-->
            <div class="form-group">
              <label class="control-label" for="QuantityARTIKELNR1">JAG BESTÄLLER</label>
              <div class="controls">
                <div class="input-group">
                  <input id="QuantityARTIKELNR1" name="QuantityARTIKELNR1" class="form-control" placeholder="ANTAL" type="text" required="">
                  <span class="input-group-addon">ST.</span>
                </div>
                
              </div>
            </div>
          </div><!-- // #sliding-content -->

          <!-- End slider here -->

          <!-- Button -->
          <div class="form-group">
            <label class="control-label" for="singlebutton"></label>
            <div class="controls">
              <button id="singlebutton" name="singlebutton" class="btn btn-primary">BESTÄLL</button>
            </div>
          </div>

          </fieldset>
          </form>
          </div>

      </article>





    <?php
    wp_reset_postdata(); ?>
    </section>

    <section id="map-content" class="clear">
      <article>
        <?php
          // THE GOOGLE MAP
          //  if ($get_meta = get_post_meta($post->ID, 'wpboot_textfield', true)){
          //          echo get_post_meta($post->ID, remove_filter('wpboot_textfield', 'wp_filter_kses') , true);;
          //  } ?>

            <iframe width="1000" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" 
 src="https://maps.google.com/maps/ms?msa=0&amp;msid=215130011975259768685.0004f06c3916401d9f12a&amp;hl=en&amp;ie=UTF8&amp;t=m&amp;source=embed&amp;ll=59.334153,18.073025&amp;spn=0.007661,0.018239&amp;z=15&amp;output=embed"></iframe><br /><small>Se <a href="https://maps.google.com/maps/ms?msa=0&amp;msid=215130011975259768685.0004f06c3916401d9f12a&amp;hl=en&amp;ie=UTF8&amp;t=m&amp;source=embed&amp;ll=59.334153,18.073025&amp;spn=0.007661,0.018239&amp;z=15" style="color:#0000FF;text-align:left">JPC kontor</a>
            på en större karta</small>
        </article>
    </section>


    <section id="teasers" class="clear">
      <?php
      // PUFFAR
       if ( have_posts() ) : while ( have_posts() ) : the_post(); 



        //echo do_shortcode('[gallery]');
        echo do_shortcode('[gallery size="teaser-thumb"
                            itemtag="article"
                            icontag="figure"
                            captiontag="figcaption"
                            exclude="' . get_post_thumbnail_id( $post->ID ) . '"]'); 

      endwhile; 
      endif; ?>

    </section>




<?php get_footer(); ?>