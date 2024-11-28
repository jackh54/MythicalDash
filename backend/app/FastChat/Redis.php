<?php
namespace MythicalClient\FastChat;

use MythicalClient\App;
use Predis\Client;

class Redis
{
    private $redis;
    public function __construct()
    {
        $app = App::getInstance(true);
        $app->loadEnv();
        $host = $_ENV['REDIS_HOST'];
        $pwd = $_ENV['REDIS_PASSWORD'];
        $client = new Client([
            'scheme' => 'tcp',
            'host' => $host,
        ]);
        $this->redis = $client;
    }

    public function getRedis(): Client
    {
        return $this->redis;
    }

    public function testConnection(): bool
    {
        try {
            $redis = $this->getRedis();
            $redis->connect();
            return $redis->isConnected();
        } catch (\Exception $e) {
            App::getInstance(true)->getLogger()->error('Failed to connect to Redis: ' . $e->getMessage());
            return false;
        }
    }
}