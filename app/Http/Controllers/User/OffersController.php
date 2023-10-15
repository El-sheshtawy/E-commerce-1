<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class OffersController extends Controller
{
    public function index()
    {
        return view('site.user.pages.offers');
    }
}
