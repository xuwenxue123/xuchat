<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function event()
    {
        // echo 111;die;
        echo $_GET['echostr'];
    }
}
