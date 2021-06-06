<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Card;

class CardTest extends TestCase
{
    use WithFaker;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testCreateCard(){

        //Caminho Feliz
        $user = factory(\App\User::class)->create();
        $card = factory(Card::class)->make();

        $this->actingAs($user)
            ->post(route('cards.store'),$card->toArray())
            ->assertSuccessful()
            ->assertStatus(201);

        $this->assertDatabaseHas('cards',[

            'user_id'=>$card->user_id,
            'name'=>$card->name,
            'type'=>$card->type,
            'limit'=>$card->limit,
            'created_at'=>now(),
            'updated_at' =>now(),

        ]);

        //Caminho Triste
        $card = factory(Card::class)->make(['limit'=>0]);

        $this->actingAs($user)
            ->post(route('cards.store'),$card->toArray())
            ->assertStatus(302);

    }
}
