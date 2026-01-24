<section x-data="{ activeSlide: 1, totalSlides: 3 }" class="relative bg-white overflow-hidden h-[600px] md:h-[700px]">
    <!-- Slider Background -->
    <div class="absolute inset-0 z-0">
        <img src="images/slider-bg.jpg" class="w-full h-full object-cover opacity-20" alt="">
    </div>

    <!-- Slides -->
    <div class="relative z-10 h-full">
        <!-- Slide 1 -->
        <div x-show="activeSlide === 1" 
             x-transition:enter="transition ease-out duration-1000"
             x-transition:enter-start="opacity-0 translate-x-20"
             x-transition:enter-end="opacity-100 translate-x-0"
             class="h-full flex items-center">
            <div class="container mx-auto px-4 lg:px-20">
                <div class="max-w-2xl">
                    <span class="inline-block px-4 py-1.5 bg-indigo-100 text-indigo-600 text-xs font-black uppercase tracking-widest rounded-full mb-6 italic">Season Sale 2026</span>
                    <h1 class="text-6xl md:text-8xl font-black text-gray-900 leading-tight mb-8 italic">
                        SALE <span class="text-indigo-600">20% OFF</span><br>
                        ON EVERYTHING
                    </h1>
                    <p class="text-lg text-gray-500 leading-relaxed mb-10 max-w-lg">
                        Experience the ultimate fusion of style and comfort. Our latest premium collection is now available with exclusive seasonal discounts.
                    </p>
                    <div class="flex items-center space-x-4">
                        <a href="#products" class="px-10 py-4 bg-indigo-600 text-white font-bold rounded-2xl shadow-xl shadow-indigo-100 hover:bg-indigo-700 hover:shadow-indigo-200 active:scale-95 transition-all">Shop Now</a>
                        <a href="#" class="px-10 py-4 bg-white text-gray-900 font-bold rounded-2xl border border-gray-100 hover:bg-gray-50 active:scale-95 transition-all">View Details</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 2 (Variation) -->
        <div x-show="activeSlide === 2" 
             x-transition:enter="transition ease-out duration-1000"
             x-transition:enter-start="opacity-0 translate-x-20"
             x-transition:enter-end="opacity-100 translate-x-0"
             class="h-full flex items-center">
            <div class="container mx-auto px-4 lg:px-20">
                <div class="max-w-2xl">
                    <span class="inline-block px-4 py-1.5 bg-pink-100 text-pink-600 text-xs font-black uppercase tracking-widest rounded-full mb-6 italic">New Arrivals</span>
                    <h1 class="text-6xl md:text-8xl font-black text-gray-900 leading-tight mb-8 italic">
                        UPGRADE <span class="text-pink-600">YOUR</span><br>
                        LIFESTYLE
                    </h1>
                    <p class="text-lg text-gray-500 leading-relaxed mb-10 max-w-lg">
                        Discover fashion-forward pieces designed for the modern trendsetter. Quality craftsmanship meets contemporary design.
                    </p>
                    <div class="flex items-center space-x-4">
                        <a href="#products" class="px-10 py-4 bg-pink-600 text-white font-bold rounded-2xl shadow-xl shadow-pink-100 hover:bg-pink-700 transition-all">Explore More</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 3 (Variation) -->
        <div x-show="activeSlide === 3" 
             x-transition:enter="transition ease-out duration-1000"
             x-transition:enter-start="opacity-0 translate-x-20"
             x-transition:enter-end="opacity-100 translate-x-0"
             class="h-full flex items-center text-center mx-auto">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto">
                    <span class="inline-block px-4 py-1.5 bg-cyan-100 text-cyan-600 text-xs font-black uppercase tracking-widest rounded-full mb-6 italic">Member Exclusive</span>
                    <h1 class="text-6xl md:text-8xl font-black text-gray-900 leading-tight mb-8 italic">
                        UNBEATABLE <span class="text-cyan-600">TRENDS</span>
                    </h1>
                    <p class="text-lg text-gray-500 leading-relaxed mb-10 max-w-2xl mx-auto">
                        Join our community for exclusive early access to our most sought-after collections and special member-only events.
                    </p>
                    <a href="{{ route('register') }}" class="px-12 py-5 bg-gray-900 text-white font-bold rounded-2xl shadow-xl hover:bg-black transition-all">Join The Club</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Controls -->
    <div class="absolute bottom-10 left-0 right-0 z-20 flex justify-center items-center space-x-4">
        <template x-for="i in totalSlides">
            <button @click="activeSlide = i" 
                    :class="activeSlide === i ? 'w-12 bg-indigo-600' : 'w-3 bg-gray-300'"
                    class="h-3 rounded-full transition-all duration-300 focus:outline-none"></button>
        </template>
    </div>

    <!-- Navigation Arrows -->
    <button @click="activeSlide = activeSlide > 1 ? activeSlide - 1 : totalSlides" class="absolute left-6 top-1/2 -translate-y-1/2 z-20 p-4 bg-white/50 backdrop-blur-sm rounded-full text-gray-800 hover:bg-white transition-all shadow-lg hidden md:block">
        <i class="fa fa-chevron-left text-xl"></i>
    </button>
    <button @click="activeSlide = activeSlide < totalSlides ? activeSlide + 1 : 1" class="absolute right-6 top-1/2 -translate-y-1/2 z-20 p-4 bg-white/50 backdrop-blur-sm rounded-full text-gray-800 hover:bg-white transition-all shadow-lg hidden md:block">
        <i class="fa fa-chevron-right text-xl"></i>
    </button>

    <!-- Auto-slide timer -->
    <div x-init="setInterval(() => { activeSlide = activeSlide < totalSlides ? activeSlide + 1 : 1 }, 6000)"></div>
</section>