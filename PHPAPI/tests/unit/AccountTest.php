<?php

namespace Tests\Unit;

use App\Models\Account;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountTest extends TestCase
{

    use WithFaker;
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testCreateAccount(){

        //Caminho Feliz
        $user = factory(\App\User::class)->create();
        $account = factory(Account::class)->make();

        $this->actingAs($user)
            ->post(route('accounts.store'),$account->toArray())
            ->assertSuccessful()
            ->assertStatus(201);

        $this->assertDatabaseHas('accounts',[


            'name'=>$account->name,
            'account_number'=>$account->account_number,
            'user_id'=>$account->user_id,
            'created_at'=>now(),
            'updated_at' =>now(),

        ]);

        //Caminho Triste
        $account = factory(Account::class)->make(['account_number'=>'']);

        $this->actingAs($user)
            ->post(route('accounts.store'),$account->toArray())
            ->assertStatus(302);

    }
}
