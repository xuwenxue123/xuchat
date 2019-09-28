<?php

namespace App\Http\Controllers\Run;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RunController extends Controller
{
    public function run_add_menu()
    {
         return view('Run.run_add_menu');
    }
}
