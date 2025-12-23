<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Movier - Movie Rating Platform')</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'outfit': ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    @yield('styles')
</head>
<body class="font-outfit leading-relaxed text-zinc-950 bg-zinc-50">
    <header class="bg-white border-b border-zinc-200 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-6">
            <nav class="flex justify-between items-center py-4 md:flex-col md:gap-4">
                <a href="{{ route('movies.index') }}" class="text-3xl md:text-2xl font-bold text-zinc-950 no-underline tracking-tight">Movier</a>
                <ul class="flex list-none gap-2 md:flex-wrap md:justify-center">
                    <li>
                        <a href="{{ route('movies.index') }}" class="flex items-center gap-2 px-4 py-2 no-underline text-zinc-500 font-medium text-sm rounded-md transition-all duration-200 hover:bg-zinc-100 hover:text-zinc-950 {{ !request()->get('genre') && request()->routeIs('movies.index') ? 'bg-zinc-950 text-white' : '' }} md:px-3 md:py-1.5 md:text-xs">
                            <i data-lucide="home" class="w-4 h-4 md:w-3.5 md:h-3.5 sm:w-4.5 sm:h-4.5"></i>
                            <span class="sm:hidden">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('movies.index') }}?genre=Action" class="flex items-center gap-2 px-4 py-2 no-underline text-zinc-500 font-medium text-sm rounded-md transition-all duration-200 hover:bg-zinc-100 hover:text-zinc-950 {{ request()->get('genre') == 'Action' ? 'bg-zinc-950 text-white' : '' }} md:px-3 md:py-1.5 md:text-xs">
                            <i data-lucide="zap" class="w-4 h-4 md:w-3.5 md:h-3.5 sm:w-4.5 sm:h-4.5"></i>
                            <span class="sm:hidden">Action</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('movies.index') }}?genre=Drama" class="flex items-center gap-2 px-4 py-2 no-underline text-zinc-500 font-medium text-sm rounded-md transition-all duration-200 hover:bg-zinc-100 hover:text-zinc-950 {{ request()->get('genre') == 'Drama' ? 'bg-zinc-950 text-white' : '' }} md:px-3 md:py-1.5 md:text-xs">
                            <i data-lucide="heart" class="w-4 h-4 md:w-3.5 md:h-3.5 sm:w-4.5 sm:h-4.5"></i>
                            <span class="sm:hidden">Drama</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('movies.index') }}?genre=Comedy" class="flex items-center gap-2 px-4 py-2 no-underline text-zinc-500 font-medium text-sm rounded-md transition-all duration-200 hover:bg-zinc-100 hover:text-zinc-950 {{ request()->get('genre') == 'Comedy' ? 'bg-zinc-950 text-white' : '' }} md:px-3 md:py-1.5 md:text-xs">
                            <i data-lucide="smile" class="w-4 h-4 md:w-3.5 md:h-3.5 sm:w-4.5 sm:h-4.5"></i>
                            <span class="sm:hidden">Comedy</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('movies.index') }}?genre=Sci-Fi" class="flex items-center gap-2 px-4 py-2 no-underline text-zinc-500 font-medium text-sm rounded-md transition-all duration-200 hover:bg-zinc-100 hover:text-zinc-950 {{ request()->get('genre') == 'Sci-Fi' ? 'bg-zinc-950 text-white' : '' }} md:px-3 md:py-1.5 md:text-xs">
                            <i data-lucide="rocket" class="w-4 h-4 md:w-3.5 md:h-3.5 sm:w-4.5 sm:h-4.5"></i>
                            <span class="sm:hidden">Sci-Fi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('movies.index') }}?genre=Thriller" class="flex items-center gap-2 px-4 py-2 no-underline text-zinc-500 font-medium text-sm rounded-md transition-all duration-200 hover:bg-zinc-100 hover:text-zinc-950 {{ request()->get('genre') == 'Thriller' ? 'bg-zinc-950 text-white' : '' }} md:px-3 md:py-1.5 md:text-xs">
                            <i data-lucide="eye" class="w-4 h-4 md:w-3.5 md:h-3.5 sm:w-4.5 sm:h-4.5"></i>
                            <span class="sm:hidden">Thriller</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="min-h-screen py-8">
        <div class="max-w-6xl mx-auto px-6">
            @yield('content')
        </div>
    </main>

    <footer class="bg-zinc-950 text-zinc-50 text-center py-8 mt-12 border-t border-zinc-200">
        <div class="max-w-6xl mx-auto px-6">
            <p>&copy; {{ date('Y') }} Movier. A movie rating platform demo.</p>
        </div>
    </footer>

    @yield('scripts')
    <script>
        lucide.createIcons();
    </script>
</body>
</html>