@extends('layouts.admin-layout')

@section('title', 'Edit Category — Admin')

@section('content')

<div class="page-heading">
    <h1>Edit Category</h1>
    <p>Update category details</p>
</div>

<div class="admin-card" style="max-width: 600px;">
    <div class="admin-card-header">
        <h2><i class="fas fa-edit me-2" style="color:#A8D8C8;"></i>Edit Category</h2>
        <a href="{{ route('admin.categories.index') }}" class="btn-cancel">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
    </div>

    <div class="admin-card-body">
        <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="form-label" for="name">
                    Category Name <span style="color:#EF4444;">*</span>
                </label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $category->name) }}"
                    required
                    maxlength="255"
                >
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div style="display:flex; gap:0.75rem;">
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save me-2"></i> Update Category
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
