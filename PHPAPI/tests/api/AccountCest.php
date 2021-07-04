<?php


class AccountCest
{
    public function _before(ApiTester $I)
    {
    }

    // tests
    public function tryToTest(ApiTester $I)
    {
    }


    public function createAccountAPI(\ApiTester $I)
    {

        $ldate = date('Y-m-d H:i:s');

        $account = factory(App\Models\Account::class)->make();
        //$I->amHttpAuthenticated('service_user', '123456');
        $I->haveHttpHeader('Content-Type', 'application/json');
        //$I->amBearerAuthenticated('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE2MjI1OTQ2MzQsImV4cCI6MTYyMjU5ODIzNCwibmJmIjoxNjIyNTk0NjM0LCJqdGkiOiJRM0docWFtd0FUd3RKWUhvIiwic3ViIjoxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.uASLBF4sELPkrinqFWA_pSgA84I9-UNCGeELHMXR63c');
        $I->sendPost('/accounts',$account->toArray());

        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200

        $firstId = $I->grabDataFromResponseByJsonPath('$..accounts.account_id')[0];
        $I->sendDelete('/accounts/'.$firstId);

    }
}
