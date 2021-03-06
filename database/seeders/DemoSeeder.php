<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /* TODO: 
        * - Change seeding to factories
        * - Find a more elegant way of increasing auto increment in pgsql
        */

        // Application data
        $this->call(DatabaseSeeder::class);
        
        // Dummy data
        $this->call(DataModelSeeder::class);
        $this->call(DataModelFieldSeeder::class);
        $this->call(ConnectionSeeder::class);
        $this->call(AuthenticationSeeder::class);
        $this->call(EndpointSeeder::class);
        $this->call(ProcessableSeeder::class);
        $this->call(MappingSeeder::class);
        $this->call(MappingFieldSeeder::class);
        $this->call(StepSeeder::class);
        $this->call(StepArgumentSeeder::class);
        
        foreach(['role','user','data_model','data_model_field','connection','authentication','endpoint','processable','mapping','mapping_field','step', 'step_argument', 'step_function', 'step_function_parameter'] as $model) {
            $this->increaseSequence($model);
        }
        
    }

    public function increaseSequence($model)
    {
        $connection = config('database.default');

        $driver = config("database.connections.{$connection}.driver");

        if($driver == 'pgsql') {
            \Illuminate\Support\Facades\DB::statement("ALTER SEQUENCE {$model}s_id_seq RESTART 3000;");
        }

        
    }
}
