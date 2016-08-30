<?php

namespace OnInvoice\Http\Controllers;

use Illuminate\Http\Request;

use OnInvoice\Http\Requests;
use OnInvoice\Http\Controllers\Controller;

class MainController extends Controller
{

    public function home()
    {
        return view('main.home')->with('active', array('sup' => 'dashboard'));
    }
}
