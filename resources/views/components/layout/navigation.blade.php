<nav class="flex justify-between items-center py-4 md:flex-col md:gap-4">
    <a href="{{ route('movies.index') }}" class="text-3xl md:text-2xl font-bold text-zinc-950 no-underline tracking-tight">Movier</a>
    <ul class="flex list-none gap-2 md:flex-wrap md:justify-center">
        <li>
            <a href="{{ route('movies.index') }}" class="flex items-center gap-2 px-4 py-2 no-underline font-medium text-sm rounded-md transition-all duration-200 hover:bg-zinc-100 hover:text-zinc-950 {{ !request()->get('genre') && request()->routeIs('movies.index') ? 'bg-zinc-950 text-white' : 'text-zinc-500' }} md:px-3 md:py-1.5 md:text-xs">
                <i data-lucide="home" class="w-4 h-4 md:w-3.5 md:h-3.5 sm:w-4.5 sm:h-4.5"></i>
                <span class="sm:hidden">Home</span>
            </a>
        </li>
        <li>
            <a href="{{ route('movies.index') }}?genre=Action" class="flex items-center gap-2 px-4 py-2 no-underline font-medium text-sm rounded-md transition-all duration-200 hover:bg-zinc-100 hover:text-zinc-950 {{ request()->get('genre') == 'Action' ? 'bg-zinc-950 text-white' : 'text-zinc-500' }} md:px-3 md:py-1.5 md:text-xs">
                <i data-lucide="zap" class="w-4 h-4 md:w-3.5 md:h-3.5 sm:w-4.5 sm:h-4.5"></i>
                <span class="sm:hidden">Action</span>
            </a>
        </li>
        <li>
            <a href="{{ route('movies.index') }}?genre=Drama" class="flex items-center gap-2 px-4 py-2 no-underline font-medium text-sm rounded-md transition-all duration-200 hover:bg-zinc-100 hover:text-zinc-950 {{ request()->get('genre') == 'Drama' ? 'bg-zinc-950 text-white' : 'text-zinc-500' }} md:px-3 md:py-1.5 md:text-xs">
                <i data-lucide="heart" class="w-4 h-4 md:w-3.5 md:h-3.5 sm:w-4.5 sm:h-4.5"></i>
                <span class="sm:hidden">Drama</span>
            </a>
        </li>
        <li>
            <a href="{{ route('movies.index') }}?genre=Comedy" class="flex items-center gap-2 px-4 py-2 no-underline font-medium text-sm rounded-md transition-all duration-200 hover:bg-zinc-100 hover:text-zinc-950 {{ request()->get('genre') == 'Comedy' ? 'bg-zinc-950 text-white' : 'text-zinc-500' }} md:px-3 md:py-1.5 md:text-xs">
                <i data-lucide="smile" class="w-4 h-4 md:w-3.5 md:h-3.5 sm:w-4.5 sm:h-4.5"></i>
                <span class="sm:hidden">Comedy</span>
            </a>
        </li>
        <li>
            <a href="{{ route('movies.index') }}?genre=Sci-Fi" class="flex items-center gap-2 px-4 py-2 no-underline font-medium text-sm rounded-md transition-all duration-200 hover:bg-zinc-100 hover:text-zinc-950 {{ request()->get('genre') == 'Sci-Fi' ? 'bg-zinc-950 text-white' : 'text-zinc-500' }} md:px-3 md:py-1.5 md:text-xs">
                <i data-lucide="rocket" class="w-4 h-4 md:w-3.5 md:h-3.5 sm:w-4.5 sm:h-4.5"></i>
                <span class="sm:hidden">Sci-Fi</span>
            </a>
        </li>
        <li>
            <a href="{{ route('movies.index') }}?genre=Thriller" class="flex items-center gap-2 px-4 py-2 no-underline font-medium text-sm rounded-md transition-all duration-200 hover:bg-zinc-100 hover:text-zinc-950 {{ request()->get('genre') == 'Thriller' ? 'bg-zinc-950 text-white' : 'text-zinc-500' }} md:px-3 md:py-1.5 md:text-xs">
                <i data-lucide="eye" class="w-4 h-4 md:w-3.5 md:h-3.5 sm:w-4.5 sm:h-4.5"></i>
                <span class="sm:hidden">Thriller</span>
            </a>
        </li>
    </ul>
</nav>