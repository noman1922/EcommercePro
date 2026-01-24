<div class="space-y-16">
    <!-- Section Header -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
        <div class="max-w-xl">
            <h2 class="text-4xl font-extrabold text-gray-900 leading-tight">
                Our <span class="text-indigo-600 block sm:inline">Latest Collections</span>
            </h2>
            <p class="mt-4 text-gray-500 text-lg">Browse through our curated selection of high-quality fashion items delivered right to your doorstep.</p>
        </div>
        
        <!-- Search Bar (Modern) -->
        <div class="w-full md:w-auto">
            <form action="{{url('product_search')}}" method="GET" class="relative group">
                @csrf
                <input 
                    type="text" 
                    name="search" 
                    class="w-full md:w-80 pl-12 pr-4 py-4 rounded-2xl bg-white border-gray-100 shadow-sm focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 transition-all text-sm font-medium" 
                    placeholder="Search by name or category..."
                >
                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-indigo-500 transition-colors">
                    <i class="fa fa-search"></i>
                </div>
                <button type="submit" class="hidden">Search</button>
            </form>
        </div>
    </div>

    <!-- Alert Messages (Modern) -->
    @if(session()->has('message'))
    <div class="p-4 rounded-2xl bg-green-50 border border-green-100 text-green-700 flex items-center justify-between shadow-sm animate-pulse">
        <div class="flex items-center">
            <i class="fa fa-check-circle mr-3 text-lg"></i>
            <span class="font-bold">{{session()->get('message')}}</span>
        </div>
        <button type="button" class="text-green-400 hover:text-green-600 transition" onclick="this.parentElement.remove()">
            <i class="fa fa-times"></i>
        </button>
    </div>
    @endif

    <!-- Product Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-10">
        @foreach($product as $item)
            <div class="group bg-white rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 overflow-hidden flex flex-col">
                <!-- Image Container -->
                <div class="relative aspect-square overflow-hidden bg-gray-50">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="product/{{$item->image}}" alt="{{$item->title}}">
                    
                    <!-- Hover Actions Overlay -->
                    <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-4">
                        <a href="{{url('product_details',$item->id)}}" class="p-4 bg-white text-gray-900 rounded-full shadow-xl translate-y-10 group-hover:translate-y-0 transition-transform duration-300 hover:bg-gray-50">
                            <i class="fa fa-eye text-xl"></i>
                        </a>
                    </div>

                    @if($item->discount_price != null)
                        <div class="absolute top-6 left-6 px-4 py-1.5 bg-red-500 text-white text-[10px] font-black uppercase tracking-widest rounded-full shadow-lg">Save {{ round((($item->price - $item->discount_price) / $item->price) * 100) }}%</div>
                    @endif
                </div>

                <!-- Product Details -->
                <div class="p-8 flex flex-col flex-1">
                    <div class="flex items-start justify-between gap-4 mb-4">
                        <div>
                            <span class="text-[10px] font-bold text-indigo-500 uppercase tracking-widest mb-1 block">{{ $item->catagory }}</span>
                            <h3 class="text-xl font-bold text-gray-900 group-hover:text-indigo-600 transition-colors line-clamp-1 italic">{{$item->title}}</h3>
                        </div>
                        <div class="text-right">
                            @if($item->discount_price != null)
                                <span class="block text-2xl font-black text-gray-900 italic">${{$item->discount_price}}</span>
                                <span class="block text-sm font-bold text-gray-400 line-through italic">${{$item->price}}</span>
                            @else
                                <span class="block text-2xl font-black text-gray-900 italic">${{$item->price}}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mt-auto pt-6 border-t border-gray-50 flex items-center justify-between gap-4">
                        <form action="{{url('add_cart',$item->id)}}" method="POST" class="flex items-center gap-2 w-full">
                            @csrf
                            <input type="number" name="quantity" value="1" min="1" class="w-16 px-2 py-2.5 rounded-xl border-gray-200 bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition font-bold text-sm text-center">
                            <button type="submit" class="flex-1 py-3 bg-gray-900 text-white font-bold rounded-xl hover:bg-indigo-600 active:scale-95 transition-all flex items-center justify-center space-x-2">
                                <i class="fa fa-shopping-basket text-sm"></i>
                                <span>Add to Cart</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination (Modern) -->
    <div class="mt-20 pt-10 border-t border-gray-100 flex justify-center">
        <div class="tailwind-pagination">
            {!! $product->withQueryString()->links() !!}
        </div>
    </div>
</div>

<style>
    /* Custom styles to match the premium theme */
    .tailwind-pagination nav div:first-child { display: none; }
    .tailwind-pagination nav span[aria-current="page"] span { @apply bg-indigo-600 text-white border-indigo-600 rounded-lg shadow-lg shadow-indigo-100; }
    .tailwind-pagination nav a { @apply rounded-lg border-gray-100 hover:bg-indigo-50 hover:text-indigo-600 transition-all hover:border-indigo-100; }
</style>