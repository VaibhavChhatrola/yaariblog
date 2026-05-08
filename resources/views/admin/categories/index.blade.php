@extends('layouts.admin-layout')

@section('title', 'All Categories — Admin')

@section('content')

<div class="page-heading">
    <h1>Categories</h1>
    <p>Manage all blog categories</p>
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <h2><i class="fas fa-tags me-2" style="color:#A8D8C8;"></i>All Categories</h2>
        <a href="{{ route('admin.categories.create') }}" class="btn-add">
            <i class="fas fa-plus"></i> Add Category
        </a>
    </div>

    <div style="overflow-x:auto;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Category Name</th>
                    <th>Slug</th>
                    <th>Total Blogs</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $index => $category)
                <tr>
                    <td style="color:#94A3B8; font-size:0.8rem;">{{ $categories->firstItem() + $index }}</td>
                    
                    <td>
                        <div style="font-weight:600; color:#1E293B;">{{ $category->name }}</div>
                    </td>

                    <td style="color:#64748B; font-size:0.85rem;">
                        {{ $category->slug }}
                    </td>

                    <td>
                        <span class="badge" style="background:#EEF2FF; color:#4338CA; border:1px solid #C7D2FE; border-radius:50px; padding:0.25rem 0.7rem; font-size:0.75rem; font-weight:600;">
                            {{ $category->blogs_count }}
                        </span>
                    </td>

                    <td style="text-align:right; white-space:nowrap;">
                        {{-- Edit --}}
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn-edit" style="margin-right:4px;">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>

                        {{-- Delete --}}
                        @if($category->blogs_count == 0)
                        <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}"
                              style="display:inline;"
                              onsubmit="return confirm('Are you sure you want to delete this category?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">
                                <i class="fas fa-trash me-1"></i>Delete
                            </button>
                        </form>
                        @else
                        <button type="button" class="btn-delete" style="opacity: 0.5; cursor: not-allowed;" title="Cannot delete category with blogs" disabled>
                            <i class="fas fa-trash me-1"></i>Delete
                        </button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center; padding:3rem; color:#94A3B8;">
                        <div style="font-size:2.5rem; margin-bottom:0.75rem;">🏷️</div>
                        <p style="font-size:1rem; font-weight:600; margin-bottom:0.4rem;">No categories found</p>
                        <a href="{{ route('admin.categories.create') }}" style="color:#A8D8C8; font-size:0.875rem;">Create a category →</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($categories->hasPages())
        <div style="padding:1rem 1.5rem; border-top:1px solid #F1F5F9;">
            {{ $categories->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

@endsection
