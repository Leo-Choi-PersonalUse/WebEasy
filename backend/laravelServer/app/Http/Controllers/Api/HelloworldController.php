<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;




class HelloworldController extends Controller
{
    public function index()
    {
        return response('hello world!',200)->header('Content-Type', 'text/plain');}
}