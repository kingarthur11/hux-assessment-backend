<?php

namespace App;

require __DIR__.'/../vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQProducerService
{
    protected $connection;
    protected $channel;
    

    public function __construct()
    {
        $this->connection = new AMQPStreamConnection(env('RABBITMQ_HOST'), env('RABBITMQ_PORT'), env('RABBITMQ_PASSWORD'), env('RABBITMQ_USERNAME'),);
        $this->channel = $this->connection->channel();
    }
    public function publish($queueName, $messageBody)
    {
        $this->channel->queue_declare($queueName, false, true, false, false);

        $message = new AMQPMessage($messageBody);
        $this->channel->basic_publish($message, '', $queueName);
    }

    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();
    }
}