<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('admins')->delete();
        
        \App\Models\User::factory(3)->create();
        $this->call(AdminSeeder::class);
    }
}
