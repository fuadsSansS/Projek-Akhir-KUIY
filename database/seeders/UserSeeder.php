<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

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
