<?php

namespace Tests\Unit;

use App\Models\Expenditure;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExpenditureTest extends TestCase
{

    use WithFaker;
    protected function _before()
    {
    }

    protected function _after()
    {
    }


    public function testCreateExpenditure(){

        //Caminho Feliz
        $user = factory(\App\User::class)->create();
        $expenditure = factory(Expenditure::class)->make();

        $response = $this->actingAs($user)
            ->post(route('expenditure.store'),$expenditure->toArray())
            ->assertSuccessful()
            ->assertStatus(201);

        $this->assertDatabaseHas('expenditures',[

            'description'=>$expenditure->description,
            'value'=>$expenditure->value,
            'date_expenditure'=>$expenditure->date_expenditure,
            'repeat'=>$expenditure->repeat,
            'user_id'=>$expenditure->user_id,
            'category_id'=>$expenditure->category_id,
            'account_id'=>$expenditure->account_id,
            'created_at'=>now(),
            'updated_at' =>now(),

        ]);

        //Caminho Triste
        $expenditure = factory(Expenditure::class)->make([
            'description' => 'Abigail OtwellAbigail OtwellAbigail OtwellAbigail OtwellAbigail Otwell',
        ]);

        $this->actingAs($user)
            ->post(route('expenditure.store'),$expenditure->toArray())
            ->assertStatus(302);

    }

}
