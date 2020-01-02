<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Morada',
                'type' => 'Despesa',
            ],
            [
                'name' => 'Telefone / Internet / TV',
                'type' => 'Despesa',
            ],
            [
                'name' => 'Gás',
                'type' => 'Despesa',
            ],
            [
                'name' => 'Mercado',
                'type' => 'Despesa',
            ],
            [
                'name' => 'Salário',
                'type' => 'Receita',
            ],
        ];

        foreach ($categories as $key => $value) {
            $category = \App\Models\Category::updateOrCreate([
                'name' => $value['name'],
            ], [
                'name' => $value['name'],
                'type' => $value['type'],
            ]);
        }
    }
}
