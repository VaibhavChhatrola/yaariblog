<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') — YaariBlog</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary-color:   #003F5C;
            --primary-color-dark:  #002D42;
            --accent-color:  #A8D8C8;
            --accent-color-light: #CBE5DC;
            --accent-color-dark: #87B6A6;
            --sidebar-w: 250px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            background: #F1F5F9;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── Top Header ── */
        .admin-header {
            background: var(--primary-color);
            height: 60px;
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            border-bottom: 2px solid var(--accent-color);
            justify-content: space-between;
        }

        .admin-header .brand {
            color: #fff;
            font-size: 1.2rem;
            font-weight: 800;
            text-decoration: none;
            letter-spacing: -0.3px;
        }

        .admin-header .brand span { color: var(--accent-color); }

        .admin-header .header-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .admin-header .header-right .admin-name {
            color: #94A3B8;
            font-size: 0.875rem;
        }

        .admin-header .header-right .admin-name strong { color: var(--accent-color); }

        .logout-btn {
            background: rgba(168,216,200,0.12);
            border: 1px solid rgba(168,216,200,0.3);
            color: var(--accent-color);
            padding: 0.35rem 1rem;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.25s;
        }

        .logout-btn:hover {
            background: var(--accent-color);
            color: var(--primary-color);
        }

        /* ── Sidebar ── */
        .admin-sidebar {
            position: fixed;
            top: 60px;
            left: 0;
            width: var(--sidebar-w);
            height: calc(100vh - 60px);
            background: var(--primary-color);
            overflow-y: auto;
            border-right: 1px solid rgba(255,255,255,0.05);
            padding: 1.5rem 0;
            z-index: 900;
        }

        .sidebar-section-title {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: #475569;
            padding: 0.5rem 1.5rem;
            margin-top: 0.5rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1.5rem;
            color: #94A3B8;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            color: var(--accent-color);
            background: rgba(168,216,200,0.08);
            border-left-color: var(--accent-color);
            text-decoration: none;
        }

        .sidebar-link i { width: 18px; text-align: center; font-size: 0.95rem; }
        .sidebar-link .dropdown-arrow { margin-left: auto; transition: transform 0.3s; }
        .sidebar-link[aria-expanded="true"] .dropdown-arrow { transform: rotate(180deg); }
        .sidebar-collapse .sidebar-link { padding-left: 3rem; font-size: 0.85rem; }

        /* ── Main Content ── */
        .admin-main {
            margin-left: var(--sidebar-w);
            margin-top: 60px;
            padding: 2rem;
            min-height: calc(100vh - 60px);
            flex: 1;
        }

        /* ── Page Heading ── */
        .page-heading {
            margin-bottom: 1.8rem;
        }

        .page-heading h1 {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--primary-color);
        }

        .page-heading p {
            color: #64748B;
            font-size: 0.9rem;
            margin-top: 0.2rem;
        }

        /* ── Cards ── */
        .admin-card {
            background: #fff;
            border-radius: 14px;
            border: 1px solid #E2E8F0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            overflow: hidden;
        }

        .admin-card-header {
            padding: 1.2rem 1.5rem;
            border-bottom: 1px solid #F1F5F9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #FAFBFC;
        }

        .admin-card-header h2 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0;
        }

        .admin-card-body { padding: 1.5rem; }

        /* ── Stat Cards ── */
        .stat-card {
            background: #fff;
            border-radius: 14px;
            padding: 1.4rem;
            border: 1px solid #E2E8F0;
            box-shadow: 0 2px 6px rgba(0,0,0,0.04);
        }

        .stat-card .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            margin-bottom: 1rem;
        }

        .stat-card .stat-number {
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary-color);
            line-height: 1;
        }

        .stat-card .stat-label {
            font-size: 0.8rem;
            color: #94A3B8;
            font-weight: 500;
            margin-top: 0.3rem;
        }

        /* ── Table ── */
        .admin-table { width: 100%; border-collapse: collapse; }
        .admin-table th {
            background: #F8FAFC;
            color: #64748B;
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 0.9rem 1.2rem;
            border-bottom: 2px solid #E2E8F0;
            text-align: left;
        }
        .admin-table td {
            padding: 0.9rem 1.2rem;
            border-bottom: 1px solid #F1F5F9;
            color: #334155;
            font-size: 0.9rem;
            vertical-align: middle;
        }
        .admin-table tr:last-child td { border-bottom: none; }
        .admin-table tr:hover td { background: var(--accent-color-light); }

        /* ── Action Buttons ── */
        .btn-edit {
            background: #EFF6FF;
            color: #2563EB;
            border: 1px solid #BFDBFE;
            padding: 0.35rem 0.85rem;
            border-radius: 7px;
            font-size: 0.82rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-edit:hover {
            background: #2563EB;
            color: #fff;
            border-color: #2563EB;
            text-decoration: none;
        }

        .btn-delete {
            background: #FEF2F2;
            color: #DC2626;
            border: 1px solid #FECACA;
            padding: 0.35rem 0.85rem;
            border-radius: 7px;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-delete:hover { background: #DC2626; color: #fff; border-color: #DC2626; }

        /* ── Add Blog Button ── */
        .btn-add {
            background: var(--accent-color);
            color: var(--primary-color);
            border: none;
            padding: 0.6rem 1.4rem;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.25s;
        }

        .btn-add:hover {
            background: var(--accent-color-light);
            color: var(--primary-color);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(168,216,200,0.35);
            text-decoration: none;
        }

        /* ── Form Styles ── */
        .form-label {
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.4rem;
        }

        .form-control, .form-select {
            border: 1px solid #E2E8F0;
            border-radius: 10px;
            padding: 0.7rem 1rem;
            font-size: 0.9rem;
            color: #1E293B;
            transition: all 0.2s;
            background: #FAFBFC;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(168,216,200,0.15);
            background: #fff;
            outline: none;
        }

        textarea.form-control { resize: vertical; min-height: 140px; }

        .btn-submit {
            background: var(--primary-color);
            color: #fff;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.25s;
        }

        .btn-submit:hover {
            background: var(--primary-color-dark);
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(0,63,92,0.25);
        }

        .btn-cancel {
            background: #F1F5F9;
            color: #64748B;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-cancel:hover { background: #E2E8F0; color: #334155; text-decoration: none; }

        /* ── Alert Flash Messages ── */
        .flash-success {
            background: #EAF5F1;
            border: 1px solid var(--accent-color);
            color: var(--primary-color-dark);
            border-left: 4px solid var(--accent-color-dark);
            border-radius: 10px;
            padding: 0.9rem 1.2rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .flash-error {
            background: #FEF2F2;
            border: 1px solid #FCA5A5;
            color: #991B1B;
            border-left: 4px solid #EF4444;
            border-radius: 10px;
            padding: 0.9rem 1.2rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .validation-errors {
            background: #FEF2F2;
            border: 1px solid #FCA5A5;
            border-radius: 10px;
            padding: 1rem 1.2rem;
            margin-bottom: 1.5rem;
        }

        .validation-errors ul { margin: 0; padding-left: 1.2rem; }
        .validation-errors li { color: #991B1B; font-size: 0.875rem; margin: 0.2rem 0; }

        /* ── Image Preview ── */
        #image-preview-container { margin-top: 0.75rem; }
        #image-preview {
            max-width: 200px;
            border-radius: 10px;
            border: 2px solid #E2E8F0;
            display: none;
        }

        /* ── Category badges in table ── */
        .badge-admit { background:#EEF2FF; color:#4338CA; border:1px solid #C7D2FE; border-radius:50px; padding:0.25rem 0.7rem; font-size:0.75rem; font-weight:600; }
        .badge-result { background:#ECFDF5; color:#065F46; border:1px solid #A7F3D0; border-radius:50px; padding:0.25rem 0.7rem; font-size:0.75rem; font-weight:600; }
        .badge-news   { background:#FFFBEB; color:#92400E; border:1px solid #FDE68A; border-radius:50px; padding:0.25rem 0.7rem; font-size:0.75rem; font-weight:600; }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .admin-sidebar { display: none; }
            .admin-main    { margin-left: 0; padding: 1rem; }
        }
    </style>
</head>
<body>

    {{-- ── Top Header ── --}}
    <header class="admin-header">
        <a href="{{ route('admin.dashboard') }}" class="brand">Job<span>Yaari</span> Admin</a>
        <div class="header-right">
            <span class="admin-name d-none d-md-inline">
                Logged in as <strong>{{ auth()->guard('admin')->user()->name ?? 'Admin' }}</strong>
            </span>
            <form method="POST" action="{{ route('admin.logout') }}" style="margin:0;">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                </button>
            </form>
        </div>
    </header>

    {{-- ── Sidebar ── --}}
    <aside class="admin-sidebar">
        <div class="sidebar-section-title">Main</div>
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-th-large"></i> Dashboard
        </a>

        {{-- Blogs Dropdown --}}
        <a href="#blogsSubmenu" data-bs-toggle="collapse" class="sidebar-link {{ request()->routeIs('admin.blogs.*') ? '' : 'collapsed' }}" aria-expanded="{{ request()->routeIs('admin.blogs.*') ? 'true' : 'false' }}">
            <i class="fas fa-layer-group"></i> Blogs
            <i class="fas fa-chevron-down dropdown-arrow"></i>
        </a>
        <div class="collapse {{ request()->routeIs('admin.blogs.*') ? 'show' : '' }} sidebar-collapse" id="blogsSubmenu">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">All Blogs</a>
            <a href="{{ route('admin.blogs.create') }}" class="sidebar-link {{ request()->routeIs('admin.blogs.create') ? 'active' : '' }}">Add Blog</a>
        </div>

        {{-- Categories Dropdown --}}
        <a href="#categoriesSubmenu" data-bs-toggle="collapse" class="sidebar-link {{ request()->routeIs('admin.categories.*') ? '' : 'collapsed' }}" aria-expanded="{{ request()->routeIs('admin.categories.*') ? 'true' : 'false' }}">
            <i class="fas fa-tags"></i> Categories
            <i class="fas fa-chevron-down dropdown-arrow"></i>
        </a>
        <div class="collapse {{ request()->routeIs('admin.categories.*') ? 'show' : '' }} sidebar-collapse" id="categoriesSubmenu">
            <a href="{{ route('admin.categories.index') }}" class="sidebar-link {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}">All Categories</a>
            <a href="{{ route('admin.categories.create') }}" class="sidebar-link {{ request()->routeIs('admin.categories.create') ? 'active' : '' }}">Add Category</a>
        </div>

        <div class="sidebar-section-title" style="margin-top:1rem;">Navigate</div>
        <a href="{{ route('blogs.index') }}" class="sidebar-link" target="_blank">
            <i class="fas fa-external-link-alt"></i> View Public Site
        </a>
    </aside>

    {{-- ── Main Content ── --}}
    <main class="admin-main">
        {{-- Flash Success --}}
        @if(session('success'))
            <div class="flash-success">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        {{-- Flash Error --}}
        @if(session('error'))
            <div class="flash-error">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="validation-errors">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @stack('scripts')
</body>
</html>
