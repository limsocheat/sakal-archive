<div>
    <div class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
        <h3 class="p-4 font-bold tracking-tight text-gray-700 dark:text-white border-b">{{ $title }}</h3>
        <div data-modal-toggle="media-library-model" class="cursor-pointer">
            @if ($chosenMedia)
                <img src="{{ $chosenMedia->findVariant('medium')->getUrl() }}" alt="{{ $chosenMedia->name }}"
                    class="w-full">
            @elseif ($featured_image_url)
                <img src="{{ $featured_image_url }}" alt="{{ $title }}" class="w-full">
            @else
                <div class="border-2 border-dashed border-gray-300 rounded p-3 m-2  text-gray-300 hover:text-gray-400 ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-60 w-60 p-3 mx-auto " fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            @endif
        </div>
        <x-form-input :name="$name" :value="$chosenMedia->id ?? $value" style="display: none;" />
    </div>

    <!-- Extra Large Modal -->
    <div wire:ignore.self
        class="hidden overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center md:inset-0 h-modal sm:h-full transition "
        id="media-library-model">
        <div class="relative px-4 w-full max-w-7xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex justify-between items-center p-5 pb-0 rounded-t border-b dark:border-gray-600">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                        {{ __('Media Library') }}
                        <small wire:loading wire:target="files" class="text-gray-600">Uploading...</small>

                        <div class="border-b border-gray-200 dark:border-gray-700 pt-1">
                            <ul class="flex flex-wrap -mb-px" id="mediaLibrary" data-tabs-toggle="#mediaLibraryContent"
                                role="tablist">
                                <li class="mr-2" role="presentation">
                                    <button
                                        class="inline-block px-4 py-2 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300"
                                        id="upload-tab" data-tabs-target="#upload" type="button" role="tab"
                                        aria-controls="upload" aria-selected="false">{{ __('Upload') }}</button>
                                </li>
                                <li class="mr-2" role="presentation">
                                    <button
                                        class="inline-block px-4 py-2 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300 active"
                                        id="media-tab" data-tabs-target="#media" type="button" role="tab"
                                        aria-controls="media" aria-selected="true">{{ __('Media') }}</button>
                                </li>
                            </ul>
                        </div>
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="media-library-model">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd">
                            </path>
                        </svg>
                    </button>
                </div>
                <!-- Modal body -->
                <div>

                    <div id="mediaLibraryContent">
                        <div class="hidden p-4 bg-gray-50 rounded-lg dark:bg-gray-800" id="upload" role="tabpanel"
                            aria-labelledby="upload-tab">
                            <form wire:submit.prevent="upload" enctype="multipart/form-data" x-ref="mediaForm">
                                <div
                                    class="flex flex-col justify-center items-center border-2 border-dashed border-gray-300 rounded space-y-2 pb-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-40 w-40 text-gray-500 px-6 -py-2"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                    </svg>
                                    <h3 class="text-xl">{{ __('Drop files here to upload') }}</h3>
                                    <span>{{ __('or') }}</span>
                                    <label
                                        class="bg-gray-700 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded-full cursor-pointer">
                                        <input type="file" class="hidden" wire:model="files" multiple
                                            accept="image/*">
                                        {{ __('Select files') }}
                                    </label>
                                </div>
                            </form>
                        </div>
                        <div class="bg-gray-50 rounded-lg dark:bg-gray-800" id="media" role="tabpanel"
                            aria-labelledby="media-tab">
                            <div class="flex flex-row flex-nowrap justify-start items-start">
                                <div
                                    class="grid grid-cols-8 gap-4 flex-1 border-r-2 border-gray-200 p-4 content-center">
                                    @foreach ($medias as $media)
                                        <img wire:click="selectMedia({{ $media->id }})"
                                            wire:key="{{ $media->id }}"
                                            class="inline {{ $selectedMedia && $media->id == $selectedMedia->id ? 'opacity-100 border-2 border-blue-500' : 'opacity-50' }} hover:opacity-100 cursor-pointer"
                                            src="{{ $media->findVariant('thumb')->getUrl() }}">
                                    @endforeach
                                </div>
                                <div class="w-80 p-4">
                                    <div class="flex flex-col space-y-3">
                                        @if ($selectedMedia)
                                            <img class="inline w-full h-auto"
                                                src="{{ $selectedMedia->findVariant('medium')->getUrl() }}">
                                            <p>{{ $selectedMedia->basename }}</p>
                                            <small>{{ $selectedMedia->size }}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div
                    class="flex py-2 px-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600 text-right content-end justify-end">
                    <button data-modal-toggle="media-library-model" type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">{{ __('Close') }}</button>
                    <button wire:click="chooseMedia" data-modal-toggle="media-library-model" type="button"
                        {{ $selectedMedia ? '' : 'disabled' }}
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 disabled:bg-gray-200">
                        {{ __('Choose') }}</button>

                </div>
            </div>
        </div>
    </div>

</div>
