<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $admin = [
            'id' => Str::uuid(),
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$s3XtgG4VWEJpWRQvyEEXUul8XQ5bIPIioXqNIj1qCJF13UBmQeT4C',
            'role' => 'admin',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ];

        DB::table('users')->insert($admin);
    }
}
