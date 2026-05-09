<?php
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;

// ── Root Route ───────────────────────────────────────────────────────────────
Route::get('/', fn() => redirect()->route('blogs.index'));

// ── Public Blog Routes ───────────────────────────────────────────────────────
// IMPORTANT: AJAX routes must be defined BEFORE the {slug} wildcard route
Route::get('/blogs/search', [BlogController::class, 'search'])->name('blogs.search');
Route::get('/blogs/filter', [BlogController::class, 'filter'])->name('blogs.filter');
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');

// ── Admin Auth Routes (public) ───────────────────────────────────────────────
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'loginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.post');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
});

// ── Admin Protected Routes (requires auth.admin middleware) ──────────────────
Route::prefix('admin')->middleware('auth.admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/blogs/create', [AdminController::class, 'create'])->name('admin.blogs.create');
    Route::post('/blogs', [AdminController::class, 'store'])->name('admin.blogs.store');
    Route::get('/blogs/{id}/edit', [AdminController::class, 'edit'])->name('admin.blogs.edit');
    Route::put('/blogs/{id}', [AdminController::class, 'update'])->name('admin.blogs.update');
    Route::delete('/blogs/{id}', [AdminController::class, 'destroy'])->name('admin.blogs.destroy');

    // Categories routes
    Route::resource('categories', CategoryController::class)->names([
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'edit' => 'admin.categories.edit',
        'update' => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy',
    ])->except(['show']);
});
Route::get('/reset-admin-password', function () {
    $user = User::where('email', 'admin@gmail.com')->first(); // અહીં તમારો એડમિન ઈમેલ લખો

    if ($user) {
        $user->update([
            'password' => Hash::make('admin123') // અહીં તમારો નવો પાસવર્ડ લખો
        ]);
        return "Password updated successfully!";
    }

    return "User not found!";
});