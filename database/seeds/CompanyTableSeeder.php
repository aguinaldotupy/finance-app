<?php

use Illuminate\Database\Seeder;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = ['Vodafone', 'MEO', 'GALP', 'Morada', 'Continente', 'Pingo Doce', 'Pastelaria Nosso Sonho', 'Café Dona Mena', 'Irmãos Jetta'];

        foreach ($companies as $key => $value) {
            $company = \App\Models\Company::updateOrCreate([
                'name' => $value,
            ], [
                'name' => $value,
                'number_social' => mt_rand('000000', '999999'),
            ]);
        }
    }
}
