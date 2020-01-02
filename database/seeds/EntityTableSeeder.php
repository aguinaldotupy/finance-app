<?php

use Illuminate\Database\Seeder;

class EntityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $entities = [
            'Millennium bcp',
            'N26 Europe',
            'Banco do Brasil',
            'Banco Itaú',
        ];

        foreach ($entities as $key => $entity) {
            \App\Models\Entity::create([
                'name' => $entity,
            ]);
        }
    }
}
