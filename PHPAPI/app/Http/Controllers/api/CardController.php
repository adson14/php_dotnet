<?php

namespace App\Http\Controllers\api;

use App\Models\Card;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CardController extends Controller
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
            'name' => 'required|max:30',
            'limit' => 'numeric|min:1',
            'type' => 'required'
        ]);

        $card = Card::create($request->all());


        return response($card, 201);
    }
}
