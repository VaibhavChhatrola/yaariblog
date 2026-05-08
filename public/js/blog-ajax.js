/**
 * YaariBlog — blog-ajax.js
 * Handles live search, category filtering, and DOM updates without page reload.
 * Dependencies: jQuery (loaded in blog.blade.php)
 */

$(document).ready(function () {

    // ── State Management ──────────────────────────────────────────────────────
    // Keeps track of the current active filter and search term so they work together.
    let currentCategory = 'All';   // Active category filter button
    let currentSearch   = '';      // Current live search query
    let searchTimer     = null;    // Debounce timer for the search input

    // ── DOM References ────────────────────────────────────────────────────────
    const $grid       = $('#blog-grid');
    const $noResults  = $('#no-results');
    const $loader     = $('#loading-overlay');
    const $resultText = $('#result-count');

    // ── Utility: Show / Hide Loading Overlay ──────────────────────────────────
    function showLoader() { $loader.addClass('show'); }
    function hideLoader() { $loader.removeClass('show'); }

    // ── Utility: Build Blog Card HTML from JSON data ──────────────────────────
    /**
     * Converts a blog JSON object (returned by the server) into a Bootstrap card HTML string.
     * This keeps the rendering logic in one place so both search and filter can reuse it.
     *
     * @param {Object} blog - Blog data object from JSON response
     * @returns {string} - HTML string for one blog card
     */
    function buildCardHTML(blog) {
        return `
            <a href="${blog.url}" class="blog-card">
                <div class="blog-card-img-wrapper">
                    <img src="${blog.image_url}"
                         alt="${escapeHtml(blog.title)}"
                         loading="lazy"
                         onerror="this.src='https://placehold.co/800x400/0D1B2A/F59E0B?text=YaariBlog'">
                </div>
                <div class="blog-card-body">
                    <h3 class="blog-card-title">${escapeHtml(blog.title)}</h3>
                    <p class="blog-card-excerpt">${escapeHtml(blog.short_description)}</p>
                    <div class="blog-card-footer">
                        <span class="${blog.category_badge}">${escapeHtml(blog.category)}</span>
                        <span class="blog-card-date">${blog.created_at}</span>
                    </div>
                </div>
            </a>
        `;
    }

    // ── Utility: Escape HTML to prevent XSS in dynamically rendered content ──
    function escapeHtml(str) {
        return $('<div>').text(str).html();
    }

    // ── Utility: Render blogs array into the grid ─────────────────────────────
    /**
     * Clears the grid and renders an array of blog objects.
     * Shows/hides the "no results" message based on count.
     *
     * @param {Array}  blogs  - Array of blog objects from API response
     * @param {number} count  - Total count for display
     */
    function renderBlogs(blogs, count) {
        $grid.empty(); // Clear existing cards

        if (count === 0) {
            // Show friendly empty state
            $noResults.show();
            $resultText.text('0 results');
        } else {
            $noResults.hide();
            // Build all cards and append in one DOM operation (better performance)
            const html = blogs.map(buildCardHTML).join('');
            $grid.html(html);
            $resultText.text(count + (count === 1 ? ' post' : ' posts'));
        }
    }

    // ── Core: Fetch Blogs via AJAX ────────────────────────────────────────────
    /**
     * Sends an AJAX GET request to the appropriate endpoint based on the action type.
     * Both search and filter pass the current combined state (category + search term).
     *
     * @param {string} endpoint - 'search' or 'filter'
     */
    function fetchBlogs(endpoint) {
        showLoader();

        // Build query parameters — always send both so they work together
        const params = {
            q:        currentSearch,
            category: currentCategory
        };

        // Determine the correct endpoint URL
        const url = endpoint === 'search'
            ? $('#blog-grid').data('search-url')   // data-search-url attribute on grid
            : $('#blog-grid').data('filter-url');  // data-filter-url attribute on grid

        $.get(url, params)
            .done(function (response) {
                if (response.success) {
                    renderBlogs(response.blogs, response.count);
                }
            })
            .fail(function (xhr) {
                // Network/server error — show a gentle error message
                console.error('AJAX request failed:', xhr.status, xhr.statusText);
                $grid.html(`
                    <div style="grid-column:1/-1; text-align:center; padding:3rem; color:#F87171;">
                        <p style="font-size:1.1rem;">⚠️ Something went wrong. Please refresh and try again.</p>
                    </div>
                `);
            })
            .always(function () {
                hideLoader(); // Always hide loader regardless of success/fail
            });
    }

    // ── Event: Live Search Input ──────────────────────────────────────────────
    /**
     * Listens for keyup on the search input.
     * Uses a 400ms debounce to avoid firing on every keystroke (reduces server load).
     */
    $('#search-input').on('keyup input', function () {
        const query = $(this).val().trim();

        // Clear any pending debounce timer
        clearTimeout(searchTimer);

        // If query hasn't changed, do nothing
        if (query === currentSearch) return;

        currentSearch = query;

        // Debounce: wait 400ms after user stops typing before firing AJAX
        searchTimer = setTimeout(function () {
            fetchBlogs('search');
        }, 400);
    });

    // ── Event: Category Filter Buttons ───────────────────────────────────────
    /**
     * Listens for clicks on .filter-btn elements.
     * Updates the active state and triggers an AJAX filter request.
     */
    $(document).on('click', '.filter-btn', function () {
        const selectedCategory = $(this).data('category'); // data-category="Admit Card" etc.

        // If clicking the already-active category, do nothing
        if (selectedCategory === currentCategory) return;

        // Update state
        currentCategory = selectedCategory;

        // Toggle active class — remove from all, add to clicked button
        $('.filter-btn').removeClass('active');
        $(this).addClass('active');

        // Fetch with new category (also passes current search term)
        fetchBlogs('filter');
    });

    // ── Event: Clear Search Button ────────────────────────────────────────────
    $(document).on('click', '#clear-search', function () {
        $('#search-input').val('');
        currentSearch = '';
        fetchBlogs('search');
    });

    // ── Init: Update result count on page load ────────────────────────────────
    // Read the initial count from the data attribute set by Blade
    const initialCount = parseInt($grid.data('initial-count')) || 0;
    $resultText.text(initialCount + (initialCount === 1 ? ' post' : ' posts'));

});
