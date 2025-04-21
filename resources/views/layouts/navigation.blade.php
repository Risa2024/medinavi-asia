<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('dashboard') }}" class="flex items-center group">
                            <div class="w-12 h-12 bg-teal-100 rounded-full flex items-center justify-center mr-3 overflow-hidden shadow-[0_4px_16px_rgba(14,165,233,0.12)] ring-1 ring-teal-100/80">
                                <img src="{{ asset('images/logo/logo_dark.png') }}" alt="MediNavi Asia Logo" class="w-9 h-9 object-contain opacity-100">
                            </div>
                            <span class="text-xl font-bold text-slate-800">Medi<span class="text-teal-700">Navi</span> <span class="text-teal-500">Asia</span></span>
                        </a>
                    </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-12 sm:-my-px sm:ml-16 sm:flex items-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
                        class="text-[#1F2937] hover:text-blue-700 transition-colors duration-300 text-base {{ request()->routeIs('dashboard') ? 'border-b-2 border-blue-700 text-blue-700' : '' }}">
                        {{ __('ホーム') }}
                    </x-nav-link>
                    @if (Route::has('user.favorites.index'))
                        <x-nav-link :href="route('user.favorites.index')" :active="request()->routeIs('user.favorites.index')" 
                            class="text-[#1F2937] hover:text-blue-700 transition-colors duration-300 text-base {{ request()->routeIs('user.favorites.index') ? 'border-b-2 border-blue-700 text-blue-700' : '' }}">
                            {{ __('お気に入り') }}
                        </x-nav-link>
                    @endif

                    @if(auth()->user() && auth()->user()->is_admin)
                        <x-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.*')" 
                            class="text-[#1F2937] hover:text-blue-700 transition-colors duration-300 text-base {{ request()->routeIs('admin.*') ? 'border-b-2 border-blue-700 text-blue-700' : '' }}">
                            {{ __('管理画面') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2.5 border border-transparent text-sm leading-4 font-medium rounded-full text-[#1F2937] bg-gray-50 hover:bg-blue-50/80 hover:text-blue-700 focus:outline-none transition ease-in-out duration-150">
                            <div class="font-medium">{{ Auth::user()->name }}</div>

                            <div class="ms-2">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="text-[#1F2937] hover:text-blue-700 hover:bg-blue-50/80">
                            {{ __('プロフィール') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                    class="text-[#1F2937] hover:text-blue-700 hover:bg-blue-50/80">
                                {{ __('ログアウト') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-[#1F2937] hover:text-blue-700 hover:bg-blue-50/80 focus:outline-none focus:bg-blue-50/80 focus:text-blue-700 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
                class="text-[#1F2937] hover:text-blue-700 hover:bg-blue-50/80 {{ request()->routeIs('dashboard') ? 'border-l-4 border-blue-700 text-blue-700 bg-blue-50/60' : '' }}">
                {{ __('ホーム') }}
            </x-responsive-nav-link>

            @if (Route::has('user.favorites.index'))
                <x-responsive-nav-link :href="route('user.favorites.index')" :active="request()->routeIs('user.favorites.index')" 
                    class="text-[#1F2937] hover:text-blue-700 hover:bg-blue-50/80 {{ request()->routeIs('user.favorites.index') ? 'border-l-4 border-blue-700 text-blue-700 bg-blue-50/60' : '' }}">
                    {{ __('お気に入り') }}
                </x-responsive-nav-link>
            @endif

            @if(auth()->user() && auth()->user()->is_admin)
                <x-responsive-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.*')" 
                    class="text-[#1F2937] hover:text-blue-700 hover:bg-blue-50/80 {{ request()->routeIs('admin.*') ? 'border-l-4 border-blue-700 text-blue-700 bg-blue-50/60' : '' }}">
                    {{ __('管理画面') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="text-base font-medium text-[#0B1E26]">{{ Auth::user()->name }}</div>
                <div class="text-sm text-[#1F2937]">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-[#1F2937] hover:text-blue-700">
                    {{ __('プロフィール') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="text-[#1F2937] hover:text-blue-700">
                        {{ __('ログアウト') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
