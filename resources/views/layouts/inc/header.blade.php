<nav class="bg-blue-600 border-gray-200 dark:border-gray-600 dark:bg-gray-900">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl px-4 md:px-6 py-2.5">
        <a href="{{ asset('') }}" class="flex items-center md:m-auto">
            <img src="{{ asset('images/logo/huyhieudoan.png') }}" class="mr-3 h-20 sm:h-25" alt="Flowbite Logo">
            <span class="self-center text-white text-xl font-semibold whitespace-nowrap dark:text-white">Đoàn Viên Thanh
                Niên</span>
        </a>

        <button data-collapse-toggle="mobile-menu-2" type="button"
            class="inline-flex text-white items-center p-2 ml-1 text-sm rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            aria-controls="mobile-menu-2" aria-expanded="false">
            <svg class="w-6 h-6 text-black" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
        <div id="mega-menu-full"
            class="hidden md:flex justify-between items-center w-full  md:w-auto md:order-1 md:m-auto">
            <ul
                class="flex flex-col items-center px-4 py-2 mt-4 bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-10 sm:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <a href="{{ route() }}"
                        class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700"
                        aria-current="page">Trang chủ</a>
                </li>
                <li>
                    <button id="mega-menu-full-dropdown-button"
                        class="flex justify-between items-center py-2 pr-4 pl-3 w-full font-medium text-gray-700 rounded md:w-auto hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 dark:text-gray-400 md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700">Tin
                        tức
                        <svg class="ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </li>
                <li>
                    <a href="{{ route('shop') }}"
                        class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700">Cửa
                        hàng</a>
                </li>
                <li>
                    <a href="{{ route('activities') }}"
                        class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700">Hoạt
                        động</a>
                </li>
                <li>
                    <a href="{{ route('contact') }}"
                        class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700">Liên
                        hệ</a>
                </li>
                <li class="flex">
                    @if (empty($user['id']))
                        <a href="{{ route('user') }}"
                            class="block mr-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Đăng nhập
                        </a>
                    @else
                        <div class="flex items-center md:order-2">
                            <button type="button" id="profileUser"
                                class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                                <img src="{{ asset('images/man.png') }}" alt="" class="w-[40px]">
                            </button>
                            <div class="z-50 absolute right-0 md:mt-60 mr-12 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                id="user-dropdown">
                                <div class="py-3 px-4">
                                    <span
                                        class="block text-sm text-gray-900 dark:text-white">{{ $user['fullName'] }}</span>
                                    <span
                                        class="block text-sm font-medium text-gray-500 truncate dark:text-gray-400">{{ $user['email'] }}</span>
                                </div>
                                <ul class="py-1" aria-labelledby="user-menu-button">
                                    @if (!empty($user['admin']) && $user['admin'] == true)
                                        <li>
                                            <a href="{{ route('admin/profile') }}"
                                                class="block py-2 px-4 text-sm text-red-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Trang
                                                quản lý</a>
                                        </li>
                                    @endif
                                    <li>
                                        <a href="{{ route('profile') }}"
                                            class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Trang
                                            cá nhân</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Đăng
                                            xuất</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endif
                </li>
            </ul>
        </div>
    </div>
    @include('components/company')
</nav>

<script>
    // open profile user
    $(document).ready(function() {
        var check = true;
        $("#user-dropdown").hide();
        $("#profileUser").click(
            function() {
                if (check) {
                    $("#user-dropdown").show();
                } else {
                    $("#user-dropdown").hide();
                }
                check = !check;
            }
        )
    })
</script>
