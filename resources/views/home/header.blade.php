<header class="sticky top-0 z-50 bg-white/90 backdrop-blur-lg border-b border-gray-100 shadow-sm">
    <div class="container mx-auto px-4 lg:px-8 h-20 flex items-center justify-between">
        <!-- Logo -->
        <a href="{{url('/')}}" class="flex items-center group transition-transform hover:scale-105">
            <img class="w-40 h-auto" src="/images/logo.png" alt="EcommercePro" />
        </a>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex items-center space-x-10 text-sm font-semibold tracking-wide uppercase text-gray-500">
            <a href="{{url('/')}}" class="hover:text-indigo-600 transition-colors relative after:absolute after:bottom-[-4px] after:left-0 after:w-0 after:h-0.5 after:bg-indigo-600 after:transition-all hover:after:w-full {{ request()->is('/') ? 'text-indigo-600 after:w-full' : '' }}">Home</a>
            <a href="{{url('products')}}" class="hover:text-indigo-600 transition-colors relative after:absolute after:bottom-[-4px] after:left-0 after:w-0 after:h-0.5 after:bg-indigo-600 after:transition-all hover:after:w-full {{ request()->is('products') ? 'text-indigo-600 after:w-full' : '' }}">Products</a>
            <a href="{{url('show_order')}}" class="hover:text-indigo-600 transition-colors relative after:absolute after:bottom-[-4px] after:left-0 after:w-0 after:h-0.5 after:bg-indigo-600 after:transition-all hover:after:w-full {{ request()->is('show_order') ? 'text-indigo-600 after:w-full' : '' }}">Orders</a>
        </nav>

        <!-- Right Side: Search, Cart, Profile -->
        <div class="flex items-center space-x-4 md:space-x-6">
            <!-- Search Icon (Optional hidden for now or trigger modal) -->
            <button class="p-2.5 text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 rounded-full transition-all">
                <i class="fa fa-search text-lg"></i>
            </button>

            <!-- Cart Section -->
            @auth
                @php $cartCount = \App\Models\Cart::where('user_id', Auth::id())->count(); @endphp
                <a href="{{ url('show_cart') }}" class="relative p-2.5 text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 rounded-full transition-all group">
                    <i class="fa fa-shopping-cart text-lg"></i>
                    @if($cartCount > 0)
                        <span class="absolute top-1 right-1 bg-indigo-600 text-white text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center border-2 border-white ring-2 ring-transparent group-hover:ring-indigo-100 transition-all">{{ $cartCount }}</span>
                    @endif
                </a>
            @else
                <a href="{{ url('show_cart') }}" class="p-2.5 text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 rounded-full transition-all">
                    <i class="fa fa-shopping-cart text-lg"></i>
                </a>
            @endauth

            <!-- Auth/Profile Section -->
            @if (Route::has('login'))
                @auth
                    <!-- Profile Dropdown (Jetstream Compatible) -->
                    <div class="relative ml-2">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-indigo-400 transition-all shadow-sm">
                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    </button>
                                @else
                                    <button class="flex items-center space-x-2 px-3 py-2 rounded-full bg-gray-50 border border-gray-100 hover:border-indigo-200 transition-all">
                                        <span class="text-xs font-bold text-gray-700 uppercase">{{ Auth::user()->name }}</span>
                                        <i class="fa fa-chevron-down text-[10px] text-gray-400"></i>
                                    </button>
                                @endif
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-48">
                                    <div class="block px-4 py-2 text-xs text-gray-400 font-bold uppercase tracking-widest">Account</div>
                                    <x-dropdown-link href="{{ route('profile.show') }}">
                                        <i class="fa fa-user-circle mr-2 opacity-60"></i>{{ __('Profile') }}
                                    </x-dropdown-link>
                                    
                                    <x-dropdown-link href="{{ url('show_order') }}">
                                        <i class="fa fa-box mr-2 opacity-60"></i>{{ __('My Orders') }}
                                    </x-dropdown-link>

                                    @if(Auth::user()->usertype == '1')
                                        <div class="border-t border-gray-100"></div>
                                        <div class="block px-4 py-2 text-xs text-gray-600 font-bold uppercase tracking-widest bg-gray-50">Admin</div>
                                        <x-dropdown-link href="{{ url('/redirect') }}">
                                            <i class="fa fa-chart-line mr-2 opacity-60"></i>Management
                                        </x-dropdown-link>
                                    @endif

                                    <div class="border-t border-gray-100"></div>
                                    
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf
                                        <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();" class="text-red-600 hover:bg-red-50">
                                            <i class="fa fa-sign-out-alt mr-2 opacity-60"></i>{{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <div class="hidden sm:flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 hover:text-indigo-600 transition-colors">Log In</a>
                        <a href="{{ route('register') }}" class="px-6 py-2.5 bg-indigo-600 text-white text-sm font-bold rounded-full shadow-lg shadow-indigo-100 hover:bg-indigo-700 hover:shadow-indigo-200 active:scale-95 transition-all">Register</a>
                    </div>
                    <!-- Mobile Hamburger (simplified for now) -->
                    <button class="md:hidden p-2 text-gray-600">
                        <i class="fa fa-bars text-2xl"></i>
                    </button>
                @endauth
            @endif
        </div>
    </div>
</header>