<footer class="usa-footer usa-footer-medium">
  <div class="usa-grid usa-footer-return-to-top">
    <a href="#">Return to top</a>
  </div>

  <div class="usa-footer-secondary_section">
    <div class="usa-grid">
      <div class="usa-footer-logo usa-width-one-half">
        <div class="group">
        <img class="usa-footer-logo-img" src="{{ get_template_directory_uri() }}/assets/images/logo-nasa.svg" alt="NASA logo">
          <h3 class="usa-footer-logo-heading">National Aeronautics and Space Administration</h3>
        </div>
		@php
			dynamic_sidebar('nasa-official');
		@endphp
      <p><a href="https://www.nasa.gov/about/highlights/HP_Privacy.html">Privacy Policy</a> &nbsp;| &nbsp;<a href="https://odeo.hq.nasa.gov/nofear.html">No Fear Act</a> &nbsp;| &nbsp;<a href="https://www.nasa.gov/FOIA/index.html">FOIA</a> &nbsp;| &nbsp;<a href="https://www.nasa.gov/">NASA.GOV</a></p>
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