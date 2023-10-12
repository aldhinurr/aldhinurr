@if ($paginator->hasPages())
  <ul class="pagination" id="pagination-sewa">
    <input type="hidden" name="hidden_page" id="hidden_page" value=1>
    <li class="page-item">
      @if ($paginator->onFirstPage())
        <a class="page-link page-link-nav disabled" aria-label="Previous">
          <span aria-hidden="true"><i class="la la-angle-left"></i></span>
          <span class="sr-only">Previous</span>
        </a>
      @else
        <a class="page-link page-link-nav" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
          <span aria-hidden="true"><i class="la la-angle-left"></i></span>
          <span class="sr-only">Previous</span>
        </a>
      @endif
    </li>

    @foreach ($elements as $element)
      @if (is_string($element))
        <li class="disabled"><span>{{ $element }}</span></li>
      @endif

      @if (is_array($element))
        @foreach ($element as $page => $url)
          @if ($page == $paginator->currentPage())
            <li class="page-item active">
              <a class="page-link page-link-nav" href="#">{{ $page }}<span
                  class="sr-only">(current)</span></a>
            </li>
          @else
            <li class="page-item">
              <a class="page-link page-link-nav" href="{{ $url }}">{{ $page }}</a>
            </li>
          @endif
        @endforeach
      @endif
    @endforeach

    <li class="page-item">
      @if ($paginator->hasMorePages())
        <a class="page-link page-link-nav" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
          <span aria-hidden="true"><i class="la la-angle-right"></i></span>
          <span class="sr-only">Next</span>
        </a>
      @else
        <a class="page-link page-link-nav disabled" aria-label="Next">
          <span aria-hidden="true"><i class="la la-angle-right"></i></span>
          <span class="sr-only">Next</span>
        </a>
      @endif
    </li>
  </ul>
@endif
