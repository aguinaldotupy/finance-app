<?php

use Illuminate\Database\Seeder;

class AuthProvidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Google',
            'Facebook',
            'Github',
            'Twitter'
        ];

        foreach ($data as $key => $provider){
            \App\Models\AuthProvider::create([
                'name' => $provider
            ]);
        }
    }
}
