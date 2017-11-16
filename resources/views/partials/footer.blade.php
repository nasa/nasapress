<footer class="usa-footer usa-footer-medium" role="contentinfo">
  <div class="usa-grid usa-footer-return-to-top">
    <a href="#">Return to top</a>
  </div>

  <!--<div class="usa-footer-primary-section">
    <div class="usa-grid-full">
      <nav class="usa-footer-nav">
        <ul class="usa-unstyled-list">
          <li class="usa-width-one-fourth usa-footer-primary-content">
            <a class="usa-footer-primary-link" href=""></a>
          </li>
        </ul>
      </nav>
    </div>
  </div>-->

  <div class="usa-footer-secondary_section">
    <div class="usa-grid">
      <div class="usa-footer-logo usa-width-one-half">
        <div class="group">
          <img class="usa-footer-logo-img" src="@asset('images/logo-nasa.svg')" alt="NASA logo">
          <h3 class="usa-footer-logo-heading">National Aeronautics and Space Administration</h3>
        </div>
        <p>NASA Official: {{ App\get_nasa_official(get_the_id()) }}<br />
        Page Editor: @php the_author(); @endphp<br />
        Page Last Updated: {{ the_modified_date() }}
        </p>
        <p><a href="https://www.nasa.gov/about/highlights/HP_Privacy.html">Privacy Policy</a> &nbsp;| &nbsp;<a href="http://odeo.hq.nasa.gov/nofear.html">No Fear Act</a> &nbsp;| &nbsp;<a href="https://www.nasa.gov/FOIA/index.html">FOIA</a></p>
      </div>
      <div class="usa-footer-contact-links usa-width-one-half">
        <!-- todo-config -->
        <a title="Follow us on Facebook" class="usa-link-facebook" href="https://www.facebook.com/NASAGlenn"></a>
        <a title="Follow us on Twitter" class="usa-link-twitter" href="https://twitter.com/NASAglenn"></a>
        <a title="Follow us on YouTube" class="usa-link-youtube" href="https://www.youtube.com/user/nasaglenn"></a>
        <a title="Follow us on Instagram" class="usa-link-instagram" href="https://www.instagram.com/nasaglenn/"></a>
        <a title="Follow us on Flickr" class="usa-link-flickr" href="https://www.flickr.com/photos/nasaglenn"></a>
        <address>
          <!-- todo-config -->
          <p class="usa-footer-contact-heading">Glenn Research Center</p>
          <p>21000 Brookpark Road<br />Cleveland, OH 44135<br />(216) 433-4000</p>
          <p class="mb0"><a href="https://www.nasa.gov/centers/glenn/about/grcfaq.html">Contact Us</a> &nbsp;| &nbsp;<a href="https://www.nasa.gov/glenn">nasa.gov/glenn</a></p>

        </address>
      </div>
    </div>
  </div>
</footer>
<!-- todo-config -->
<a href="#" id="feedback-trigger" class="feedback-trigger feedback-trigger-right">Provide feedback</a>

<!--[if lt IE 9]>
  <script src="@asset('scripts/vendor/selectivizr-min.js')"></script>
  <script src="@asset('scripts/vendor/respond.js')"></script>
  <script src="@asset('scripts/vendor/rem.min.js')"></script>
<![endif]-->

<script type="text/javascript">
//<![CDATA[
      //todo-config
      var usasearch_config = { siteHandle:"your-site-handle" };

      var script = document.createElement("script");
      script.type = "text/javascript";
      script.src = "//search.usa.gov/javascripts/remote.loader.js";
      document.getElementsByTagName("head")[0].appendChild(script);

//]]>
</script>
