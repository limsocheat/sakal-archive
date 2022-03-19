<div class="overflow-y-auto py-4 px-2 bg-gray-50 rounded dark:bg-gray-800">
    <ul class="space-y-2">
        @foreach ($items as $item)
            @if ($item->hasChildren())
                <li>
                    <button type="button"
                        class="space-x-2  flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="{{ $item->id }}" data-collapse-toggle="{{ $item->id }}">
                        {!! $item->beforeHTML !!}
                        <span class="flex-1 text-left whitespace-nowrap" sidebar-toggle-item>{{ $item->title }}</span>
                        <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <ul id="{{ $item->id }}" class="hidden py-2 space-y-2">
                        @foreach ($item->children() as $child)
                            <li>
                                <a href="{{ $child->url() }}"
                                    class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">{{ $child->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @else
                <li>
                    <a href="{{ $item->url() }}"
                        class="space-x-2 flex items-center p-2 text-base font-normal text-gray-900 rounded-lg {{ $item->isActive ? 'bg-gray-200' : '' }} hover:bg-gray-200">
                        {!! $item->beforeHTML !!}
                        <span class="flex-1 whitespace-nowrap">{!! $item->title !!}</span>
                        {!! $item->afterHTML !!}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>

</div>
