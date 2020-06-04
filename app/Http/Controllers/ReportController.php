<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class ReportController extends Controller
{
    public function index()
    {
        return view('report');
    }
}
