<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Aguinaldo Tupy',
                'email' => 'aguinaldo.tupy@gmail.com',
                'password' => bcrypt('12345678'),
            ],
        ];

        foreach ($data as $user) {
            $user = \App\Models\User::create($user);

            $user->createToken('Access Token')->accessToken;
        }
    }
}
