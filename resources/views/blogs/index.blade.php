@extends('layouts.blog')

@section('title', 'YaariBlog — Latest Admit Cards, Results & News')
@section('meta_description', 'Browse the latest Admit Cards, Results, and News for government job seekers on YaariBlog.')

@section('content')

{{-- ── Hero Section ── --}}
<section class="blog-hero">
    <div class="container-blog">
        <h1>Yaari<span>Blog</span></h1>
        <p>Your one-stop destination for the latest <strong>Admit Cards</strong>, <strong>Results</strong>, and <strong>Job News</strong> — updated daily.</p>

        {{-- ── Search Bar ── --}}
        <div class="search-container">
            <input
                type="text"
                id="search-input"
                class="search-input"
                placeholder="Search blogs by title..."
                autocomplete="off"
                aria-label="Search blog posts"
            >
            <i class="fas fa-search search-icon"></i>
        </div>
    </div>
</section>

{{-- ── Category Filter Buttons ── --}}
<section class="filter-section">
    <div class="container-blog">
        <button class="filter-btn active" data-category="All">
            <i class="fas fa-globe me-1"></i> All Posts
        </button>
        @foreach($categories as $cat)
        <button class="filter-btn" data-category="{{ $cat->slug }}">
            <i class="fas fa-tags me-1"></i> {{ $cat->name }}
        </button>
        @endforeach

        {{-- Result count (updated via JS) --}}
        <span id="result-count" class="result-count"></span>
    </div>
</section>

{{-- ── Blog Grid ── --}}
<section style="padding: 0 0 2rem;">
    <div class="container-blog">

        {{-- The grid element carries data attributes used by blog-ajax.js --}}
        <div
            id="blog-grid"
            class="blog-grid"
            data-search-url="{{ route('blogs.search') }}"
            data-filter-url="{{ route('blogs.filter') }}"
            data-initial-count="{{ $blogs->total() }}"
        >
            @forelse($blogs as $blog)
                {{-- ── Single Blog Card ── --}}
                <a href="{{ route('blogs.show', $blog->slug) }}" class="blog-card">
                    <div class="blog-card-img-wrapper">
                        <img
                            src="{{ $blog->image_url }}"
                            alt="{{ $blog->title }}"
                            loading="lazy"
                            onerror="this.src='https://placehold.co/800x400/0D1B2A/F59E0B?text=YaariBlog'"
                        >
                    </div>
                    <div class="blog-card-body">
                        <h3 class="blog-card-title">{{ $blog->title }}</h3>
                        <p class="blog-card-excerpt">{{ $blog->excerpt }}</p>
                        <div class="blog-card-footer">
                            <span class="{{ $blog->category_badge_class }}">{{ $blog->category ? $blog->category->name : 'None' }}</span>
                            <span class="blog-card-date">{{ $blog->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </a>
            @empty
                {{-- Shown when no blogs exist in the database --}}
                <div style="grid-column:1/-1; text-align:center; padding:5rem 2rem;">
                    <div style="font-size:3.5rem; margin-bottom:1rem;">📭</div>
                    <h3 style="color:#F1F5F9; font-size:1.4rem; font-weight:700; margin-bottom:0.5rem;">No blogs published yet</h3>
                    <p style="color:#94A3B8;">Check back soon or <a href="{{ route('admin.login') }}" style="color:#A8D8C8;">add your first post</a>.</p>
                </div>
            @endforelse
        </div>

        {{-- No Results (shown by JS when AJAX returns 0 results) --}}
        <div id="no-results">
            <div class="no-results-icon">🔍</div>
            <h3>No matching posts found</h3>
            <p>Try a different keyword or select a different category.</p>
        </div>

        {{-- ── Pagination ── --}}
        @if($blogs->hasPages())
            <div class="blog-pagination">
                {{ $blogs->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>
</section>

@endsection
