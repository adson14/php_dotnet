<?php

namespace Tests\Unit;


use App\Models\Incoming;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IncomingTest extends TestCase
{
    use WithFaker;
    protected function _before()
    {
    }

    protected function _after()
    {
    }


    public function testCreateIncoming(){

        //Caminho Feliz
        $user = factory(\App\User::class)->create();
        $incoming = factory(Incoming::class)->make();

        $response = $this->actingAs($user)
            ->post(route('incoming.store'),$incoming->toArray())
            ->assertSuccessful()
            ->assertStatus(201);

        $this->assertDatabaseHas('incomings',[

            'description'=>$incoming->description,
            'value'=>$incoming->value,
            'date_incoming'=>$incoming->date_incoming,
            'repeat'=>$incoming->repeat,
            'user_id'=>$incoming->user_id,
            'category_id'=>$incoming->category_id,
            'account_id'=>$incoming->account_id,
            'created_at'=>now(),
            'updated_at' =>now(),

        ]);

        //Caminho Triste
        $incoming = factory(Incoming::class)->make([
            'description' => 'Abigail OtwellAbigail OtwellAbigail OtwellAbigail OtwellAbigail Otwell',
        ]);

        $this->actingAs($user)
            ->post(route('incoming.store'),$incoming->toArray())
            ->assertStatus(302);

    }
}
