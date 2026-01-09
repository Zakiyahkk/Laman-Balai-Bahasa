<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WbsController extends Controller
{
    public function wbs()
    {
        return view('user.wbs.wbs');
    }
}
