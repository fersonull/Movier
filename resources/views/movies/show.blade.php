@extends('layouts.app')

@section('title', $movie->title . ' - Movier')

@section('content')
    <a href="{{ route('movies.index') }}" class="inline-flex items-center gap-2 text-red-500 no-underline font-medium mb-8 hover:text-red-600">
        ← Back to Movies
    </a>

    <section class="bg-white border-b border-zinc-200 py-12 mb-0">
        <div class="grid grid-cols-1 lg:grid-cols-[300px_1fr] gap-16 items-start max-w-6xl mx-auto px-6">
            <img src="{{ $movie->poster }}" alt="{{ $movie->title }}" class="w-full rounded-xl border border-zinc-200 shadow-sm hover:shadow-md transition-all duration-200">
            
            <div>
                <h1 class="font-outfit text-5xl mb-6 font-bold leading-tight text-zinc-950 tracking-tight">{{ $movie->title }}</h1>
                
                <div class="flex gap-12 mb-8 flex-wrap">
                    <div class="flex flex-col gap-2">
                        <span class="font-outfit font-medium text-sm text-zinc-500 uppercase tracking-wide">Year</span>
                        <span class="font-outfit font-semibold text-base text-zinc-950">{{ $movie->year }}</span>
                    </div>
                    <div class="flex flex-col gap-2">
                        <span class="font-outfit font-medium text-sm text-zinc-500 uppercase tracking-wide">Duration</span>
                        <span class="font-outfit font-semibold text-base text-zinc-950">{{ $movie->getFormattedDurationAttribute() }}</span>
                    </div>
                    <div class="flex flex-col gap-2">
                        <span class="font-outfit font-medium text-sm text-zinc-500 uppercase tracking-wide">Director</span>
                        <span class="font-outfit font-semibold text-base text-zinc-950">{{ $movie->director }}</span>
                    </div>
                </div>

                <div class="flex items-center gap-4 mb-8 py-4">
                    <div class="flex items-center gap-1">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= floor($movie->rating))
                                <i data-lucide="star" class="w-5 h-5 text-amber-500 fill-amber-500"></i>
                            @elseif($i - 0.5 <= $movie->rating)
                                <i data-lucide="star" class="w-5 h-5 text-amber-500 fill-amber-500"></i>
                            @else
                                <i data-lucide="star" class="w-5 h-5 text-gray-300"></i>
                            @endif
                        @endfor
                    </div>
                    <div class="font-outfit text-lg font-semibold bg-zinc-100 text-zinc-950 py-2 px-4 rounded-lg border border-zinc-200">{{ number_format($movie->rating, 1) }}/5</div>
                </div>

                <div class="flex gap-3 mb-8 flex-wrap">
                    @foreach($movie->genres as $genre)
                        <span class="font-outfit bg-zinc-100 text-zinc-600 py-2 px-4 rounded-md text-sm font-medium border border-zinc-200 transition-all duration-200 hover:bg-zinc-200 hover:text-zinc-950">{{ $genre }}</span>
                    @endforeach
                </div>

                <p class="font-outfit text-base leading-relaxed mb-8 max-w-2xl text-zinc-600 font-normal">{{ $movie->description }}</p>
            </div>
        </div>
    </section>

    <section class="bg-white border border-zinc-200 rounded-xl p-12 my-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div>
                <h3 class="text-red-500 mb-2 text-lg font-outfit font-semibold">Cast</h3>
                <p class="text-zinc-600 leading-relaxed font-outfit font-normal">{{ $movie->getCastStringAttribute() }}</p>
            </div>
            <div>
                <h3 class="text-red-500 mb-2 text-lg font-outfit font-semibold">Director</h3>
                <p class="text-zinc-600 leading-relaxed font-outfit font-normal">{{ $movie->director }}</p>
            </div>
            <div>
                <h3 class="text-red-500 mb-2 text-lg font-outfit font-semibold">Release Year</h3>
                <p class="text-zinc-600 leading-relaxed font-outfit font-normal">{{ $movie->year }}</p>
            </div>
            <div>
                <h3 class="text-red-500 mb-2 text-lg font-outfit font-semibold">Duration</h3>
                <p class="text-zinc-600 leading-relaxed font-outfit font-normal">{{ $movie->getFormattedDurationAttribute() }}</p>
            </div>
        </div>
    </section>

    <section class="bg-white border border-zinc-200 rounded-xl my-12 overflow-hidden">
        <div class="bg-zinc-50 px-8 py-6 border-b border-zinc-200">
            <h2 class="flex items-center gap-4 m-0 text-2xl text-zinc-950 font-outfit font-semibold">
                User Reviews
                <span class="bg-red-500 text-white py-1 px-3 rounded-full text-sm font-medium">{{ $comments->count() }}</span>
            </h2>
        </div>

        @if($comments->isNotEmpty())
            <div class="max-h-96 overflow-y-auto">
                @foreach($comments as $comment)
                    @php
                        $user = $comment->user();
                    @endphp
                    <div class="p-8 border-b border-zinc-100 transition-colors duration-200 hover:bg-zinc-50 last:border-b-0">
                        <div class="flex items-center gap-4 mb-4">
                            @if($user && $user->avatar)
                                <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="w-12 h-12 rounded-full border-2 border-zinc-200 object-cover">
                            @else
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-semibold text-lg">
                                    {{ $user ? $user->getInitialsAttribute() : 'U' }}
                                </div>
                            @endif
                            
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="font-outfit font-semibold text-zinc-950">{{ $user ? $user->name : 'Anonymous User' }}</span>
                                    @if($user && $user->verified)
                                        <span class="text-green-500 text-sm">✓</span>
                                    @endif
                                </div>
                                <div class="flex items-center gap-4 text-zinc-500 text-sm font-outfit font-medium">
                                    <div class="flex items-center gap-2 bg-zinc-100 py-1 px-3 rounded-md border border-zinc-200">
                                        <div class="flex items-center gap-0.5">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $comment->rating)
                                                    <i data-lucide="star" class="w-3.5 h-3.5 text-amber-500 fill-amber-500"></i>
                                                @else
                                                    <i data-lucide="star" class="w-3.5 h-3.5 text-gray-300"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <span class="font-outfit text-sm text-zinc-600 font-semibold">{{ $comment->rating }}/5</span>
                                    </div>
                                    <span class="text-zinc-400">{{ $comment->getFormattedDateAttribute() }}</span>
                                    @if($user)
                                        <span>{{ $user->total_reviews }} reviews</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 font-outfit text-zinc-700 leading-relaxed">
                            {{ $comment->comment }}
                        </div>

                        <div class="flex items-center gap-2 text-zinc-500 text-sm font-outfit font-medium">
                            <i data-lucide="thumbs-up" class="w-4 h-4 text-green-500 transition-all duration-200"></i>
                            <span>{{ $comment->helpful_votes }} found this helpful</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="py-12 text-center text-zinc-500">
                <h4 class="mb-2 text-zinc-950 font-outfit font-semibold">No reviews yet</h4>
                <p class="font-outfit font-normal">Be the first to share your thoughts about this movie!</p>
            </div>
        @endif
    </section>

    @if($relatedMovies->isNotEmpty())
    <section class="mt-16">
        <h2 class="font-outfit text-3xl font-semibold mb-8 text-zinc-950 tracking-tight">More {{ $movie->genres[0] ?? 'Similar' }} Movies</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($relatedMovies as $relatedMovie)
                <a href="{{ route('movies.show', $relatedMovie->id) }}" class="bg-white border border-zinc-200 rounded-xl overflow-hidden transition-all duration-200 no-underline text-inherit shadow-sm hover:shadow-md hover:border-zinc-300">
                    <img src="{{ $relatedMovie->poster }}" alt="{{ $relatedMovie->title }}" class="w-full h-72 object-cover">
                    <div class="p-6">
                        <h3 class="font-outfit font-semibold mb-2 text-zinc-950">{{ $relatedMovie->title }}</h3>
                        <div class="flex justify-between text-zinc-500 text-sm font-outfit font-medium">
                            <span>{{ $relatedMovie->year }}</span>
                            <span class="flex items-center gap-1">
                                <i data-lucide="star" class="w-3.5 h-3.5 text-amber-500 fill-amber-500"></i>
                                {{ number_format($relatedMovie->rating, 1) }}
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
    @endif
@endsection