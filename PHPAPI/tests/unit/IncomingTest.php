<?php

namespace Tests\Unit;


use App\Models\Account;
use App\Models\Card;
use App\Models\Category;
use App\Models\Incoming;
use Tests\AuthenticatedUserTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Routing\Middleware\ThrottleRequests;

class IncomingTest extends AuthenticatedUserTestCase
{
    use WithFaker;
    protected function _before()
    {
    }

    protected function _after()
    {
    }


    public function testCreate(){

        $category = factory(Category::class)->make();
        $response = $this->withoutMiddleware(ThrottleRequests::class)->callRoute('POST', route('categories.store'),$category->toArray());
        $bodyCategory =  json_decode($response->getBody()->getContents());

        $account = factory(Account::class)->make();
        $response = $this->withoutMiddleware(ThrottleRequests::class)->callRoute('POST', route('accounts.store'),$account->toArray());
        $bodyAccount =  json_decode($response->getBody()->getContents());


        $incoming = factory(Incoming::class)->make([
            'category_id'=> $bodyCategory->category_id,
            'account_id' => $bodyAccount->account_id,
        ]);


        $response = $this->withoutMiddleware(ThrottleRequests::class)->callRoute('POST', route('incomings.store'),$incoming->toArray());
        $body =  json_decode($response->getBody()->getContents());
        $this->assertEquals(201, $response->getStatusCode());

        $response = $this->withoutMiddleware(ThrottleRequests::class)->callRoute('GET', route('incomings.index'));
        $bodyAll =  json_decode($response->getBody()->getContents());
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue(count($bodyAll) > 0, "There are no registered incoming");

        $response = $this->withoutMiddleware(ThrottleRequests::class)->callRoute('GET', route('incomings.show',$body->incoming_id));
        $body =  json_decode($response->getBody()->getContents());
        $this->assertEquals(200, $response->getStatusCode());


        $incoming = array("value"=>200);

        $response = $this->withoutMiddleware(ThrottleRequests::class)->callRoute('PUT', route('incomings.update',$body->incoming_id),$incoming);
        $this->assertEquals(200, $response->getStatusCode());


        $corpo =  json_decode($response->getBody()->getContents());

        $this->assertDatabaseHas('incomings',[

            'incoming_id'=>$corpo->incoming_id,
            'user_id'=>$corpo->user_id,
            'account_id'=>$corpo->account_id,
            'category_id'=>$corpo->category_id,
            'description'=>$corpo->description,
            'value'=>$corpo->value,
            'date_incoming'=>$corpo->date_incoming,
            'repeat'=>$corpo->repeat,
        ]);


        $response = $this->withoutMiddleware(ThrottleRequests::class)->callRoute('DELETE', route('incomings.delete',$body->incoming_id));
        $this->assertEquals(204, $response->getStatusCode());


        $this->withoutMiddleware(ThrottleRequests::class)->callRoute('DELETE', route('accounts.delete',$bodyAccount->account_id));
        $this->withoutMiddleware(ThrottleRequests::class)->callRoute('DELETE', route('categories.delete',$bodyCategory->category_id));

        //Caminho Triste
        $incoming = array();
        $this->expectException(\Exception::class);
        $this->withoutMiddleware(ThrottleRequests::class)->callRoute('POST', route('incomings.store'),$incoming);

    }

}
