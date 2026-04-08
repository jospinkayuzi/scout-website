@php
    $navItems = [
        ['label' => 'Accueil', 'href' => route('home'), 'active' => request()->routeIs('home')],
        ['label' => 'Programme', 'href' => route('site.program'), 'active' => request()->routeIs('site.program')],
        ['label' => 'Galerie', 'href' => route('site.gallery'), 'active' => request()->routeIs('site.gallery')],
        ['label' => 'Publications', 'href' => route('site.publications'), 'active' => request()->routeIs('site.publications')],
        ['label' => 'Membres', 'href' => route('site.members'), 'active' => request()->routeIs('site.members')],
        ['label' => 'Inscription', 'href' => route('site.join'), 'active' => request()->routeIs('site.join')],
    ];
    $hasViteAssets = file_exists(public_path('hot')) || file_exists(public_path('build/manifest.json'));
@endphp
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Groupe Scout Saint Nicolas')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @if ($hasViteAssets)
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('assets/site.css') }}">
        <script src="{{ asset('assets/site.js') }}" defer></script>
    @endif
    @stack('styles')
</head>
<body>
    <header class="site-header">
        <div class="nav-shell">
            <a href="{{ route('home') }}" class="brand">
                <img src="{{ asset('images/logo-gsn.png') }}" alt="GSN">
                <div class="brand-name">Groupe Scout <span>Saint Nicolas</span></div>
            </a>

            <ul class="nav-links">
                @foreach($navItems as $item)
                    <li><a href="{{ $item['href'] }}" class="nav-link {{ $item['active'] ? 'active' : '' }}">{{ $item['label'] }}</a></li>
                @endforeach
            </ul>

            <div class="nav-actions">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="btn-outline btn-login"><i class="fa-solid fa-gauge-high"></i> Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-outline btn-login"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
                @endauth
                <button type="button" class="nav-toggle" id="navToggle"><i class="fa-solid fa-bars"></i></button>
            </div>
        </div>

        <div class="mobile-menu" id="mobileMenu">
            @foreach($navItems as $item)
                <a href="{{ $item['href'] }}">{{ $item['label'] }}</a>
            @endforeach
            @auth
                <a href="{{ route('admin.dashboard') }}">Dashboard admin</a>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth
        </div>
    </header>

    @hasSection('hero')
        @yield('hero')
    @else
        <section class="page-banner">
            <div class="page-banner-shell">
                <div class="page-kicker">@yield('page_kicker', 'Groupe Scout Saint Nicolas')</div>
                <h1 class="page-title">@yield('page_title', 'Page <span>GSN</span>')</h1>
                <p class="page-summary">@yield('page_summary', 'Une experience multi-pages moderne, structuree et branchee sur les donnees dynamiques du site.')</p>
            </div>
        </section>
    @endif

    <main>@yield('content')</main>

    <footer class="footer">
        <div class="footer-shell">
            <div>
                <div class="brand" style="align-items:flex-start;">
                    <img src="{{ asset('images/logo-gsn.png') }}" alt="GSN">
                    <div>
                        <div class="footer-title">Groupe Scout Saint Nicolas</div>
                        <p class="footer-copy">Toujours Prêt à Servir!</p>
                    </div>
                </div>
            </div>
            <div>
                <div class="footer-title">Navigation</div>
                <ul class="footer-list">
                    @foreach($navItems as $item)
                        <li><a href="{{ $item['href'] }}">{{ $item['label'] }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div>
                <div class="footer-title">Contact</div>
                <ul class="footer-list">
                    <li><i class="fa-solid fa-envelope"></i> {{ $contact['email'] ?? 'contact@gsn.bi' }}</li>
                    <li><i class="fa-solid fa-phone"></i> {{ $contact['phone'] ?? '+257 79 00 00 00' }}</li>
                    <li><i class="fa-solid fa-location-dot"></i> {{ $contact['address'] ?? 'Bujumbura, Burundi' }}</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <span>&copy; {{ now()->year }} Groupe Scout Saint Nicolas</span>
            <span>Bonne Chasse à toi qui garde la loi</span>
        </div>
    </footer>

    <script>
        const navToggle = document.getElementById('navToggle');
        const mobileMenu = document.getElementById('mobileMenu');

        navToggle?.addEventListener('click', () => {
            mobileMenu?.classList.toggle('open');
        });

        // Tab navigation
        document.querySelectorAll('.tab-link').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const targetId = link.getAttribute('href').substring(1);
                const targetSection = document.getElementById(targetId);
                if (targetSection) {
                    targetSection.scrollIntoView({ behavior: 'smooth' });
                }
                document.querySelectorAll('.tab-link').forEach(l => l.classList.remove('active'));
                link.classList.add('active');
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
