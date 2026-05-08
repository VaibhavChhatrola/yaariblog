@extends('layouts.blog')

@section('title', $blog->title . ' — YaariBlog')
@section('meta_description', $blog->excerpt)

@section('content')

<div class="blog-detail-wrapper">

    {{-- ── Back Button ── --}}
    <a href="{{ route('blogs.index') }}" class="back-btn">
        <i class="fas fa-arrow-left"></i> Back to Blogs
    </a>

    {{-- ── Article Header ── --}}
    <article>
        <header class="blog-detail-header">
            <div class="blog-detail-meta">
                <span class="{{ $blog->category_badge_class }}">{{ $blog->category }}</span>
                <span><i class="fas fa-calendar-alt me-1" style="color:#A8D8C8;"></i>{{ $blog->created_at->format('d F Y') }}</span>
                <span><i class="fas fa-clock me-1" style="color:#A8D8C8;"></i>{{ ceil(str_word_count(strip_tags($blog->content)) / 200) }} min read</span>
            </div>

            <h1>{{ $blog->title }}</h1>

            {{-- Short description as a styled lead paragraph --}}
            <p style="font-size:1.1rem; color:#94A3B8; line-height:1.7; margin-top:0.5rem; padding:1rem 1.2rem; border-left:3px solid #A8D8C8; background:rgba(168,216,200,0.05); border-radius:0 8px 8px 0;">
                {{ $blog->short_description }}
            </p>
        </header>

        {{-- ── Featured Image ── --}}
        <img
            src="{{ $blog->image_url }}"
            alt="{{ $blog->title }}"
            class="blog-detail-img"
            onerror="this.src='https://placehold.co/800x400/0D1B2A/F59E0B?text=YaariBlog'"
        >

        {{-- ── Full Content ── --}}
        <div class="blog-detail-content">
            {!! nl2br(e($blog->content)) !!}
        </div>

        {{-- ── Footer Actions ── --}}
        <div style="display:flex; align-items:center; justify-content:space-between; margin-top:2.5rem; flex-wrap:wrap; gap:1rem;">
            <a href="{{ route('blogs.index') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i> All Posts
            </a>
            <a href="{{ route('blogs.index') }}?category={{ urlencode($blog->category) }}" class="back-btn">
                <i class="fas fa-tag"></i> More {{ $blog->category }} posts
            </a>
        </div>
    </article>

</div>

@endsection
