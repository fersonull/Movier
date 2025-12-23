@if($featuredMovies->isNotEmpty() && !$genre)
<section class="mb-16 bg-white border border-zinc-200 rounded-xl p-8 mt-8">
    <h2 class="font-outfit text-3xl font-semibold mb-8 text-zinc-950 tracking-tight">Featured Movies</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($featuredMovies as $movie)
            @include('components.shared.movie-card', ['movie' => $movie])
        @endforeach
    </div>
</section>
@endif