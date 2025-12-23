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
            @include('components.layout.navigation')
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