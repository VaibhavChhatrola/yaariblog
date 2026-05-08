@extends('layouts.admin-layout')

@section('title', 'Add New Blog — Admin')

@section('content')

<div class="page-heading">
    <h1>Add New Blog Post</h1>
    <p>Fill in the details below to publish a new post</p>
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <h2><i class="fas fa-plus-circle me-2" style="color:#A8D8C8;"></i>Create Blog Post</h2>
        <a href="{{ route('admin.dashboard') }}" class="btn-cancel">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
    </div>

    <div class="admin-card-body">
        <form method="POST" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data" id="create-form">
            @csrf

            <div class="row g-4">

                {{-- Row 1: Title --}}
                <div class="col-md-12">
                    <label class="form-label" for="title">
                        Blog Title <span style="color:#EF4444;">*</span>
                    </label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title') }}"
                        placeholder="e.g. SSC CGL 2024 Admit Card Released"
                        required
                        maxlength="255"
                    >
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div style="margin-top:0.4rem;">
                        <span style="color:#94A3B8; font-size:0.82rem;">Slug: </span>
                        <span id="slug-preview" style="color:#64748B; font-size:0.82rem; font-family:monospace;">will-be-auto-generated</span>
                    </div>
                </div>

                {{-- Row 2: Category & Status --}}
                <div class="col-md-6">
                    <label class="form-label" for="category_id">
                        Category <span style="color:#EF4444;">*</span>
                    </label>
                    <select
                        id="category_id"
                        name="category_id"
                        class="form-select @error('category_id') is-invalid @enderror"
                        required
                    >
                        <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>— Select Category —</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label" for="status">
                        Status <span style="color:#EF4444;">*</span>
                    </label>
                    <select
                        id="status"
                        name="status"
                        class="form-select @error('status') is-invalid @enderror"
                        required
                    >
                        <option value="Active" {{ old('status', 'Active') === 'Active' ? 'selected' : '' }}>🟢 Active</option>
                        <option value="Inactive" {{ old('status') === 'Inactive' ? 'selected' : '' }}>🔴 Inactive</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Row 3: Short Description --}}
                <div class="col-md-12">
                    <label class="form-label" for="short_description">
                        Short Description <span style="color:#EF4444;">*</span>
                        <small style="color:#94A3B8; font-weight:400;">(max 500 chars — shown on listing cards)</small>
                    </label>
                    <textarea
                        id="short_description"
                        name="short_description"
                        class="form-control @error('short_description') is-invalid @enderror"
                        rows="3"
                        placeholder="Write a brief summary of this blog post..."
                        required
                        maxlength="500"
                    >{{ old('short_description') }}</textarea>
                    @error('short_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Row 4: Image Upload --}}
                <div class="col-md-12">
                    <label class="form-label" for="image">
                        Featured Image <span style="color:#EF4444;">*</span>
                        <small style="color:#94A3B8; font-weight:400;">(JPG, PNG, WebP — max 2MB)</small>
                    </label>

                    <label for="image" style="
                        display:block;
                        border:2px dashed #E2E8F0;
                        border-radius:12px;
                        padding:1.5rem;
                        text-align:center;
                        cursor:pointer;
                        background:#FAFBFC;
                        transition:all 0.2s;
                        margin-bottom:0.75rem;
                    " id="upload-area">
                        <i class="fas fa-cloud-upload-alt" style="font-size:2rem; color:#94A3B8; margin-bottom:0.5rem; display:block;"></i>
                        <span style="color:#64748B; font-size:0.875rem;" id="upload-label">Click to select image</span>
                    </label>

                    <input
                        type="file"
                        id="image"
                        name="image"
                        class="@error('image') is-invalid @enderror"
                        accept="image/jpeg,image/png,image/webp"
                        required
                        style="display:none;"
                    >

                    <div id="image-preview-container" style="display:none; margin-top:0.75rem;">
                        <img id="image-preview" src="" alt="Preview" style="max-width:300px; border-radius:10px; border:2px solid #E2E8F0;">
                    </div>

                    @error('image')
                        <div style="color:#EF4444; font-size:0.8rem; margin-top:0.4rem;">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Row 5: Full Content --}}
                <div class="col-md-12">
                    <label class="form-label" for="content">
                        Full Content <span style="color:#EF4444;">*</span>
                    </label>
                    <textarea
                        id="content"
                        name="content"
                        class="form-control @error('content') is-invalid @enderror"
                        rows="15"
                        placeholder="Write the full blog content here..."
                    >{{ old('content') }}</textarea>
                    @error('content')
                        <div class="invalid-feedback" style="display:block;">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Action Buttons --}}
                <div class="col-md-12 d-flex justify-content-end gap-3 mt-4">
                    <a href="{{ route('admin.dashboard') }}" class="btn-cancel d-flex align-items-center justify-content-center" style="padding: 0 1.5rem;">
                        Cancel
                    </a>
                    <button type="submit" class="btn-submit" style="min-width: 180px;">
                        <i class="fas fa-save me-2"></i> Publish Blog Post
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function () {

    // ── Slug Preview (live from title input) ──────────────────────────────────
    $('#title').on('keyup input', function () {
        const title = $(this).val().trim();
        // Mimic Laravel's Str::slug behaviour client-side
        const slug = title
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .replace(/^-|-$/g, '');

        $('#slug-preview').text(slug || 'will-be-auto-generated');
    });

    // ── Image Upload Preview ──────────────────────────────────────────────────
    $('#image').on('change', function () {
        const file = this.files[0];
        if (!file) return;

        // Update upload label with filename
        $('#upload-label').text(file.name);
        $('#upload-area').css('border-color', '#A8D8C8');

        // Show image preview using FileReader
        const reader = new FileReader();
        reader.onload = function (e) {
            $('#image-preview').attr('src', e.target.result);
            $('#image-preview-container').show();
        };
        reader.readAsDataURL(file);
    });

    // ── Upload area hover effect ──────────────────────────────────────────────
    $('#upload-area').on('dragover', function (e) {
        e.preventDefault();
        $(this).css({ borderColor: '#A8D8C8', background: '#FFFBEB' });
    }).on('dragleave', function () {
        $(this).css({ borderColor: '#E2E8F0', background: '#FAFBFC' });
    }).on('drop', function (e) {
        e.preventDefault();
        const file = e.originalEvent.dataTransfer.files[0];
        if (file) {
            // Trigger the file input change
            const dt = new DataTransfer();
            dt.items.add(file);
            document.getElementById('image').files = dt.files;
            $('#image').trigger('change');
        }
    });

    // ── TinyMCE Initialization ─────────────────────────────────────────────
    // Moved outside $(document).ready() since TinyMCE manages its own lifecycle.
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#content',
        plugins: 'preview searchreplace autolink directionality code visualblocks visualchars fullscreen image link media table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap emoticons',
        menubar: 'file edit view insert format tools table help',
        toolbar: 'undo redo | bold italic underline strikethrough superscript subscript | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview print | image media link anchor codesample | ltr rtl',
        toolbar_sticky: true,
        height: 500,
        image_caption: true,
        toolbar_mode: 'sliding',
        contextmenu: 'link image table',
        promotion: false, // Hides the 'Upgrade' button
        branding: false   // Hides the 'Powered by TinyMCE' branding
    });
</script>
@endpush
