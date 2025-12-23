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