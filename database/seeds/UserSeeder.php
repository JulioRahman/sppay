<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = DB::table('users');
        $table->insert([
            'name' => 'Julio Rahman',
            'role' => 'ADMIN',
            'email' => 'julio.rahman@gmail.com',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'password' => '$2y$10$3smBVXQi6FHjBFU5EYwo/u1TrC3D7Ocx.Ke.j3oawoQo9qVAzrVS2',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
