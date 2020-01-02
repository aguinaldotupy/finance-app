<?php

namespace App\Http\Controllers;

class AccountController extends Controller
{
    public function list()
    {
        $data = [
            'accounts' => request()->user()->accounts->map(function ($account) {
                return [
                    'id' => $account->id,
                    'name' => $account->name,
                    'balance' => $account->balance,
                    'currency' => $account->currency,
                    'entity' => [
                        'id' => $account->entity->id,
                        'name' => $account->entity->name,
                    ],
                ];
            }),
        ];

        return response()->json($data, 200);
    }
}
