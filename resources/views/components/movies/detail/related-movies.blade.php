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