<?php

namespace Tests\Unit;

use Illuminate\Routing\Middleware\ThrottleRequests;
use Tests\AuthenticatedUserTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Card;

class CardTest extends AuthenticatedUserTestCase
{
    use WithFaker;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testCard(){

        //Caminho Feliz

        $card = factory(Card::class)->make();

        $response = $this->withoutMiddleware(ThrottleRequests::class)->callRoute('POST', route('cards.store'),$card->toArray());
        $body =  json_decode($response->getBody()->getContents());
        $this->assertEquals(201, $response->getStatusCode());

        $response = $this->withoutMiddleware(ThrottleRequests::class)->callRoute('GET', route('cards.index'));
        $bodyAll =  json_decode($response->getBody()->getContents());
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue(count($bodyAll) > 0, "There are no registered card");

        $response = $this->withoutMiddleware(ThrottleRequests::class)->callRoute('GET', route('cards.show',$body->card_id));
        $body =  json_decode($response->getBody()->getContents());
        $this->assertEquals(200, $response->getStatusCode());


        $card = array("limit"=>2000);

        $response = $this->withoutMiddleware(ThrottleRequests::class)->callRoute('PUT', route('cards.update',$body->card_id),$card);
        $this->assertEquals(200, $response->getStatusCode());


        $corpo =  json_decode($response->getBody()->getContents());

        $this->assertDatabaseHas('cards',[

            'card_id'=>$corpo->card_id,
            'user_id'=>$corpo->user_id,
            'name'=>$corpo->name,
            'limit'=>$corpo->limit,
            'type'=>$corpo->type,
        ]);


        $response = $this->withoutMiddleware(ThrottleRequests::class)->callRoute('DELETE', route('cards.delete',$body->card_id));
        $this->assertEquals(204, $response->getStatusCode());

        //Caminho Triste
        $card = array();
        $this->expectException(\Exception::class);
        $this->withoutMiddleware(ThrottleRequests::class)->callRoute('POST', route('cards.store'),$card);
    }

}
