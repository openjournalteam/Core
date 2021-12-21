<?php

namespace OpenJournalTeam\Core\Classes;


class PusherManager extends \Pusher\Pusher
{
    public $options;
    public $credentials;
    public $channel;
    public $pusher;
    public $payload;

    function __construct()
    {
        $this->init();
    }

    function setPayload(Mixed $payload): void
    {
        $this->payload = $payload;
    }

    function getOptions(): array
    {
        return [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true
        ];
    }

    function getPusher(): Parent
    {
        return $this->pusher;
    }

    function getCredentials(): array
    {
        return [
            'auth_key' => env('PUSHER_APP_KEY'),
            'secret' => env('PUSHER_APP_SECRET'),
            'app_id' => env('PUSHER_APP_ID')
        ];
    }

    function init(): void
    {
        $this->options = $this->getOptions();
        $this->credentials = $this->getCredentials();

        $this->pusher = new Parent(
            $this->credentials['auth_key'],
            $this->credentials['secret'],
            $this->credentials['app_id'],
            $this->options
        );
    }

    static function broadcast(array $payLoad)
    {
        $pusher = new self();
        $pusher->setPayload($payLoad);
        $pusher->pusher->trigger('my-channel', 'my-event', $pusher->payload);
    }
}
