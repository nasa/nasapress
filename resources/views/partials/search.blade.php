<form accept-charset="UTF-8" action="https://search.usa.gov/search/docs" id="search_form" method="get" class="usa-search usa-search-small js-search-form">
  <div role="search">
    <div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /></div>

    <input id="affiliate" name="affiliate" type="hidden" value="nasa-glenn" />
    @if ($thisSite)
    <input id="dc" name="dc" type="hidden" value="4266" />
    @endif
    <label class="usa-sr-only" for="query">Enter Search Term(s):</label>
    <input autocomplete="off" id="query" name="query" type="search" placeholder="Search">
    <button type="submit" name="commit" value="Search">
      <span class="usa-sr-only">Search</span>
    </button>
  </div>
</form>
