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
            background: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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
            font-size: 1.8rem;
            font-weight: 700;
            color: #e74c3c;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        .nav-links a {
            text-decoration: none;
            color: #666;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover,
        .nav-links a.active {
            color: #e74c3c;
        }

        /* Main content */
        .main {
            min-height: calc(100vh - 140px);
            padding: 2rem 0;
        }

        /* Footer */
        .footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 2rem 0;
            margin-top: 3rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav {
                flex-direction: column;
                gap: 1rem;
            }
            
            .nav-links {
                gap: 1rem;
            }
            
            .container {
                padding: 0 15px;
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
                    <li><a href="{{ route('movies.index') }}" class="{{ request()->routeIs('movies.index') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ route('movies.index') }}?genre=Action" class="{{ request()->get('genre') == 'Action' ? 'active' : '' }}">Action</a></li>
                    <li><a href="{{ route('movies.index') }}?genre=Drama" class="{{ request()->get('genre') == 'Drama' ? 'active' : '' }}">Drama</a></li>
                    <li><a href="{{ route('movies.index') }}?genre=Comedy" class="{{ request()->get('genre') == 'Comedy' ? 'active' : '' }}">Comedy</a></li>
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
</body>
</html>