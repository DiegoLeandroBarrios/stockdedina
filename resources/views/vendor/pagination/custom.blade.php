
@if ($paginator->hasPages())
    <nav class="">
        <ul class="pagination justify-content-center rounded-5 text-abril color-nav p-2 ">
            {{-- Botón anterior --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link rounded-5 color-text" aria-hidden="true">&laquo;</span>
                </li>
            @else
                <li class="page-item color-nav">
                    <a class="page-link rounded-5 color-text" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&laquo;</a>
                </li>
            @endif

            {{-- Páginas --}}
            @foreach ($elements as $element)
                {{-- Separador "..." --}}
                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-link rounded-5 color-text">{{ $element }}</span></li>
                @endif

                {{-- Links numéricos --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link rounded-5 color-text">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link rounded-5 color-text" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Botón siguiente --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link rounded-5 color-text" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&raquo;</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link rounded-5" aria-hidden="true">&raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
