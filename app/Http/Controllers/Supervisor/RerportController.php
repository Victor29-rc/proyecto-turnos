<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RerportController extends Controller
{
    public function index(){
        return view('reports.index');
    }
}
