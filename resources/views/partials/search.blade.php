<form accept-charset="UTF-8" action="https://search.usa.gov/search/docs" id="search_form" method="get" class="usa-search usa-search-small js-search-form">
  <div role="search">
    <div style="margin:0;padding:0;display:inline"><!-- todo-config --><input name="utf8" type="hidden" value="YOUR_VALUE" /></div>
    <!-- todo-config -->
    <input id="affiliate" name="affiliate" type="hidden" value="YOUR_VALUE" />
    @if ($thisSite)
    <!-- todo-config -->
    <input id="dc" name="dc" type="hidden" value="YOUR_VALUE" />
    @endif
    <label class="usa-sr-only" for="query">Enter Search Term(s):</label>
    <input autocomplete="off" id="query" name="query" type="search" placeholder="Search">
    <button type="submit" name="commit" value="Search">
      <span class="usa-sr-only">Search</span>
    </button>
  </div>
</form>
