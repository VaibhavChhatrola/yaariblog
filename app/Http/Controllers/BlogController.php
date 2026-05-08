<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // ─── Public Blog Listing ────────────────────────────────────────────────────

    public function index(Request $request)
    {
        $categories = Category::orderBy('name')->get();
        $categorySlug = $request->input('category');

        $blogsQuery = Blog::with('category')->where('status', 'Active');

        if (!empty($categorySlug) && $categorySlug !== 'All') {
            $blogsQuery->byCategory($categorySlug);
        }

        $blogs = $blogsQuery->latest()->paginate(9);

        return view('blogs.index', compact('blogs', 'categories'));
    }

    // ─── Blog Detail Page ───────────────────────────────────────────────────────

    public function show(string $slug)
    {
        $blog = Blog::where('slug', $slug)->where('status', 'Active')->firstOrFail();

        return view('blogs.show', compact('blog'));
    }

    // ─── AJAX: Live Search ──────────────────────────────────────────────────────

    public function search(Request $request)
    {
        $query    = $request->input('q', '');       
        $category = $request->input('category', ''); 

        $blogsQuery = Blog::with('category')->where('status', 'Active');

        if (!empty($query)) {
            $blogsQuery->search($query); 
        }

        if (!empty($category) && $category !== 'All') {
            $blogsQuery->byCategory($category);
        }

        $blogs = $blogsQuery->latest()->get();

        return response()->json([
            'success' => true,
            'count'   => $blogs->count(),
            'blogs'   => $blogs->map(fn($blog) => $this->blogToArray($blog)),
        ]);
    }

    // ─── AJAX: Category Filter ──────────────────────────────────────────────────

    public function filter(Request $request)
    {
        $category = $request->input('category', 'All');
        $query    = $request->input('q', '');

        $blogsQuery = Blog::with('category')->where('status', 'Active');

        if (!empty($category) && $category !== 'All') {
            $blogsQuery->byCategory($category);
        }

        if (!empty($query)) {
            $blogsQuery->search($query);
        }

        $blogs = $blogsQuery->latest()->get();

        return response()->json([
            'success' => true,
            'count'   => $blogs->count(),
            'blogs'   => $blogs->map(fn($blog) => $this->blogToArray($blog)),
        ]);
    }

    // ─── Private Helper ─────────────────────────────────────────────────────────

    private function blogToArray(Blog $blog): array
    {
        return [
            'id'                => $blog->id,
            'title'             => $blog->title,
            'slug'              => $blog->slug,
            'short_description' => $blog->excerpt, 
            'category'          => $blog->category ? $blog->category->name : 'None',
            'category_badge'    => $blog->category_badge_class, 
            'image_url'         => $blog->image_url,            
            'created_at'        => $blog->created_at->format('d M Y'),
            'url'               => route('blogs.show', $blog->slug),
        ];
    }
}
