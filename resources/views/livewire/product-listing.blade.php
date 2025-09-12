<div>
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6">
        @foreach ($products as $product)
            <div class="col">
                <div class="product-card shadow-lg">
                    <div class="product-media">
                        <a class="product-image" href="{{ route('product.details', $product->id) }}">
                            @if ($product->productImages->first())
                                <img loading="lazy"
                                    src="{{ asset('uploads/products/' . $product->productImages->first()->multiple_image) }}"
                                    alt="{{ $product->name }}" />
                            @else
                                <img loading="lazy" src="" alt="{{ $product->name }}" />
                            @endif
                        </a>
                        @if ($product->discount_percentage > 0)
                            <div class="badge bg-danger position-absolute zindex-2"><span
                                    class="red">-{{ $product->discount_percentage }} %</span></div>
                        @endif
                    </div>
                    <div class="product-content">
                        <h6 class="product-name">
                            <a href="{{ route('product.details', $product->id) }}">{{ $product->name }}</a>
                        </h6>
                        <h6 class="product-price">
                            <span class="new-price mr-2 bold"><b> Tk
                                    {{ number_format($product->sale_price) }}</b></span>
                            @if ($product->discount_percentage > 0)
                                <del class="old-price"> Tk {{ number_format($product->regular_price) }}</del>
                            @endif
                        </h6>
                        <button class="btn btn-block border-0 w-100 p-1 btn-gradient"
                            onclick="addToCart({{ $product->id }},'{{ $product->name }}',{{ $product->sale_price }})"
                            wire:click="orderNow({{ $product->id }})">
                            অর্ডার করুন
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="section-btn-25 mt-2">
                <nav role="navigation" aria-label="Pagination Navigation"
                    class="flex items-center justify-between">
                    <div class="flex justify-between flex-1 sm:hidden">
                        @if ($products->onFirstPage())
                            <span
                                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600">
                                &laquo; Previous
                            </span>
                        @else
                            <button wire:click="previousPage" wire:loading.attr="disabled"
                                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                                &laquo; Previous
                            </button>
                        @endif

                        @if ($products->hasMorePages())
                            <button wire:click="nextPage" wire:loading.attr="disabled"
                                class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                                Next &raquo;
                            </button>
                        @else
                            <span
                                class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600">
                                Next &raquo;
                            </span>
                        @endif
                    </div>

                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700 leading-5 dark:text-gray-400">
                                Showing
                                <span class="font-medium">{{ $products->firstItem() }}</span> to
                                <span class="font-medium">{{ $products->lastItem() }}</span>
                                of
                                <span class="font-medium">{{ $products->total() }}</span> results
                            </p>
                        </div>

                        <div>
                            <span class="relative z-0 inline-flex rtl:flex-row-reverse shadow-sm rounded-md">
                                @if ($products->onFirstPage())
                                    <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md leading-5 dark:bg-gray-800 dark:border-gray-600" aria-hidden="true">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                @else
                                    <button wire:click="previousPage" wire:loading.attr="disabled" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600" aria-label="Previous">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                @endif

                                @for ($i = 1; $i <= $products->lastPage(); $i++)
                                    @if ($i == $products->currentPage())
                                        <span aria-current="page">
                                            <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-[#684EFF] border border-[#684EFF] cursor-default leading-5">{{ $i }}</span>
                                        </span>
                                    @else
                                        <button wire:click="gotoPage({{ $i }})" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:text-gray-300 dark:active:bg-gray-700 dark:active:text-gray-300" aria-label="Page {{ $i }}">
                                            {{ $i }}
                                        </button>
                                    @endif
                                @endfor

                                @if ($products->hasMorePages())
                                    <button wire:click="nextPage" wire:loading.attr="disabled" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600" aria-label="Next">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                @else
                                    <span class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-r-md leading-5 dark:bg-gray-800 dark:border-gray-600" aria-hidden="true">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                @endif
                            </span>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
