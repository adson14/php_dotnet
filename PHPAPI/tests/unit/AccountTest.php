<?php

namespace Tests\Unit;

use App\Models\Account;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Tests\AuthenticatedUserTestCase;

class AccountTest extends AuthenticatedUserTestCase
{

    use WithFaker;


    protected function _before()
    {

    }

    protected function _after()
    {
    }


    public function testAccount(){

        //Caminho Feliz

        $account = factory(Account::class)->make();

        $response = $this->withoutMiddleware(ThrottleRequests::class)->callRoute('POST', route('accounts.store'),$account->toArray());
        $body =  json_decode($response->getBody()->getContents());
        $this->assertEquals(201, $response->getStatusCode());

        $response = $this->withoutMiddleware(ThrottleRequests::class)->callRoute('GET', route('accounts.index'));
        $bodyAll =  json_decode($response->getBody()->getContents());
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue(count($bodyAll) > 0, "There are no registered accounts");

        $response = $this->withoutMiddleware(ThrottleRequests::class)->callRoute('GET', route('accounts.show',$body->account_id));
        $body =  json_decode($response->getBody()->getContents());
        $this->assertEquals(200, $response->getStatusCode());


        $account = array("account_number"=>69800);

        $response = $this->withoutMiddleware(ThrottleRequests::class)->callRoute('PUT', route('accounts.update',$body->account_id),$account);
        $this->assertEquals(200, $response->getStatusCode());


        $corpo =  json_decode($response->getBody()->getContents());

        $this->assertDatabaseHas('accounts',[

            'account_id'=>$corpo->account_id,
            'user_id'=>$corpo->user_id,
            'name'=>$corpo->name,
            'account_number'=>$corpo->account_number,
        ]);


        $response = $this->withoutMiddleware(ThrottleRequests::class)->callRoute('DELETE', route('accounts.delete',$body->account_id));
        $this->assertEquals(204, $response->getStatusCode());

        //Caminho Triste
        $account = array();
        $this->expectException(\Exception::class);
        $this->withoutMiddleware(ThrottleRequests::class)->callRoute('POST', route('accounts.store'),$account);

    }

}
