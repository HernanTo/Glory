<?php

namespace Database\Seeders;

use App\Models\TypePay;
use Illuminate\Database\Seeder;

class TypePaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypePay::create([
            'id' => '0',
            'name' => 'Nulo',
            'is_active' => 0,
        ]);

        $data = ['Efectivo', 'Nequi', 'Bancolombia', 'Daviplata', 'Crédito'];
        foreach($data as $item){
            TypePay::create([
                'name' => $item,
                'is_active' => 0,
            ]);
        }
    }
}
