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
                    {{-- ૧. JSON સમસ્યાનું સમાધાન: $blog->category ને બદલે તેનું નામ પ્રિન્ટ કર્યું --}}
                    <span class="{{ $blog->category_badge_class }}">
                        {{ is_object($blog->category) ? $blog->category->name : $blog->category }}
                    </span>
                    <span><i class="fas fa-calendar-alt me-1"
                            style="color:#A8D8C8;"></i>{{ $blog->created_at->format('d F Y') }}</span>
                    <span><i class="fas fa-clock me-1"
                            style="color:#A8D8C8;"></i>{{ ceil(str_word_count(strip_tags($blog->content)) / 200) }} min
                        read</span>
                </div>

                <h1>{{ $blog->title }}</h1>

                {{-- Short description --}}
                <p
                    style="font-size:1.1rem; color:#94A3B8; line-height:1.7; margin-top:0.5rem; padding:1rem 1.2rem; border-left:3px solid #A8D8C8; background:rgba(168,216,200,0.05); border-radius:0 8px 8px 0;">
                    {{ $blog->short_description }}
                </p>
            </header>

            {{-- ── Featured Image ── --}}
            {{-- ૨. ઈમેજ લોડ કરવા માટે: asset() ફંક્શનનો ઉપયોગ --}}
            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="blog-detail-img"
                onerror="this.src='https://placehold.co/800x400/0D1B2A/F59E0B?text=YaariBlog'">

            {{-- ── Full Content ── --}}
            <div class="blog-detail-content">
                {{-- ૩. HTML Tags (<p>) ની સમસ્યાનું સમાધાન: {!! !!} નો ઉપયોગ --}}
                    {!! $blog->content !!}
            </div>

            {{-- ── Footer Actions ── --}}
            <div
                style="display:flex; align-items:center; justify-content:space-between; margin-top:2.5rem; flex-wrap:wrap; gap:1rem;">
                <a href="{{ route('blogs.index') }}" class="back-btn">
                    <i class="fas fa-arrow-left"></i> All Posts
                </a>
                <a href="{{ route('blogs.index') }}?category={{ urlencode(is_object($blog->category) ? $blog->category->name : $blog->category) }}"
                    class="back-btn">
                    <i class="fas fa-tag"></i> More
                    {{ is_object($blog->category) ? $blog->category->name : $blog->category }} posts
                </a>
            </div>
        </article>

    </div>

@endsection