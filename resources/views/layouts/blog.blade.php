<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'YaariBlog') — Stay Informed</title>
    <meta name="description" content="@yield('meta_description', 'YaariBlog — Latest Admit Cards, Results, and News for job seekers.')">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    {{-- Blog Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
    @stack('styles')
</head>
<body>

    {{-- ── Loading Overlay (shown during AJAX requests) ── --}}
    <div id="loading-overlay" aria-label="Loading">
        <div class="spinner-ring"></div>
    </div>

    {{-- ── Navigation ── --}}
    <nav class="blog-navbar navbar navbar-expand-lg">
        <div class="container-blog" style="display:flex; align-items:center; justify-content:space-between; width:100%; max-width:1200px; margin:0 auto; padding:0 1.5rem;">
            <a class="navbar-brand" href="{{ route('blogs.index') }}">
                Yaari<span>Blog</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#blogNav" aria-label="Toggle navigation">
                <i class="fas fa-bars" style="color:#A8D8C8;"></i>
            </button>
            <div class="collapse navbar-collapse" id="blogNav">
                <ul class="navbar-nav ms-auto align-items-center gap-1">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blogs.index') }}">
                            <i class="fas fa-home me-1"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blogs.index') }}?category=admit-card" data-category="admit-card">
                            Admit Cards
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blogs.index') }}?category=result" data-category="result">
                            Results
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blogs.index') }}?category=news" data-category="news">
                            News
                        </a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="nav-link nav-admin-btn" href="{{ route('admin.login') }}">
                            <i class="fas fa-lock me-1"></i> Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- ── Page Content ── --}}
    @yield('content')

    {{-- ── Footer ── --}}
    <footer class="blog-footer">
        <div class="container-blog">
            <p>© {{ date('Y') }} <span>YaariBlog</span>. All rights reserved. &nbsp;|&nbsp; Stay ahead, stay informed.</p>
        </div>
    </footer>

    {{-- ── Scripts ── --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('js/blog-ajax.js') }}"></script>
    @stack('scripts')
</body>
</html>
