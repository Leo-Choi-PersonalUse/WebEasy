<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;

class RedisController extends Controller
{
    public function checkConnection()
    {
        try {
            // Ping the Redis server
            $pong = Redis::ping();

            if ($pong === '+PONG') {
                return 'Redis connection successful!';
            } else {
                return 'Unable to connect to Redis server.';
            }
        } catch (\Exception $e) {
            return 'An error occurred while checking Redis connection: ' . $e->getMessage();
        }
    }
}