
  <footer id="footer" class="clear">
    <div class="two_quarter">
      <?php dynamic_sidebar('footer-one'); ?>
    </div>
    <div class="two_quarter">

      <div class="footer-widget clearfix">
        <div class="textwidget widget-text">
          <p class="rightalign">
            <?php wp_loginout( get_page_link('5'), true); ?>
          </p>
        </div>
      </div>    

    </div>
  </footer>

  <!--
  <div id="bg-img"></div>
  -->
  <?php 
// ADD JS HERE
  wp_footer(); ?>
  <script>

  !function ($) {
    $('#myCarousel').carousel({
      interval: 10000
    });
  };





  // ANALYTICS
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46805298-3', 'sport-marketing.se');
  ga('send', 'pageview');

</script>

</body></html>