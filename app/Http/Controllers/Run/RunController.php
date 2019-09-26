<?php

namespace App\Http\Controllers\Run;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RunController extends Controller
{
    //管理课程
    public function run_add_menu()
    {
        return view('Run.run_add_menu');
    }
}
