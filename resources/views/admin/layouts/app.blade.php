<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Administration') - GSN</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --sidebar-w: 270px;
            --primary: #202080;
            --primary-dark: #10154c;
            --primary-soft: #204080;
            --primary-light: #eef3ff;
            --accent: #e0c020;
            --accent-light: #ffe020;
            --accent-soft: #faf7df;
            --danger: #dc2626;
            --success: #5f7c2f;
            --gray-50: #f6f8ff;
            --gray-100: #ebf0fb;
            --gray-200: #d8e0f0;
            --gray-300: #bcc7de;
            --gray-400: #8894b1;
            --gray-500: #5f6c88;
            --gray-600: #44506a;
            --gray-700: #2a3550;
            --gray-800: #1b2540;
            --gray-900: #10162f;
            --radius: 14px;
            --shadow: 0 20px 45px rgba(16, 21, 76, .08);
        }
        body {
            font-family: 'Inter', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(224, 192, 32, .12), transparent 22%),
                radial-gradient(circle at top right, rgba(32, 32, 128, .08), transparent 20%),
                linear-gradient(180deg, #f7f9ff 0%, #edf2fb 100%);
            color: var(--gray-800);
            min-height: 100vh;
        }
        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: var(--sidebar-w);
            background: linear-gradient(180deg, var(--primary-dark) 0%, var(--primary) 55%, #16256c 100%);
            color: #fff;
            display: flex;
            flex-direction: column;
            z-index: 100;
            transition: transform .3s;
        }
        .sidebar-brand {
            padding: 1.35rem 1.5rem;
            display: flex;
            align-items: center;
            gap: .85rem;
            border-bottom: 1px solid rgba(255, 255, 255, .08);
            font-weight: 700;
            letter-spacing: .03em;
        }
        .sidebar-brand img { width: 38px; height: 38px; }
        .sidebar-brand strong { display: block; font-size: 1rem; }
        .sidebar-brand span { color: rgba(255, 255, 255, .66); font-size: .76rem; text-transform: uppercase; }
        .sidebar-nav { flex: 1; padding: 1rem 0; overflow-y: auto; }
        .sidebar-section {
            padding: .8rem 1.5rem .4rem;
            font-size: .7rem;
            text-transform: uppercase;
            letter-spacing: .12em;
            color: rgba(255, 255, 255, .45);
            font-weight: 700;
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .75rem 1.5rem;
            color: rgba(255, 255, 255, .78);
            text-decoration: none;
            font-size: .9rem;
            font-weight: 500;
            border-left: 3px solid transparent;
            transition: all .18s;
        }
        .sidebar-link i { width: 18px; text-align: center; }
        .sidebar-link:hover { color: #fff; background: rgba(255, 224, 32, .10); }
        .sidebar-link.active {
            color: #fff;
            background: rgba(224, 192, 32, .18);
            border-left-color: var(--accent);
        }
        .sidebar-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, .08);
            display: flex;
            align-items: center;
            gap: .75rem;
        }
        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            color: var(--primary-dark);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }
        .user-info { flex: 1; min-width: 0; }
        .user-name {
            color: #fff;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .user-role { color: rgba(255, 255, 255, .6); font-size: .78rem; }
        .main { margin-left: var(--sidebar-w); min-height: 100vh; }
        .topbar {
            position: sticky;
            top: 0;
            z-index: 50;
            background: rgba(247, 249, 255, .92);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(32, 64, 128, .12);
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }
        .topbar-left { display: flex; align-items: center; gap: 1rem; }
        .topbar-left h1 { font-size: 1.2rem; color: var(--gray-900); }
        .breadcrumb { display: flex; align-items: center; gap: .4rem; color: var(--gray-500); font-size: .8rem; }
        .breadcrumb a { color: var(--primary); text-decoration: none; }
        .topbar-right { display: flex; align-items: center; gap: .75rem; flex-wrap: wrap; }
        .content { padding: 2rem; }
        .content-shell { display: grid; gap: 1.5rem; }
        .btn-site, .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .45rem;
            border-radius: 999px;
            font-size: .84rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all .18s;
            border: none;
            font-family: inherit;
        }
        .btn-site {
            padding: .55rem 1rem;
            color: var(--primary);
            background: rgba(32, 64, 128, .08);
            border: 1px solid rgba(32, 64, 128, .16);
        }
        .btn-site:hover { background: var(--primary); color: #fff; }
        .btn { padding: .62rem 1rem; border-radius: 12px; }
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-soft));
            color: #fff;
            box-shadow: 0 10px 22px rgba(32, 32, 128, .18);
        }
        .btn-primary:hover { background: linear-gradient(135deg, var(--primary-dark), var(--primary)); }
        .btn-secondary { background: #fff; color: var(--gray-700); border: 1px solid var(--gray-300); }
        .btn-secondary:hover { background: var(--accent-soft); border-color: rgba(224, 192, 32, .28); }
        .btn-danger { background: var(--danger); color: #fff; }
        .btn-danger:hover { background: #b91c1c; }
        .btn-success { background: var(--success); color: #fff; }
        .btn-success:hover { background: #4a5f24; }
        .btn-warning { background: #d97706; color: #fff; }
        .btn-warning:hover { background: #b45309; }
        .btn-sm { padding: .5rem .85rem; font-size: .78rem; }
        .btn-icon {
            width: 34px;
            height: 34px;
            padding: 0;
            border-radius: 10px;
            background: rgba(255, 255, 255, .1);
            color: rgba(255, 255, 255, .75);
        }
        .btn-icon:hover { background: rgba(255, 255, 255, .18); color: #fff; }
        .card {
            background: rgba(255, 255, 255, .95);
            border: 1px solid rgba(216, 224, 240, .92);
            border-radius: 22px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }
        .card-header {
            padding: 1.15rem 1.4rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
            border-bottom: 1px solid var(--gray-100);
        }
        .card-header h2 { font-size: 1rem; color: var(--gray-900); }
        .card-body { padding: 0; }
        .card-body.padded { padding: 1.4rem; }
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 1rem;
        }
        .stat-card {
            background: rgba(255, 255, 255, .94);
            border: 1px solid rgba(226, 232, 240, .95);
            border-radius: 20px;
            padding: 1.2rem 1.25rem;
            display: flex;
            align-items: center;
            gap: .9rem;
            box-shadow: var(--shadow);
        }
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }
        .stat-icon.green { background: #edf4df; color: var(--success); }
        .stat-icon.amber { background: var(--accent-soft); color: #9b7b00; }
        .stat-icon.blue { background: var(--primary-light); color: var(--primary); }
        .stat-icon.purple { background: #eef3ff; color: var(--primary-soft); }
        .stat-value { font-size: 1.8rem; font-weight: 700; color: var(--gray-900); line-height: 1; }
        .stat-label { margin-top: .18rem; color: var(--gray-500); font-size: .82rem; }
        .badge {
            display: inline-flex;
            align-items: center;
            gap: .3rem;
            padding: .3rem .72rem;
            border-radius: 999px;
            font-size: .74rem;
            font-weight: 700;
        }
        .badge-green { background: #edf4df; color: var(--success); }
        .badge-amber { background: var(--accent-soft); color: #9b7b00; }
        .badge-blue { background: var(--primary-light); color: var(--primary); }
        .badge-purple { background: #eef3ff; color: var(--primary-soft); }
        .badge-gray { background: var(--gray-100); color: var(--gray-600); }
        .table-wrap { overflow-x: auto; }
        .tab-link {
            padding: .75rem 1rem;
            color: var(--gray-600);
            text-decoration: none;
            font-weight: 500;
            border-bottom: 2px solid transparent;
            transition: all .18s;
        }
        .tab-link:hover { color: var(--primary); }
        .tab-link.active {
            color: var(--primary);
            border-bottom-color: var(--primary);
        }
        table { width: 100%; border-collapse: collapse; font-size: .88rem; }
        thead th {
            text-align: left;
            padding: .82rem 1rem;
            background: var(--gray-50);
            color: var(--gray-500);
            font-size: .74rem;
            letter-spacing: .06em;
            text-transform: uppercase;
            border-bottom: 1px solid var(--gray-200);
        }
        tbody td {
            padding: .95rem 1rem;
            border-bottom: 1px solid var(--gray-100);
            vertical-align: top;
        }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover { background: rgba(250, 247, 223, .45); }
        .actions { display: flex; align-items: center; justify-content: flex-end; gap: .4rem; }
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.1rem;
        }
        .form-group { display: flex; flex-direction: column; gap: .35rem; }
        .form-group.full { grid-column: 1 / -1; }
        .form-label { font-size: .82rem; font-weight: 700; color: var(--gray-700); }
        .form-input, .form-select {
            width: 100%;
            padding: .78rem .95rem;
            border: 1px solid var(--gray-300);
            border-radius: 14px;
            font-size: .9rem;
            font-family: inherit;
            background: #fff;
            color: var(--gray-800);
        }
        textarea.form-input { min-height: 130px; resize: vertical; }
        .form-input:focus, .form-select:focus {
            outline: none;
            border-color: rgba(25, 53, 109, .45);
            box-shadow: 0 0 0 4px rgba(25, 53, 109, .08);
        }
        .form-error { color: var(--danger); font-size: .78rem; }
        .form-hint { color: var(--gray-500); font-size: .78rem; }
        .search-bar {
            display: flex;
            align-items: center;
            gap: .55rem;
            padding: 0 .8rem;
            background: #fff;
            border: 1px solid var(--gray-300);
            border-radius: 14px;
        }
        .search-bar input {
            width: 220px;
            border: none;
            background: transparent;
            padding: .7rem 0;
            font: inherit;
            outline: none;
        }
        .search-bar i { color: var(--gray-400); }
        .alert {
            padding: .9rem 1rem;
            border-radius: 16px;
            display: flex;
            align-items: center;
            gap: .5rem;
            font-size: .9rem;
            font-weight: 600;
        }
        .alert-success { background: #ebf9f0; color: #166534; border: 1px solid #bde5c8; }
        .alert-error { background: #fff1f2; color: #9f1239; border: 1px solid #fecdd3; }
        .empty-state {
            text-align: center;
            padding: 2.6rem 1.5rem;
            color: var(--gray-500);
        }
        .empty-state i { font-size: 2.4rem; color: var(--gray-300); margin-bottom: .75rem; }
        .pagination { display: flex; justify-content: center; padding: 1rem; }
        .pagination nav { display: flex; }
        .pagination svg { width: 16px; height: 16px; }
        .sidebar-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--gray-700);
            font-size: 1.15rem;
            cursor: pointer;
        }
        .module-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1rem;
        }
        .module-card {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            padding: 1.2rem;
            border-radius: 20px;
            border: 1px solid var(--gray-200);
            background: linear-gradient(180deg, rgba(255,255,255,.98) 0%, rgba(248,250,252,.95) 100%);
        }
        .module-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: .75rem;
        }
        .module-title { font-size: 1rem; font-weight: 700; color: var(--gray-900); }
        .module-copy { font-size: .86rem; line-height: 1.6; color: var(--gray-500); }
        .module-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: .75rem;
        }
        .stack-list { display: grid; gap: .85rem; }
        .stack-item {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: .9rem;
            padding-bottom: .85rem;
            border-bottom: 1px solid var(--gray-100);
        }
        .stack-item:last-child { border-bottom: none; padding-bottom: 0; }
        .stack-title { font-weight: 600; color: var(--gray-900); }
        .stack-subtitle { font-size: .82rem; color: var(--gray-500); margin-top: .2rem; }
        .toggle-input {
            width: 18px;
            height: 18px;
            accent-color: var(--primary);
        }
        @media (max-width: 900px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main { margin-left: 0; }
            .sidebar-toggle { display: inline-flex; }
            .topbar, .content { padding-inline: 1rem; }
        }
        @media (max-width: 640px) {
            .search-bar input { width: 100%; min-width: 0; }
            .content { padding-top: 1rem; }
        }
    </style>
</head>
<body>
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <img src="{{ asset('images/logo-gsn.png') }}" alt="GSN">
            <div>
                <strong>GSN Admin</strong>
                <span>Gestion du site scout</span>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="sidebar-section">Principal</div>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge-high"></i> Tableau de bord
            </a>

            @if(auth()->user()->hasPermission('gerer_utilisateurs') || auth()->user()->isSuperAdmin())
                <div class="sidebar-section">Administration</div>
                <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i> Utilisateurs
                </a>
            @endif

            @if(auth()->user()->hasPermission('gerer_roles') || auth()->user()->isSuperAdmin())
                <a href="{{ route('admin.roles.index') }}" class="sidebar-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-shield-halved"></i> Roles & permissions
                </a>
            @endif

            @if(auth()->user()->hasPermission('gerer_parametres') || auth()->user()->isSuperAdmin())
                <div class="sidebar-section">Structure</div>
                <a href="{{ route('admin.scout-units.index') }}" class="sidebar-link {{ request()->routeIs('admin.scout-units.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-tents"></i> Unites
                </a>
                <a href="{{ route('admin.program-events.index') }}" class="sidebar-link {{ request()->routeIs('admin.program-events.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-calendar-days"></i> Programme
                </a>
                <a href="{{ route('admin.site-settings.index') }}" class="sidebar-link {{ request()->routeIs('admin.site-settings.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-sliders"></i> Parametres
                </a>
            @endif

            @if(auth()->user()->hasPermission('gerer_publications') || auth()->user()->isSuperAdmin() || auth()->user()->hasPermission('gerer_galerie') || auth()->user()->hasPermission('gerer_membres'))
                <div class="sidebar-section">Contenu</div>
            @endif

            @if(auth()->user()->hasPermission('gerer_publications') || auth()->user()->isSuperAdmin())
                <a href="{{ route('admin.publications.index') }}" class="sidebar-link {{ request()->routeIs('admin.publications.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-newspaper"></i> Publications
                </a>
            @endif

            @if(auth()->user()->hasPermission('gerer_galerie') || auth()->user()->isSuperAdmin())
                <a href="{{ route('admin.gallery-items.index') }}" class="sidebar-link {{ request()->routeIs('admin.gallery-items.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-images"></i> Galerie
                </a>
            @endif

            @if(auth()->user()->hasPermission('gerer_membres') || auth()->user()->isSuperAdmin())
                <a href="{{ route('admin.members.index') }}" class="sidebar-link {{ request()->routeIs('admin.members.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-id-card"></i> Membres
                </a>
            @endif

            <div class="sidebar-section">Site</div>
            <a href="{{ url('/') }}" class="sidebar-link" target="_blank">
                <i class="fa-solid fa-arrow-up-right-from-square"></i> Voir le site
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div class="user-info">
                <div class="user-name">{{ auth()->user()->name }}</div>
                <div class="user-role">{{ auth()->user()->role->name ?? 'Aucun role' }}</div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-icon" title="Deconnexion">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </button>
            </form>
        </div>
    </aside>

    <div class="main">
        <div class="topbar">
            <div class="topbar-left">
                <button class="sidebar-toggle" type="button" onclick="document.getElementById('sidebar').classList.toggle('open')">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div>
                    <h1>@yield('title', 'Tableau de bord')</h1>
                    <div class="breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Admin</a>
                        <i class="fa-solid fa-chevron-right" style="font-size: .55rem;"></i>
                        @yield('breadcrumb', 'Tableau de bord')
                    </div>
                </div>
            </div>
            <div class="topbar-right">
                <a href="{{ route('home') }}" class="btn-site" target="_blank">
                    <i class="fa-solid fa-globe"></i> Voir le site
                </a>
            </div>
        </div>

        <div class="content">
            <div class="content-shell">
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-error">
                        <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
