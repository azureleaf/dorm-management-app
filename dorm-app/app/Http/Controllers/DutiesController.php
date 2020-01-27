<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DutiesController extends Controller
{
    public function index()
    {
        return view('DutiesController.duties');
    }
}
