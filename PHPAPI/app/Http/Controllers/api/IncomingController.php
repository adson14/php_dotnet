<?php

namespace App\Http\Controllers\api;

use App\Models\Incoming;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IncomingController extends Controller
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
            'date_incoming' => 'required|date',
            'repeat'=>'required'
        ]);

        $incoming = Incoming::create($request->all());

        return response($incoming, 201);
    }
}
