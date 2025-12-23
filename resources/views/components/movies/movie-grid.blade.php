<section>
    <h2 class="font-outfit text-3xl font-semibold mb-8 text-zinc-950 tracking-tight">
        @if($search)
            Search Results for "{{ $search }}"
            @if($genre)
                in {{ $genre }}
            @endif
        @elseif($genre)
            {{ $genre }} Movies
        @else
            All Movies
        @endif
    </h2>

    @if($movies->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12">
            @foreach($movies as $movie)
                @include('components.shared.movie-card', ['movie' => $movie])
            @endforeach
        </div>
    @else
        <div class="text-center py-16 text-zinc-500 bg-white border border-zinc-200 rounded-xl my-8">
            <h3 class="font-outfit text-2xl font-semibold mb-4 text-zinc-950">No movies found</h3>
            <p class="font-outfit font-normal">Try selecting a different genre or check back later.</p>
        </div>
    @endif
</section>