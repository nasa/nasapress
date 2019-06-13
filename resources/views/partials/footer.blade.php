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
		@php
			dynamic_sidebar('nasa-official');
		@endphp
        <p><a href="https://www.nasa.gov/about/highlights/HP_Privacy.html">Privacy Policy</a> &nbsp;| &nbsp;<a href="https://odeo.hq.nasa.gov/nofear.html">No Fear Act</a> &nbsp;| &nbsp;<a href="https://www.nasa.gov/FOIA/index.html">FOIA</a></p>
      </div>
      <div class="usa-footer-contact-links usa-width-one-half">
		@php
			dynamic_sidebar('social-media');
			dynamic_sidebar('nasa-center-info');
		@endphp
      </div>
    </div>
  </div>
</footer>

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
