<?php

class CreateUserCest
{
    public function _before(ApiTester $I)
    {
    }

    // tests
    public function tryToTest(ApiTester $I)
    {
    }

    // tests
    public function createUserViaAPI(\ApiTester $I)
    {

        $ldate = date('Y-m-d H:i:s');
        //$I->amHttpAuthenticated('service_user', '123456');
        $I->haveHttpHeader('Content-Type', 'application/json');
        //$I->amBearerAuthenticated('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE2MjI1OTQ2MzQsImV4cCI6MTYyMjU5ODIzNCwibmJmIjoxNjIyNTk0NjM0LCJqdGkiOiJRM0docWFtd0FUd3RKWUhvIiwic3ViIjoxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.uASLBF4sELPkrinqFWA_pSgA84I9-UNCGeELHMXR63c');
        $I->sendPost('/auth/register', [
            'name' => 'davert',
            'surname' => 'Souza',
            'email' => 'davert@codeception.com',
            'password'=>'adson1415',
            'password_confirmation'=>'adson1415'
        ]);

        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200

        $firstUserId = $I->grabDataFromResponseByJsonPath('$..user.user_id')[0];
        $I->sendDelete('/auth/destroy/'.$firstUserId);

    }
}
