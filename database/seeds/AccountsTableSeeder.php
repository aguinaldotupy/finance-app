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
        $accounts = [
            [
                'name' => 'Millennium',
                'entity_id' => 1,
                'owner_id' => 1,
                'currency' => '€',
                'balance' => 0,
            ],
            [
                'name' => 'BB Gui',
                'entity_id' => 3,
                'owner_id' => 1,
                'currency' => 'R$',
                'balance' => 0,
            ],
            [
                'name' => 'Itaú Gui',
                'entity_id' => 4,
                'owner_id' => 1,
                'currency' => 'R$',
                'balance' => 0,
            ],
            [
                'name' => 'N26',
                'entity_id' => 2,
                'owner_id' => 1,
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
