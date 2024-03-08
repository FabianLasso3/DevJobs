<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //de esta forma le decimos que inserte datos dentro de salarioseeder usan el comando php artisan db:seed que crea datos que no son dinamicos
       $this->call(SalarioSeeder::class);
       $this->call(CategoriasSeeder::class);
    }
}
