<?php

namespace Tests\Unit;

use App\Models\Account;
use App\Models\Card;
use App\Models\Category;
use App\Models\Expenditure;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Tests\AuthenticatedUserTestCase;
use Illuminate\Foundation\Testing\WithFaker;


class ExpenditureTest extends AuthenticatedUserTestCase
{

    use WithFaker;
    protected function _before()
    {
    }

    protected function _after()
    {
    }


    public function testCreateExpenditure(){


        $category = factory(Category::class)->make();
        $response = $this->withoutMiddleware(ThrottleRequests::class)->callRoute('POST', route('categories.store'),$category->toArray());
        $bodyCategory =  json_decode($response->getBody()->getContents());

        $account = factory(Account::class)->make();
        $response = $this->withoutMiddleware(ThrottleRequests::class)->callRoute('POST', route('accounts.store'),$account->toArray());
        $bodyAccount =  json_decode($response->getBody()->getContents());

        $card = factory(Card::class)->make();
        $response = $this->withoutMiddleware(ThrottleRequests::class)->callRoute('POST', route('cards.store'),$card->toArray());
        $bodyCard =  json_decode($response->getBody()->getContents());



        $expenditure = factory(Expenditure::class)->make([
            'card_id' => $bodyCard->card_id,
            'category_id'=> $bodyCategory->category_id,
            'account_id' => $bodyAccount->account_id,
        ]);


        $response = $this->withoutMiddleware(ThrottleRequests::class)->callRoute('POST', route('expenditures.store'),$expenditure->toArray());
        $body =  json_decode($response->getBody()->getContents());
        $this->assertEquals(201, $response->getStatusCode());

        $response = $this->withoutMiddleware(ThrottleRequests::class)->callRoute('GET', route('expenditures.index'));
        $bodyAll =  json_decode($response->getBody()->getContents());
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue(count($bodyAll) > 0, "There are no registered expenditure");

        $response = $this->withoutMiddleware(ThrottleRequests::class)->callRoute('GET', route('expenditures.show',$body->expenditure_id));
        $body =  json_decode($response->getBody()->getContents());
        $this->assertEquals(200, $response->getStatusCode());


        $expenditure = array("value"=>200);

        $response = $this->withoutMiddleware(ThrottleRequests::class)->callRoute('PUT', route('expenditures.update',$body->expenditure_id),$expenditure);
        $this->assertEquals(200, $response->getStatusCode());


        $corpo =  json_decode($response->getBody()->getContents());

        $this->assertDatabaseHas('expenditures',[

            'expenditure_id'=>$corpo->expenditure_id,
            'user_id'=>$corpo->user_id,
            'account_id'=>$corpo->account_id,
            'category_id'=>$corpo->category_id,
            'card_id'=>$corpo->card_id,

            'description'=>$corpo->description,
            'value'=>$corpo->value,
            'date_expenditure'=>$corpo->date_expenditure,
            'repeat'=>$corpo->repeat,
        ]);


        $response = $this->withoutMiddleware(ThrottleRequests::class)->callRoute('DELETE', route('expenditures.delete',$body->expenditure_id));
        $this->assertEquals(204, $response->getStatusCode());


        $this->withoutMiddleware(ThrottleRequests::class)->callRoute('DELETE', route('accounts.delete',$bodyAccount->account_id));
        $this->withoutMiddleware(ThrottleRequests::class)->callRoute('DELETE', route('categories.delete',$bodyCategory->category_id));
        $this->withoutMiddleware(ThrottleRequests::class)->callRoute('DELETE', route('cards.delete',$bodyCard->card_id));

        //Caminho Triste
        $expenditure = array();
        $this->expectException(\Exception::class);
        $this->withoutMiddleware(ThrottleRequests::class)->callRoute('POST', route('expenditures.store'),$expenditure);


    }

}
