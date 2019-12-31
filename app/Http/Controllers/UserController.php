<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user()
    {
        return request()->user();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('user.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, User $user)
    {
        $dataForm = $request->only('id', 'name', 'email');
        $validator = self::validator($dataForm, $user->id);

        if ($validator->fails()) {
            return  response()->json(['errors' => $validator->errors()], 401);
        }

        //dd($dataForm);
        $user->update($dataForm);

        $data = [
            'user' => $user,
        ];

        return response()->json('Atualizado', 200);
    }

    protected function validator(array $data, $id = null)
    {
        return \Validator::make($data, [
            'name' => 'required|max:120',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return void
     */
    public function destroy(User $user)
    {
        //
    }
}
