<?php

namespace App\Http\Controllers;

use App\Http\Resources\FullCalendarResource;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('transaction.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $dataForm = $request->all();

        $validator = self::validator($dataForm);

        if ($validator->fails()) {
            return  response()->json(['errors' => $validator->errors()], 401);
        }

        Transaction::create($dataForm);

        $data = ['Adicionado'];

        return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Transaction $transaction
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Transaction $transaction)
    {
        $dataForm = $request->all();

        $validator = self::validator($dataForm);

        if ($validator->fails()) {
            return  response()->json(['errors' => $validator->errors()], 401);
        }

        $transaction->update($dataForm);

        $data = ['Atualizado'];

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    public function calendar()
    {
        return view('transaction.calendar');
    }

    public function searchCalendar()
    {
        $data = [
            'data' => FullCalendarResource::collection(Transaction::get()),
        ];

        return response()->json($data, 200);
    }

    protected function validator($data)
    {
        $rules = [
            'name' => 'required',
            'amount' => 'required',
            'date' => 'required',
        ];

        $messages = [
            'name.required' => 'Obrigatório indicar o nome da movimentação',
            'amount.required' => 'Obrigatório indicar o valor da movimentação',
            'date.required' => 'Obrigatório indicar a data da movimentação',
        ];

        return \Validator::make($data, $rules, $messages);
    }
}
