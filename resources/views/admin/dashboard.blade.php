@extends('layouts.admin-layout')

@section('title', 'Dashboard — Admin')

@section('content')

<div class="page-heading">
    <h1>Dashboard</h1>
    <p>Manage all blog posts from here</p>
</div>

{{-- ── Stat Cards ── --}}
@php
    $totalBlogs = \App\Models\Blog::count();
    $totalCategories = \App\Models\Category::count();
    $activeBlogs = \App\Models\Blog::where('status', 'Active')->count();
    $inactiveBlogs = \App\Models\Blog::where('status', 'Inactive')->count();
@endphp

<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#EFF6FF; color:#2563EB;">
                <i class="fas fa-layer-group"></i>
            </div>
            <div class="stat-number">{{ $totalBlogs }}</div>
            <div class="stat-label">Total Blogs</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#EEF2FF; color:#4338CA;">
                <i class="fas fa-tags"></i>
            </div>
            <div class="stat-number">{{ $totalCategories }}</div>
            <div class="stat-label">Total Categories</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#ECFDF5; color:#059669;">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-number">{{ $activeBlogs }}</div>
            <div class="stat-label">Active Blogs</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#FFFBEB; color:#87B6A6;">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="stat-number">{{ $inactiveBlogs }}</div>
            <div class="stat-label">Inactive Blogs</div>
        </div>
    </div>
</div>

{{-- ── Blogs Table ── --}}
<div class="admin-card">
    <div class="admin-card-header">
        <h2><i class="fas fa-list me-2" style="color:#A8D8C8;"></i>Recent Blog Posts</h2>
        <a href="{{ route('admin.blogs.create') }}" class="btn-add">
            <i class="fas fa-plus"></i> Add New Blog
        </a>
    </div>

    <div style="overflow-x:auto;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($blogs as $blog)
                <tr>
                    <td style="color:#94A3B8; font-size:0.8rem;">{{ $blog->id }}</td>

                    <td>
                        <img
                            src="{{ $blog->image_url }}"
                            alt="{{ $blog->title }}"
                            style="width:56px; height:40px; object-fit:cover; border-radius:8px; border:1px solid #E2E8F0;"
                            onerror="this.src='https://placehold.co/56x40/F1F5F9/94A3B8?text=?'"
                        >
                    </td>

                    <td>
                        <div style="font-weight:600; color:#1E293B; max-width:280px;">{{ Str::limit($blog->title, 55) }}</div>
                        <div style="font-size:0.78rem; color:#94A3B8; margin-top:2px;">{{ Str::limit($blog->short_description, 60) }}</div>
                    </td>

                    <td>
                        <span class="badge" style="background:#EEF2FF; color:#4338CA; border:1px solid #C7D2FE; border-radius:50px; padding:0.25rem 0.7rem; font-size:0.75rem; font-weight:600;">
                            {{ $blog->category->name ?? 'None' }}
                        </span>
                    </td>
                    
                    <td>
                        @if($blog->status == 'Active')
                            <span class="badge" style="background:#ECFDF5; color:#065F46; border:1px solid #A7F3D0; border-radius:50px; padding:0.25rem 0.7rem; font-size:0.75rem; font-weight:600;">Active</span>
                        @else
                            <span class="badge" style="background:#FEF2F2; color:#991B1B; border:1px solid #FCA5A5; border-radius:50px; padding:0.25rem 0.7rem; font-size:0.75rem; font-weight:600;">Inactive</span>
                        @endif
                    </td>

                    <td style="color:#64748B; font-size:0.85rem; white-space:nowrap;">
                        {{ $blog->created_at->format('d M Y') }}
                    </td>

                    <td style="text-align:right; white-space:nowrap;">
                        {{-- View on public site --}}
                        <a href="{{ route('blogs.show', $blog->slug) }}" target="_blank"
                           class="btn-edit" style="margin-right:4px;" title="View Post">
                            <i class="fas fa-eye"></i>
                        </a>

                        {{-- Edit --}}
                        <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn-edit" style="margin-right:4px;">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>

                        {{-- Delete (uses a form for DELETE method) --}}
                        <form method="POST" action="{{ route('admin.blogs.destroy', $blog->id) }}"
                              style="display:inline;"
                              onsubmit="return confirm('Are you sure you want to delete this blog post? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">
                                <i class="fas fa-trash me-1"></i>Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center; padding:3rem; color:#94A3B8;">
                        <div style="font-size:2.5rem; margin-bottom:0.75rem;">📭</div>
                        <p style="font-size:1rem; font-weight:600; margin-bottom:0.4rem;">No blog posts yet</p>
                        <a href="{{ route('admin.blogs.create') }}" style="color:#A8D8C8; font-size:0.875rem;">Create your first post →</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($blogs->hasPages())
        <div style="padding:1rem 1.5rem; border-top:1px solid #F1F5F9;">
            {{ $blogs->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

@endsection
