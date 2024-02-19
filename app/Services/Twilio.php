<?php

namespace App\Services;

use Twilio\Rest\Client;

class Twilio 
{
    protected $account_sid;

    protected $auth_token;

    protected $messaging_service_sid;

    protected $client;

    public function __construct()
    {
      $this->account_sid = config('services.twilio.account_sid');
     
      $this->auth_token = config('services.twilio.auth_token');
            var_dump($this->auth_token);

      $this->messaging_service_sid = config('services.twilio.messaging_service_sid');

        var_dump($this->messaging_service_sid);

      $this->client = $this->setUp();
    }

    public function setUp()
    {
        $client = new Client($this->account_sid, $this->auth_token);

        return $client;
    }

    public function notify($number, $spoiler)
    {
        $message = $this->client->messages->create($number, [
            'body' => $spoiler,
            'messagingServiceSid' => $this->messaging_service_sid
        ]);

        return $message;
    }

}