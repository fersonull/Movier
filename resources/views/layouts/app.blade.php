<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Movier - Movie Rating Platform')</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    
    <!-- CSS -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Outfit', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #0a0a0a;
            background-color: #fafafa;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        .header {
            background: #ffffff;
            border-bottom: 1px solid #e4e4e7;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }

        .logo {
            font-family: 'Outfit', sans-serif;
            font-size: 1.875rem;
            font-weight: 700;
            color: #0a0a0a;
            text-decoration: none;
            letter-spacing: -0.025em;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            text-decoration: none;
            color: #71717a;
            font-family: 'Outfit', sans-serif;
            font-weight: 500;
            font-size: 0.875rem;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .nav-link:hover {
            background: #f4f4f5;
            color: #0a0a0a;
        }

        .nav-link.active {
            background: #0a0a0a;
            color: #ffffff;
        }

        .nav-icon {
            width: 16px;
            height: 16px;
        }

        /* Main content */
        .main {
            min-height: calc(100vh - 140px);
            padding: 2rem 0;
        }

        /* Footer */
        .footer {
            background: #0a0a0a;
            color: #fafafa;
            text-align: center;
            padding: 2rem 0;
            margin-top: 3rem;
            border-top: 1px solid #e4e4e7;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav {
                flex-direction: column;
                gap: 1rem;
                padding: 1rem 0;
            }
            
            .nav-links {
                gap: 0.5rem;
                flex-wrap: wrap;
                justify-content: center;
            }

            .nav-link {
                padding: 0.375rem 0.75rem;
                font-size: 0.8125rem;
            }

            .nav-icon {
                width: 14px;
                height: 14px;
            }
            
            .container {
                padding: 0 15px;
            }

            .logo {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .nav-links {
                gap: 0.25rem;
            }

            .nav-link {
                padding: 0.25rem 0.5rem;
                font-size: 0.75rem;
            }

            .nav-link span {
                display: none;
            }

            .nav-icon {
                width: 18px;
                height: 18px;
            }
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <nav class="nav">
                <a href="{{ route('movies.index') }}" class="logo">Movier</a>
                <ul class="nav-links">
                    <li>
                        <a href="{{ route('movies.index') }}" class="nav-link {{ !request()->get('genre') && request()->routeIs('movies.index') ? 'active' : '' }}">
                            <i data-lucide="home" class="nav-icon"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('movies.index') }}?genre=Action" class="nav-link {{ request()->get('genre') == 'Action' ? 'active' : '' }}">
                            <i data-lucide="zap" class="nav-icon"></i>
                            <span>Action</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('movies.index') }}?genre=Drama" class="nav-link {{ request()->get('genre') == 'Drama' ? 'active' : '' }}">
                            <i data-lucide="heart" class="nav-icon"></i>
                            <span>Drama</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('movies.index') }}?genre=Comedy" class="nav-link {{ request()->get('genre') == 'Comedy' ? 'active' : '' }}">
                            <i data-lucide="smile" class="nav-icon"></i>
                            <span>Comedy</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('movies.index') }}?genre=Sci-Fi" class="nav-link {{ request()->get('genre') == 'Sci-Fi' ? 'active' : '' }}">
                            <i data-lucide="rocket" class="nav-icon"></i>
                            <span>Sci-Fi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('movies.index') }}?genre=Thriller" class="nav-link {{ request()->get('genre') == 'Thriller' ? 'active' : '' }}">
                            <i data-lucide="eye" class="nav-icon"></i>
                            <span>Thriller</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} Movier. A movie rating platform demo.</p>
        </div>
    </footer>

    @yield('scripts')
    
    <!-- Initialize Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>
</body>
</html>