<?php

namespace App\Http\Controllers\api;

use App\Models\Expenditure;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpenditureController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'description' => 'required|max:50',
            'value' => '|numeric|required',
            'date_expenditure' => 'required|date',
            'repeat'=>'required'
        ]);

        $expenditure = Expenditure::create($request->all());

        return response($expenditure, 201);
    }
}
