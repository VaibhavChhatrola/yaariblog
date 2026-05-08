<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     * Calls all seeders in the correct order.
     */
    public function run(): void
    {
        // Existing user factory (kept from original project)
        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
        ]);

        // ── JobYaari Blogs Seeders ──────────────────────────────────────────
        // Creates default admin: admin@jobyaari.com / Admin@1234
        $this->call(AdminSeeder::class);

        // Seeds 9 sample blog posts (3 per category)
        $this->call(BlogSeeder::class);
    }
}
