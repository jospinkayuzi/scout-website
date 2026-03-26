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
            --sidebar-w: 260px;
            --primary: #1a2670;
            --primary-dark: #0c1445;
            --primary-light: #e8eaf6;
            --accent: #C5A028;
            --accent-light: #D4B030;
            --danger: #dc2626;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
            --radius: 8px;
            --shadow: 0 1px 3px rgba(0,0,0,.1), 0 1px 2px rgba(0,0,0,.06);
            --shadow-md: 0 4px 6px rgba(0,0,0,.07), 0 2px 4px rgba(0,0,0,.06);
        }
        body { font-family: 'Inter', sans-serif; background: var(--gray-50); color: var(--gray-800); min-height: 100vh; }

        /* Sidebar */
        .sidebar {
            position: fixed; top: 0; left: 0; bottom: 0; width: var(--sidebar-w);
            background: linear-gradient(180deg, #0c1445 0%, #1a2670 100%); color: #fff; display: flex; flex-direction: column;
            z-index: 100; transition: transform .3s;
        }
        .sidebar-brand {
            padding: 1.25rem 1.5rem; display: flex; align-items: center; gap: .75rem;
            border-bottom: 1px solid rgba(197,160,40,.2); font-weight: 700; font-size: 1.1rem;
        }
        .sidebar-brand span { color: var(--accent-light); }
        .sidebar-brand img { width: 36px; height: 36px; }
        .sidebar-nav { flex: 1; padding: 1rem 0; overflow-y: auto; }
        .sidebar-section { padding: .5rem 1.5rem .25rem; font-size: .7rem; text-transform: uppercase;
            letter-spacing: .08em; color: var(--gray-500); font-weight: 600; }
        .sidebar-link {
            display: flex; align-items: center; gap: .75rem; padding: .65rem 1.5rem;
            color: var(--gray-400); text-decoration: none; font-size: .875rem; font-weight: 500;
            transition: all .15s; border-left: 3px solid transparent;
        }
        .sidebar-link:hover { color: #fff; background: rgba(197,160,40,.08); }
        .sidebar-link.active { color: var(--accent-light); background: rgba(197,160,40,.12); border-left-color: var(--accent); }
        .sidebar-link i { width: 20px; text-align: center; font-size: .95rem; }
        .sidebar-footer {
            padding: 1rem 1.5rem; border-top: 1px solid rgba(197,160,40,.2);
            display: flex; align-items: center; gap: .75rem; font-size: .85rem;
        }
        .sidebar-footer .user-avatar {
            width: 32px; height: 32px; border-radius: 50%; background: var(--accent);
            color: var(--primary-dark);
            display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: .8rem;
        }
        .sidebar-footer .user-info { flex: 1; min-width: 0; }
        .sidebar-footer .user-name { font-weight: 600; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .sidebar-footer .user-role { color: var(--gray-500); font-size: .75rem; }

        /* Main content */
        .main { margin-left: var(--sidebar-w); min-height: 100vh; }
        .topbar {
            background: #fff; border-bottom: 1px solid var(--gray-200); padding: .75rem 2rem;
            display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 50;
        }
        .topbar-left { display: flex; align-items: center; gap: 1rem; }
        .topbar-left h1 { font-size: 1.15rem; font-weight: 700; color: var(--gray-900); }
        .breadcrumb { display: flex; align-items: center; gap: .4rem; font-size: .8rem; color: var(--gray-500); }
        .breadcrumb a { color: var(--primary); text-decoration: none; }
        .topbar-right { display: flex; align-items: center; gap: 1rem; }
        .btn-site { display: inline-flex; align-items: center; gap: .4rem; padding: .4rem .85rem;
            font-size: .8rem; color: var(--primary); border: 1px solid var(--primary); border-radius: var(--radius);
            text-decoration: none; font-weight: 500; transition: all .15s; }
        .btn-site:hover { background: var(--primary); color: #fff; }
        .content { padding: 2rem; }

        /* Cards */
        .stat-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.25rem; margin-bottom: 2rem; }
        .stat-card {
            background: #fff; border-radius: var(--radius); padding: 1.25rem 1.5rem;
            box-shadow: var(--shadow); display: flex; align-items: center; gap: 1rem;
            border: 1px solid var(--gray-200); transition: shadow .2s;
        }
        .stat-card:hover { box-shadow: var(--shadow-md); }
        .stat-icon {
            width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center;
            justify-content: center; font-size: 1.2rem;
        }
        .stat-icon.green { background: var(--primary-light); color: var(--primary); }
        .stat-icon.amber { background: #fdf6e3; color: #9a7b1a; }
        .stat-icon.blue { background: #e8eaf6; color: var(--primary); }
        .stat-icon.purple { background: #ede9fe; color: #7c3aed; }
        .stat-value { font-size: 1.75rem; font-weight: 700; line-height: 1; }
        .stat-label { font-size: .8rem; color: var(--gray-500); margin-top: .15rem; }

        /* Table */
        .card { background: #fff; border-radius: var(--radius); box-shadow: var(--shadow); border: 1px solid var(--gray-200); }
        .card-header {
            padding: 1rem 1.5rem; border-bottom: 1px solid var(--gray-200);
            display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: .75rem;
        }
        .card-header h2 { font-size: 1rem; font-weight: 600; }
        .card-body { padding: 0; }
        .card-body.padded { padding: 1.5rem; }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: .875rem; }
        thead th {
            padding: .75rem 1rem; text-align: left; font-weight: 600; font-size: .75rem;
            text-transform: uppercase; letter-spacing: .04em; color: var(--gray-500);
            background: var(--gray-50); border-bottom: 1px solid var(--gray-200);
        }
        tbody td { padding: .75rem 1rem; border-bottom: 1px solid var(--gray-100); vertical-align: middle; }
        tbody tr:hover { background: var(--gray-50); }
        tbody tr:last-child td { border-bottom: none; }

        /* Badges */
        .badge {
            display: inline-flex; align-items: center; padding: .2rem .65rem; border-radius: 999px;
            font-size: .75rem; font-weight: 600;
        }
        .badge-green { background: var(--primary-light); color: var(--primary-dark); }
        .badge-amber { background: #fdf6e3; color: #7a5f10; }
        .badge-blue { background: #e8eaf6; color: var(--primary); }
        .badge-purple { background: #ede9fe; color: #5b21b6; }
        .badge-gray { background: var(--gray-100); color: var(--gray-600); }

        /* Buttons */
        .btn {
            display: inline-flex; align-items: center; gap: .4rem; padding: .5rem 1rem;
            border-radius: var(--radius); font-size: .85rem; font-weight: 500; border: none;
            cursor: pointer; text-decoration: none; transition: all .15s; line-height: 1.4;
        }
        .btn-primary { background: var(--primary); color: #fff; }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-secondary { background: var(--gray-100); color: var(--gray-700); border: 1px solid var(--gray-300); }
        .btn-secondary:hover { background: var(--gray-200); }
        .btn-danger { background: var(--danger); color: #fff; }
        .btn-danger:hover { background: #b91c1c; }
        .btn-sm { padding: .35rem .7rem; font-size: .8rem; }
        .btn-icon { padding: .4rem; width: 32px; height: 32px; justify-content: center; }

        /* Forms */
        .form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.25rem; }
        .form-group { display: flex; flex-direction: column; gap: .35rem; }
        .form-group.full { grid-column: 1 / -1; }
        .form-label { font-size: .8rem; font-weight: 600; color: var(--gray-700); }
        .form-input, .form-select {
            padding: .55rem .85rem; border: 1px solid var(--gray-300); border-radius: var(--radius);
            font-size: .875rem; font-family: inherit; transition: border-color .15s; background: #fff;
        }
        .form-input:focus, .form-select:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(26,38,112,.1); }
        .form-error { color: var(--danger); font-size: .78rem; }
        .form-hint { color: var(--gray-500); font-size: .78rem; }

        /* Checkbox grid */
        .perm-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: .75rem; }
        .perm-item {
            display: flex; align-items: flex-start; gap: .6rem; padding: .75rem;
            border: 1px solid var(--gray-200); border-radius: var(--radius); cursor: pointer;
            transition: all .15s;
        }
        .perm-item:hover { border-color: var(--primary); background: var(--primary-light); }
        .perm-item input[type="checkbox"] {
            width: 18px; height: 18px; margin-top: 2px; accent-color: var(--primary); cursor: pointer;
        }
        .perm-name { font-weight: 600; font-size: .85rem; }
        .perm-desc { font-size: .78rem; color: var(--gray-500); }

        /* Search */
        .search-bar {
            display: flex; align-items: center; gap: .5rem; background: var(--gray-50);
            border: 1px solid var(--gray-300); border-radius: var(--radius); padding: 0 .75rem;
        }
        .search-bar i { color: var(--gray-400); font-size: .85rem; }
        .search-bar input {
            border: none; background: transparent; padding: .5rem .25rem; font-size: .85rem;
            font-family: inherit; outline: none; width: 200px;
        }

        /* Alerts */
        .alert {
            padding: .75rem 1rem; border-radius: var(--radius); font-size: .85rem; font-weight: 500;
            display: flex; align-items: center; gap: .5rem; margin-bottom: 1.25rem;
        }
        .alert-success { background: var(--primary-light); color: var(--primary-dark); border: 1px solid #c5cae9; }
        .alert-error { background: #fef2f2; color: #991b1b; border: 1px solid #fca5a5; }

        /* Actions */
        .actions { display: flex; align-items: center; gap: .35rem; }

        /* Empty state */
        .empty-state {
            text-align: center; padding: 3rem 1.5rem; color: var(--gray-500);
        }
        .empty-state i { font-size: 2.5rem; color: var(--gray-300); margin-bottom: .75rem; }

        /* Responsive */
        .sidebar-toggle { display: none; background: none; border: none; color: var(--gray-600); font-size: 1.25rem; cursor: pointer; }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main { margin-left: 0; }
            .sidebar-toggle { display: block; }
            .content { padding: 1rem; }
        }

        /* Pagination */
        .pagination { display: flex; align-items: center; justify-content: center; gap: .25rem; padding: 1rem; }
        .pagination a, .pagination span {
            padding: .4rem .75rem; border-radius: var(--radius); font-size: .8rem; text-decoration: none;
            border: 1px solid var(--gray-200); color: var(--gray-600);
        }
        .pagination a:hover { background: var(--gray-100); }
        .pagination .active span { background: var(--primary); color: #fff; border-color: var(--primary); }
        .pagination .disabled span { color: var(--gray-300); }

        /* Confirm modal */
        .modal-overlay {
            display: none; position: fixed; inset: 0; background: rgba(0,0,0,.5); z-index: 200;
            align-items: center; justify-content: center;
        }
        .modal-overlay.show { display: flex; }
        .modal-box {
            background: #fff; border-radius: 12px; padding: 2rem; max-width: 420px; width: 90%;
            text-align: center;
        }
        .modal-box i.modal-icon { font-size: 2.5rem; color: var(--danger); margin-bottom: .75rem; }
        .modal-box h3 { font-size: 1.1rem; margin-bottom: .5rem; }
        .modal-box p { font-size: .875rem; color: var(--gray-500); margin-bottom: 1.5rem; }
        .modal-actions { display: flex; gap: .75rem; justify-content: center; }
    </style>
</head>
<body>
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <img src="{{ asset('images/logo-gsn.png') }}" alt="GSN">
            <span>GSN <span>Admin</span></span>
        </div>
        <nav class="sidebar-nav">
            <div class="sidebar-section">Principal</div>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge-high"></i> Tableau de bord
            </a>

            @if(auth()->user()->hasPermission('gerer_utilisateurs') || auth()->user()->isSuperAdmin())
            <div class="sidebar-section">Gestion</div>
            <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i> Utilisateurs
            </a>
            @endif

            @if(auth()->user()->hasPermission('gerer_roles') || auth()->user()->isSuperAdmin())
            <a href="{{ route('admin.roles.index') }}" class="sidebar-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                <i class="fa-solid fa-shield-halved"></i> Rôles & Permissions
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
                <div class="user-role">{{ auth()->user()->role->name ?? 'Aucun rôle' }}</div>
            </div>
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit" class="btn-icon btn-secondary" title="Déconnexion" style="border:none;background:none;color:var(--gray-400);cursor:pointer;">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </button>
            </form>
        </div>
    </aside>

    <div class="main">
        <div class="topbar">
            <div class="topbar-left">
                <button class="sidebar-toggle" onclick="document.getElementById('sidebar').classList.toggle('open')">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div>
                    <h1>@yield('title', 'Tableau de bord')</h1>
                    <div class="breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Admin</a>
                        <i class="fa-solid fa-chevron-right" style="font-size:.6rem;"></i>
                        @yield('breadcrumb', 'Tableau de bord')
                    </div>
                </div>
            </div>
            <div class="topbar-right">
                <a href="{{ url('/') }}" class="btn-site" target="_blank">
                    <i class="fa-solid fa-globe"></i> Voir le site
                </a>
            </div>
        </div>

        <div class="content">
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
</body>
</html>
