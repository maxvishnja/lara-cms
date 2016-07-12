<?php

namespace maxvishnja\Tickets\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TicketsController extends Controller
{

    public function __construct()
    {
        $this->middleware('sentry.auth');
    }

    public function index()
    {
        return view('Tickets::index');
    }
}