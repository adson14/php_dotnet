<?php

namespace App\Http\Controllers\api;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
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
            'account_number' => '|numeric|required'
        ]);

        $account = Account::create($request->all());

        return response($account, 201);
    }
}
