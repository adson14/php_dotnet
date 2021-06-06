<?php

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Category;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    use WithFaker;
    protected function _before()
    {
    }

    protected function _after()
    {
    }


    public function testCreateCategory(){

    //Caminho Feliz
        $user = factory(\App\User::class)->create();
        $category = factory(Category::class)->make();

        $response = $this->actingAs($user)
            ->post(route('categories.store'),$category->toArray())
            ->assertSuccessful()
            ->assertStatus(201);

        $this->assertDatabaseHas('categories',[

            'user_id'=>$category->user_id,
            'name'=>$category->name,
            'type'=>$category->type,
            'color'=>$category->color,
            'created_at'=>now(),
            'updated_at' =>now(),

        ]);

        //Caminho Triste
        $category = factory(Category::class)->make([
            'name' => 'Abigail OtwellAbigail OtwellAbigail OtwellAbigail OtwellAbigail Otwell',
        ]);

        $this->actingAs($user)
            ->post(route('categories.store'),$category->toArray())
            ->assertStatus(302);

    }

}
