@extends('layouts.home')

@section('title', 'EcommercePro | Discover Premium Fashion')

@section('content')
    <!-- Hero Slider Area -->
    <div class="relative overflow-hidden bg-white">
        @include('home.slider')
    </div>

    <!-- Features Section -->
    <div class="py-12 bg-white">
        @include('home.why')
    </div>

    <!-- New Arrivals Section -->
    <div class="py-16">
        @include('home.new_arrival')
    </div>

    <!-- Products Collection -->
    <section class="py-20" id="products">
        <div class="container mx-auto px-4">
            @include('home.product')
        </div>
    </section>

    <!-- Comments Section (Upgraded) -->
    <section class="py-20 bg-gray-50 border-t border-gray-100">
        <div class="container mx-auto px-4 max-w-4xl">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">Community Voice</h2>
                <p class="mt-3 text-lg text-gray-500">Share your thoughts or ask questions about our collections.</p>
            </div>

            <!-- Comment Form -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-16 transform transition hover:shadow-md">
                <form action="{{ url('add_comment') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Leave a Comment</label>
                        <textarea 
                            name="comment" 
                            rows="4" 
                            class="w-full px-4 py-3 rounded-xl border-gray-200 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" 
                            placeholder="What's on your mind?..." 
                            required
                        ></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="px-8 py-3 bg-indigo-600 text-white font-bold rounded-xl shadow-lg shadow-indigo-100 hover:bg-indigo-700 active:scale-95 transition-all">Post Comment</button>
                    </div>
                </form>
            </div>

            <!-- Comments List -->
            <div class="space-y-8">
                <h3 class="text-xl font-bold text-gray-800 flex items-center">
                    <i class="far fa-comments mr-3 text-indigo-500"></i>
                    Recent Discussions
                </h3>
                
                @foreach($comment as $item)
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm space-y-4">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-lg mr-3 uppercase">
                                    {{ substr($item->name, 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900">{{ $item->name }}</h4>
                                    <span class="text-xs text-gray-400 font-medium">{{ $item->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <button onclick="reply(this)" data-commentid="{{ $item->id }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition">
                                <i class="fa fa-reply mr-1"></i>Reply
                            </button>
                        </div>
                        
                        <p class="text-gray-700 leading-relaxed">{{ $item->comment }}</p>

                        <!-- Replies -->
                        @if($reply->where('comment_id', $item->id)->count() > 0)
                            <div class="ml-10 mt-4 space-y-4 border-l-2 border-indigo-50 px-6 py-2">
                                @foreach($reply->where('comment_id', $item->id) as $rep)
                                    <div class="space-y-1">
                                        <div class="flex items-center space-x-2">
                                            <span class="font-bold text-sm text-gray-900">{{ $rep->name }}</span>
                                            <span class="text-[10px] text-gray-400">{{ $rep->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-sm text-gray-600 bg-gray-50 p-3 rounded-lg">{{ $rep->reply }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Sticky Reply Box (Managed by JS) -->
            <div id="replyContainer" class="hidden fixed bottom-10 left-1/2 transform -translate-x-1/2 w-full max-w-xl z-50 px-4">
                <div class="bg-white rounded-2xl shadow-2xl border border-indigo-100 p-6">
                    <form action="{{ url('add_reply') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" id="commentId" name="commentId">
                        <div class="flex justify-between items-center">
                            <h4 class="font-bold text-gray-800 text-sm italic">Replying to comment...</h4>
                            <button type="button" onclick="reply_close()" class="text-gray-400 hover:text-red-500 transition">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                        <textarea 
                            name="reply" 
                            rows="3" 
                            class="w-full px-4 py-3 rounded-xl border-gray-100 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition text-sm" 
                            placeholder="Write your reply..." 
                            required
                        ></textarea>
                        <button type="submit" class="w-full py-3 bg-indigo-600 text-white font-bold rounded-xl shadow-lg hover:bg-indigo-700 transition-all">Send Reply</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Subscriptions & Socials -->
    @include('home.subscribe')
    @include('home.client')

@endsection

@push('scripts')
    <script>
        function reply(caller) {
            document.getElementById('commentId').value = $(caller).attr('data-commentid');
            $('#replyContainer').removeClass('hidden').addClass('animate-bounce-in');
        }

        function reply_close() {
            $('#replyContainer').addClass('hidden');
        }

        // Keep scroll position on reload
        document.addEventListener("DOMContentLoaded", function(event) { 
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>
    <style>
        @keyframes bounce-in {
            0% { opacity: 0; transform: translate(-50%, 20px); }
            100% { opacity: 1; transform: translate(-50%, 0); }
        }
        .animate-bounce-in {
            animation: bounce-in 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
    </style>
@endpush