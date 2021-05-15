<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ConnectionSeeder::class);
        $this->call(AuthenticationSeeder::class);
        $this->call(EndpointSeeder::class);
        $this->call(DataModelSeeder::class);
        $this->call(DataModelFieldSeeder::class);
    }
}
