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
        $categories = [['Motor', 'car-engine.png'], ['Caja', 'gearbox.png'], ['Suspension', 'suspension.png'],['Exteriores', 'car.png'], ['Accesorios', 'wheel.png']];

        foreach($categories as $category){
            Category::create([
                'name' => $category[0],
                'is_active' => 1]);
        }
    }
}
