<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Motor', 'Caja', 'Suspensión', 'Exteriores'];

        foreach($categories as $category){
            Category::create([
                'name' => $category,
                'is_active' => 1]);
        }
    }
}
