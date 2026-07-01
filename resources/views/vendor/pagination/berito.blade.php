@if ($paginator->hasPages())
    <nav class="pagination flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between" role="navigation" aria-label="Pagination Navigation">
        <p class="text-sm font-medium text-gray-500">
            Menampilkan {{ $paginator->firstItem() }}-{{ $paginator->lastItem() }} dari {{ $paginator->total() }} data
        </p>

        <div class="flex w-full justify-center sm:w-auto sm:justify-end">
            <div class="inline-flex max-w-full items-center gap-1 overflow-x-auto rounded-2xl border border-blue-100 bg-white p-1 shadow-sm">
                @if ($paginator->onFirstPage())
                    <span class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl text-gray-300" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl text-blue-800 transition hover:bg-blue-50" aria-label="@lang('pagination.previous')">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                @endif

                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="inline-flex h-10 min-w-10 shrink-0 items-center justify-center rounded-xl px-3 text-sm font-bold text-gray-400" aria-disabled="true">{{ $element }}</span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="inline-flex h-10 min-w-10 shrink-0 items-center justify-center rounded-xl bg-blue-800 px-3 text-sm font-extrabold text-white shadow-sm" aria-current="page">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="inline-flex h-10 min-w-10 shrink-0 items-center justify-center rounded-xl px-3 text-sm font-bold text-gray-600 transition hover:bg-blue-50 hover:text-blue-800">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl text-blue-800 transition hover:bg-blue-50" aria-label="@lang('pagination.next')">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                @else
                    <span class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl text-gray-300" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 5l7 7-7 7" />
                        </svg>
                    </span>
                @endif
            </div>
        </div>
    </nav>
@endif
