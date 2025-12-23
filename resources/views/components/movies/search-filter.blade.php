<div class="bg-white border border-zinc-200 p-8 rounded-xl my-8">
    <div class="mb-6">
        <form method="GET" action="{{ route('movies.index') }}" class="mb-6">
            <div class="flex gap-4 items-end">
                <div class="flex-1">
                    <label for="search" class="block font-outfit font-medium text-sm text-zinc-700 mb-2">Search Movies</label>
                    <input type="text" id="search" name="search" value="{{ $search }}" 
                           placeholder="Search by title, genre, or description..." 
                           class="w-full px-4 py-3 border border-zinc-300 rounded-lg font-outfit text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all">
                </div>
                <button type="submit" class="px-6 py-3 bg-red-500 text-white font-outfit font-medium text-sm rounded-lg hover:bg-red-600 transition-all duration-200 flex items-center gap-2">
                    <i data-lucide="search" class="w-4 h-4"></i>
                    Search
                </button>
                @if($search || $genre)
                    <a href="{{ route('movies.index') }}" class="px-4 py-3 bg-zinc-100 text-zinc-600 font-outfit font-medium text-sm rounded-lg hover:bg-zinc-200 transition-all duration-200">
                        Clear
                    </a>
                @endif
            </div>
            @if($genre)
                <input type="hidden" name="genre" value="{{ $genre }}">
            @endif
        </form>
    </div>

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