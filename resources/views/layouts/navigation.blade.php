<nav class="border-b border-medinavi-blue-light/20 bg-gradient-to-r from-medinavi-blue to-medinavi-blue-dark"
  x-data="{ open: false }">
  <!-- Primary Navigation Menu -->
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex h-20 justify-between">
      <div class="flex">
        <!-- Logo -->
        <div class="flex flex-shrink-0 items-center">
          <a class="group flex items-center" href="{{ route("dashboard") }}">
            <div
              <img class="h-8 w-8 object-contain opacity-100 sm:h-9 sm:w-9"
                src="{{ asset("images/logo/earth.png") }}" alt="MediNavi Asia Logo">
            </div>
            <a class="flex items-center gap-3" href="{{ route("dashboard") }}">
                <img class="h-6 w-6 object-contain sm:h-7 sm:w-7" src="{{ asset("images/logo/earth.png") }}"
                alt="MediNavi Asia Logo">
                <span class="text-lg font-bold text-white sm:text-xl">
                MediNavi Asia
                </span>
            </a>
        </div>
                <!-- Navigation Links -->
                <div class="hidden space-x-12 sm:-my-px sm:ml-16 sm:flex items-center">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="text-white/90 hover:text-white transition-colors duration-300 text-base {{ request()->routeIs('dashboard') ? 'border-b-2 border-white text-white' : '' }}">
                        {{ __('ホーム') }}
                    </x-nav-link>
                    @if (Route::has('user.favorites.index'))
                        <x-nav-link :href="route('user.favorites.index')" :active="request()->routeIs('user.favorites.index')"
                            class="text-white/90 hover:text-white transition-colors duration-300 text-base {{ request()->routeIs('user.favorites.index') ? 'border-b-2 border-white text-white' : '' }}">
                            {{ __('お気に入り') }}
                        </x-nav-link>
                    @endif

                    @if(auth()->user() && auth()->user()->is_admin)
                        <x-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.*')"
                            class="text-white/90 hover:text-white transition-colors duration-300 text-base {{ request()->routeIs('admin.*') ? 'border-b-2 border-white text-white' : '' }}">
                            {{ __('管理画面') }}
                        </x-nav-link>
                    @endif

                    <x-nav-link :href="route('welcome')" class="text-white/90 hover:text-white transition-colors duration-300 text-base">
                        {{ __('トップページ') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2.5 border border-white/20 text-sm leading-4 font-medium rounded-full text-white bg-white/10 hover:bg-white/20 focus:outline-none transition ease-in-out duration-150">
                            <div class="font-medium">{{ Auth::user()->name }}</div>

                            <div class="ms-2">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="text-slate-800 hover:text-teal-600 hover:bg-teal-50/80">
                            {{ __('プロフィール') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                    class="text-slate-800 hover:text-teal-600 hover:bg-teal-50/80">
                                {{ __('ログアウト') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-white/80 hover:bg-white/10 focus:outline-none focus:bg-white/10 focus:text-white transition duration-150 ease-in-out">
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
                class="text-white/90 hover:text-white hover:bg-white/10 {{ request()->routeIs('dashboard') ? 'border-l-4 border-white text-white bg-white/10' : '' }}">
                {{ __('ホーム') }}
            </x-responsive-nav-link>

            @if (Route::has('user.favorites.index'))
                <x-responsive-nav-link :href="route('user.favorites.index')" :active="request()->routeIs('user.favorites.index')"
                    class="text-white/90 hover:text-white hover:bg-white/10 {{ request()->routeIs('user.favorites.index') ? 'border-l-4 border-white text-white bg-white/10' : '' }}">
                    {{ __('お気に入り') }}
                </x-responsive-nav-link>
            @endif

            @if(auth()->user() && auth()->user()->is_admin)
                <x-responsive-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.*')"
                    class="text-white/90 hover:text-white hover:bg-white/10 {{ request()->routeIs('admin.*') ? 'border-l-4 border-white text-white bg-white/10' : '' }}">
                    {{ __('管理画面') }}
                </x-responsive-nav-link>
            @endif

            <x-responsive-nav-link :href="route('welcome')"
                class="text-white/90 hover:text-white hover:bg-white/10">
                {{ __('トップページ') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-white/20">
            <div class="px-4">
                <div class="text-base font-medium text-white">{{ Auth::user()->name }}</div>
                <div class="text-sm text-white/80">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-white/90 hover:text-white hover:bg-white/10">
                    {{ __('プロフィール') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="text-white/90 hover:text-white hover:bg-white/10">
                        {{ __('ログアウト') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
