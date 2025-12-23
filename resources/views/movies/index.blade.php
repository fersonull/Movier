@extends('layouts.app')

@section('title', 'Movier - Discover Great Movies')

@section('content')
    @if(!$genre)
    <section class="bg-white border-b border-zinc-200 py-16 text-center mb-0">
        <h1 class="font-outfit text-5xl mb-4 font-bold text-zinc-950 tracking-tight">Discover Great Movies</h1>
        <p class="font-outfit text-lg text-zinc-600 max-w-2xl mx-auto font-normal">Explore our curated collection of top-rated films from every genre. Find your next favorite movie today.</p>
    </section>
    @endif

    <div class="bg-white border border-zinc-200 p-8 rounded-xl my-8">
        <h2 class="font-outfit text-2xl font-semibold mb-6 text-zinc-950">Browse by Genre</h2>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('movies.index') }}" class="inline-block py-2 px-4 bg-zinc-100 text-zinc-600 no-underline rounded-md border border-zinc-200 transition-all duration-200 font-outfit font-medium text-sm hover:bg-zinc-200 hover:text-zinc-950 hover:border-zinc-300 {{ !$genre ? 'bg-zinc-950 text-white border-zinc-950' : '' }}">
                All Movies
            </a>
            @foreach($genres as $genreItem)
                <a href="{{ route('movies.index') }}?genre={{ $genreItem['name'] }}" class="inline-block py-2 px-4 bg-zinc-100 text-zinc-600 no-underline rounded-md border border-zinc-200 transition-all duration-200 font-outfit font-medium text-sm hover:bg-zinc-200 hover:text-zinc-950 hover:border-zinc-300 {{ $genre === $genreItem['name'] ? 'bg-zinc-950 text-white border-zinc-950' : '' }}">
                    {{ $genreItem['name'] }}
                </a>
            @endforeach
        </div>
    </div>

    @if($featuredMovies->isNotEmpty() && !$genre)
    <section class="mb-16 bg-white border border-zinc-200 rounded-xl p-8 mt-8">
        <h2 class="font-outfit text-3xl font-semibold mb-8 text-zinc-950 tracking-tight">Featured Movies</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featuredMovies as $movie)
                <a href="{{ route('movies.show', $movie->id) }}" class="bg-white border border-zinc-200 rounded-xl overflow-hidden transition-all duration-200 no-underline text-inherit shadow-sm hover:shadow-md hover:border-zinc-300">
                    <img src="{{ $movie->poster }}" alt="{{ $movie->title }}" class="w-full h-96 object-cover bg-zinc-100">
                    <div class="p-6">
                        <h3 class="font-outfit text-xl font-semibold mb-3 text-zinc-950 leading-tight">{{ $movie->title }}</h3>
                        <div class="flex justify-between items-center mb-3">
                            <span class="font-outfit text-zinc-500 text-sm font-medium">{{ $movie->year }}</span>
                            <div class="flex items-center gap-1 text-amber-500 font-outfit font-semibold text-sm">
                                <i data-lucide="star" class="w-3.5 h-3.5 fill-amber-500"></i>
                                <span>{{ number_format($movie->rating, 1) }}</span>
                            </div>
                        </div>
                        <div class="font-outfit text-zinc-500 text-sm mb-3 font-normal">{{ $movie->getGenresStringAttribute() }}</div>
                        <p class="font-outfit text-zinc-600 text-sm leading-relaxed font-normal line-clamp-3 overflow-hidden">{{ $movie->description }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
    @endif

    <section>
        <h2 class="font-outfit text-3xl font-semibold mb-8 text-zinc-950 tracking-tight">
            @if($genre)
                {{ $genre }} Movies
            @else
                All Movies
            @endif
        </h2>

        @if($movies->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12">
                @foreach($movies as $movie)
                    <a href="{{ route('movies.show', $movie->id) }}" class="bg-white border border-zinc-200 rounded-xl overflow-hidden transition-all duration-200 no-underline text-inherit shadow-sm hover:shadow-md hover:border-zinc-300">
                        <img src="{{ $movie->poster }}" alt="{{ $movie->title }}" class="w-full h-96 object-cover bg-zinc-100">
                        <div class="p-6">
                            <h3 class="font-outfit text-xl font-semibold mb-3 text-zinc-950 leading-tight">{{ $movie->title }}</h3>
                            <div class="flex justify-between items-center mb-3">
                                <span class="font-outfit text-zinc-500 text-sm font-medium">{{ $movie->year }}</span>
                                <div class="flex items-center gap-1 text-amber-500 font-outfit font-semibold text-sm">
                                    <i data-lucide="star" class="w-3.5 h-3.5 fill-amber-500"></i>
                                    <span>{{ number_format($movie->rating, 1) }}</span>
                                </div>
                            </div>
                            <div class="font-outfit text-zinc-500 text-sm mb-3 font-normal">{{ $movie->getGenresStringAttribute() }}</div>
                            <p class="font-outfit text-zinc-600 text-sm leading-relaxed font-normal line-clamp-3 overflow-hidden">{{ $movie->description }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 text-zinc-500 bg-white border border-zinc-200 rounded-xl my-8">
                <h3 class="font-outfit text-2xl font-semibold mb-4 text-zinc-950">No movies found</h3>
                <p class="font-outfit font-normal">Try selecting a different genre or check back later.</p>
            </div>
        @endif
    </section>
@endsection