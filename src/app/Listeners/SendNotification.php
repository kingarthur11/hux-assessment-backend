<?php

namespace App\Listeners;

use App\Events\CreateNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\RabbitMQProducerService;
use GuzzleHttp\Client;

class SendNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\CreateNotification  $event
     * @return void
     */
    public function handle(CreateNotification $event)
    {
        $client = new Client();
        $rabbitMQService = new RabbitMQProducerService();
        $rabbitMQService->publish('queue_name', $event);
        // $rabbitMQService->publish($request);

        // $response = $client->request('GET', 'http://localhost:9001/consume-notification');
    }
}
