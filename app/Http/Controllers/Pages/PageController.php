<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    /**
     * Display the terms and conditions page.
     *
     * @return Response
     */
    public function terms()
    {
        return view('pages.terms');
    }
}
