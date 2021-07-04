<?php

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Routing\Middleware\ThrottleRequests;
use App\Models\Category;
use Tests\AuthenticatedUserTestCase;

class CategoryTest extends AuthenticatedUserTestCase
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


    public function testCategory(){

        $category = factory(Category::class)->make();

        $response = $this->withoutMiddleware(ThrottleRequests::class)->callRoute('POST', route('categories.store'),$category->toArray());
        $body =  json_decode($response->getBody()->getContents());
        $this->assertEquals(201, $response->getStatusCode());

        $response = $this->withoutMiddleware(ThrottleRequests::class)->callRoute('GET', route('categories.index'));
        $bodyAll =  json_decode($response->getBody()->getContents());
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue(count($bodyAll) > 0, "There are no registered category");

        $response = $this->withoutMiddleware(ThrottleRequests::class)->callRoute('GET', route('categories.show',$body->category_id));
        $body =  json_decode($response->getBody()->getContents());
        $this->assertEquals(200, $response->getStatusCode());


        $category = array("limit"=>2000);

        $response = $this->withoutMiddleware(ThrottleRequests::class)->callRoute('PUT', route('categories.update',$body->category_id),$category);
        $this->assertEquals(200, $response->getStatusCode());


        $corpo =  json_decode($response->getBody()->getContents());

        $this->assertDatabaseHas('categories',[

            'category_id'=>$corpo->category_id,
            'user_id'=>$corpo->user_id,
            'name'=>$corpo->name,
            'type'=>$corpo->type,
        ]);


        $response = $this->withoutMiddleware(ThrottleRequests::class)->callRoute('DELETE', route('categories.delete',$body->category_id));
        $this->assertEquals(204, $response->getStatusCode());

        //Caminho Triste
        $category = array();
        $this->expectException(\Exception::class);
        $this->withoutMiddleware(ThrottleRequests::class)->callRoute('POST', route('categories.store'),$category);

    }


}
