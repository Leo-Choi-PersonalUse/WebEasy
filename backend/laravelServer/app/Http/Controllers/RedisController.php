<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;


class RedisController extends Controller
{
    public function checkConnection()
    {
        try {
            Redis::ping();
            echo "Redis is connected!";
        } catch (\Exception $e) {
            echo "Unable to connect to Redis: " . $e->getMessage();
        }
    }

    public function getKey($key)
    {
        try {
            $value = Redis::get($key);

            if ($value === null) {
                echo "Key does not exist." . "({$key})";
            } else {
                echo "Value for key '$key': $value";
            }
        } catch (\Exception $e) {
            echo "Error retrieving key: " . $e->getMessage();
        }
    }

    public function deleteKey($key)
    {
        try {
            $deleted = Redis::del($key);

            if ($deleted) {
                echo "Key '$key' deleted successfully!";
            } else {
                echo "Key '$key' does not exist.";
            }
        } catch (\Exception $e) {
            echo "Error deleting key: " . $e->getMessage();
        }
    }
}