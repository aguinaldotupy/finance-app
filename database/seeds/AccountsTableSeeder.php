<?php

use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $millennium = \App\Models\Entity::whereName('Millennium bcp')->first();
        $bb = \App\Models\Entity::whereName('Banco do Brasil')->first();
        $itau = \App\Models\Entity::whereName('Banco Itaú')->first();
        $n26 = \App\Models\Entity::whereName('N26 Europe')->first();

        $user = \App\Models\User::first();

        $accounts = [
            [
                'name' => 'Millennium',
                'entity_id' => $millennium->id,
                'owner_id' => $user->id,
                'currency' => '€',
                'balance' => 0,
            ],
            [
                'name' => 'BB Gui',
                'entity_id' => $bb->id,
                'owner_id' => $user->id,
                'currency' => 'R$',
                'balance' => 0,
            ],
            [
                'name' => 'Itaú Gui',
                'entity_id' => $itau->id,
                'owner_id' => $user->id,
                'currency' => 'R$',
                'balance' => 0,
            ],
            [
                'name' => 'N26',
                'entity_id' => $n26->id,
                'owner_id' => $user->id,
                'currency' => '€',
                'balance' => 0,
            ],
        ];

        foreach ($accounts as $value) {
            $account = \App\Models\Account::updateOrCreate([
                'name' => $value['name'],
                'owner_id' => $value['owner_id'],
            ], $value);

            $account->users()->attach($value['owner_id']);
        }
    }
}
