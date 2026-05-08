<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // ─── Authentication ─────────────────────────────────────────────────────────

    /**
     * Show the admin login form.
     * If already authenticated, redirect to dashboard.
     */
    public function loginForm()
    {
        // Redirect authenticated admins away from the login page
        if (auth()->guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    /**
     * Handle admin login form submission.
     * Uses the custom 'admin' guard to authenticate against the admins table.
     */
    public function login(Request $request)
    {
        // Validate inputs before attempting authentication
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Attempt login with the admin guard (separate from default 'web' guard)
        if (auth()->guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            // Regenerate session to prevent session fixation attacks
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')
                             ->with('success', 'Welcome back, ' . auth()->guard('admin')->user()->name . '!');
        }

        // Authentication failed — return with error (withErrors keeps old input)
        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Log out the admin and invalidate the session.
     */
    public function logout(Request $request)
    {
        auth()->guard('admin')->logout();

        // Invalidate the session and regenerate the CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
                         ->with('success', 'You have been logged out successfully.');
    }

    // ─── Dashboard / Blog Listing ────────────────────────────────────────────────

    /**
     * Display all blogs in the admin dashboard with pagination.
     */
    public function dashboard()
    {
        // Paginate 10 blogs per page, latest first
        $blogs = Blog::latest()->paginate(10);
        return view('admin.dashboard', compact('blogs'));
    }

    // ─── Create Blog ─────────────────────────────────────────────────────────────

    /**
     * Show the form for creating a new blog post.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.create', compact('categories'));
    }

    /**
     * Store a new blog post in the database.
     * Handles image upload to storage/app/public/blogs/.
     */
    public function store(Request $request)
    {
        // Validate all incoming fields
        $validated = $request->validate([
            'title'             => ['required', 'string', 'max:255'],
            'short_description' => ['required', 'string', 'max:500'],
            'content'           => ['required', 'string'],
            'category_id'       => ['required', 'exists:categories,id'],
            'status'            => ['required', 'in:Active,Inactive'],
            // Image is required on create; accepts jpg, jpeg, png, webp; max 2MB
            'image'             => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        // Generate a unique slug from the title (appends a short random string if taken)
        $slug = $this->generateUniqueSlug($validated['title']);

        // Handle image upload — store in storage/app/public/blogs/
        $imagePath = $request->file('image')->store('blogs', 'public');

        Blog::create([
            'title'             => $validated['title'],
            'slug'              => $slug,
            'short_description' => $validated['short_description'],
            'content'           => $validated['content'],
            'category_id'       => $validated['category_id'],
            'status'            => $validated['status'],
            'image'             => $imagePath,
        ]);

        return redirect()->route('admin.dashboard')
                         ->with('success', 'Blog post created successfully!');
    }

    // ─── Edit Blog ───────────────────────────────────────────────────────────────

    /**
     * Show the form for editing an existing blog post.
     */
    public function edit(int $id)
    {
        // Find by primary key — returns 404 if not found
        $blog = Blog::findOrFail($id);
        $categories = Category::orderBy('name')->get();
        return view('admin.edit', compact('blog', 'categories'));
    }

    /**
     * Update an existing blog post.
     * Image upload is optional on update — existing image is kept if no new one provided.
     */
    public function update(Request $request, int $id)
    {
        $blog = Blog::findOrFail($id);

        $validated = $request->validate([
            'title'             => ['required', 'string', 'max:255'],
            'short_description' => ['required', 'string', 'max:500'],
            'content'           => ['required', 'string'],
            'category_id'       => ['required', 'exists:categories,id'],
            'status'            => ['required', 'in:Active,Inactive'],
            'image'             => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        // Regenerate slug from new title
        $slug = $this->generateUniqueSlug($validated['title'], $blog->id);

        // Handle optional image replacement
        $imagePath = $blog->image; // Keep existing image by default
        if ($request->hasFile('image')) {
            // Delete the old image from storage to avoid orphan files
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $imagePath = $request->file('image')->store('blogs', 'public');
        }

        // Update the blog record
        $blog->update([
            'title'             => $validated['title'],
            'slug'              => $slug,
            'short_description' => $validated['short_description'],
            'content'           => $validated['content'],
            'category_id'       => $validated['category_id'],
            'status'            => $validated['status'],
            'image'             => $imagePath,
        ]);

        return redirect()->route('admin.dashboard')
                         ->with('success', 'Blog post updated successfully!');
    }

    // ─── Delete Blog ─────────────────────────────────────────────────────────────

    /**
     * Delete a blog post and its associated image from storage.
     */
    public function destroy(int $id)
    {
        $blog = Blog::findOrFail($id);

        // Delete the image file from disk before removing the DB record
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return redirect()->route('admin.dashboard')
                         ->with('success', 'Blog post deleted successfully.');
    }

    // ─── Private Helper ──────────────────────────────────────────────────────────

    /**
     * Generate a URL-safe unique slug from a given title.
     * If the slug is already taken (by a different record), appends a short random string.
     *
     * @param  string   $title  The blog title to slugify
     * @param  int|null $except ID of the blog being updated (excluded from uniqueness check)
     * @return string
     */
    private function generateUniqueSlug(string $title, ?int $except = null): string
    {
        $base = Str::slug($title); // Convert "My Blog Post" → "my-blog-post"
        $slug = $base;
        $i    = 1;

        // Keep trying incremented slugs until we find a unique one
        while (
            Blog::where('slug', $slug)
                ->when($except, fn($q) => $q->where('id', '!=', $except))
                ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}
