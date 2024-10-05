@if ($paginator->hasPages())
    <nav class="pagination is-centered flex" role="navigation" aria-label="pagination">
        {{-- Previous Page Link --}}
        <a class="pagination-previous bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" {{ $paginator->onFirstPage() ? "disabled" : "" }} href="{{ $paginator->previousPageUrl() }}">
            @lang('pagination.previous')
        </a>

        <ul class="pagination-list list-style-none flex bg-blue-500 text-white font-bold py-2 px-4">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li>
                        <span class="pagination-ellipsis bg-red-500">{{ $element }}</span>
                    </li>
                @endif
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li>
                            <a class="block w-8 h-8 rounded leading-8 pagination-link {{ $page == $paginator->currentPage() ? "is-current" : "" }}"
                                href="{{ $url }}" aria-label="Goto page {{ $page }}">{{ $page }}</a>
                        </li>
                    @endforeach
                @endif
            @endforeach
        </ul>
        <a class="pagination-next bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" {{ $paginator->hasMorePages() ? "" : "disabled" }} href="{{ $paginator->nextPageUrl() }}">
            @lang('pagination.next')
        </a>
        {{-- Next Page Link --}}
        {{-- Pagination Elements --}}
    </nav>
@endif