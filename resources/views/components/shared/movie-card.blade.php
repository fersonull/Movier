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