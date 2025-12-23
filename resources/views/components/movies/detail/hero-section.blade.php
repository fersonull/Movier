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