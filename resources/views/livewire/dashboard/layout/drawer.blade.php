<div>
    <aside style="height: 100vh" aria-label="Sidebar"
        class="w-56 absolute sm:relative bg-gray-50 shadow md:h-full flex-col justify-between hidden sm:flex">
        <div class="overflow-y-auto py-4 px-3 bg-gray-50 rounded dark:bg-gray-800">
            <div class="h-16 w-full flex items-center px-8">
                <a href="https://flowbite.com" class="flex pl-2.5 mb-5">
                    <svg class="mr-3 h-9" viewBox="0 0 52 72" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M1.87695 53H28.7791C41.5357 53 51.877 42.7025 51.877 30H24.9748C12.2182 30 1.87695 40.2975 1.87695 53Z"
                            fill="#76A9FA" />
                        <path
                            d="M0.000409561 32.1646L0.000409561 66.4111C12.8618 66.4111 23.2881 55.9849 23.2881 43.1235L23.2881 8.87689C10.9966 8.98066 1.39567 19.5573 0.000409561 32.1646Z"
                            fill="#A4CAFE" />
                        <path
                            d="M50.877 5H23.9748C11.2182 5 0.876953 15.2975 0.876953 28H27.7791C40.5357 28 50.877 17.7025 50.877 5Z"
                            fill="#1C64F2" />
                    </svg>
                    <span class="self-center text-lg font-semibold whitespace-nowrap dark:text-white">FlowBite</span>
                </a>
            </div>
            <x-dashboard.menu.drawer :items="Menu::get($menu)->roots()->sortBy('order')"></x-dashboard.menu.drawer>
        </div>


        <div class="px-8 bg-gray-800">
            <ul class="w-full flex items-center justify-between">
                <li class="cursor-pointer text-white pt-5 pb-3">
                    <a aria-label="open notifications" href="javascript:void(0)">
                        <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/light_with_icons_at_bottom_alternate_style-svg3.svg"
                            alt="notifications">
                    </a>
                </li>
                <li class="cursor-pointer text-white pt-5 pb-3">
                    <a aria-label="open messages" href="javascript:void(0)">
                        <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/light_with_icons_at_bottom_alternate_style-svg4.svg"
                            alt="chat">
                    </a>
                </li>
                <li class="cursor-pointer text-white pt-5 pb-3">
                    <a aria-label="open settings" href="javascript:void(0)">
                        <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/light_with_icons_at_bottom_alternate_style-svg5.svg"
                            alt="settings">
                    </a>
                </li>
                <li class="cursor-pointer text-white pt-5 pb-3 ">
                    <a aria-label="open archive" href="javascript:void(0)">
                        <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/light_with_icons_at_bottom_alternate_style-svg6.svg"
                            alt="drawer">
                    </a>
                </li>
            </ul>
        </div>
    </aside>
</div>
