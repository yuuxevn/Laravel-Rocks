<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = collect(['Code', 'Framework']);
        $categories->each(function ($c) {
            \App\Category::create([
                'name' => $c,
                'slug' => \Str::slug($c)
            ]);
        });
    }
}
