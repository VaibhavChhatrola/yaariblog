<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Create the default admin account.
     * Credentials: admin@jobyaari.com / Admin@1234
     *
     * Run: php artisan db:seed --class=AdminSeeder
     */
    public function run(): void
    {
        // updateOrCreate prevents duplicate if seeder is run multiple times
        Admin::updateOrCreate(
            ['email' => 'admin@jobyaari.com'],
            [
                'name'     => 'JobYaari Admin',
                'password' => Hash::make('Admin@1234'),
            ]
        );

        $this->command->info('✅ Admin seeded: admin@jobyaari.com / Admin@1234');
    }
}
