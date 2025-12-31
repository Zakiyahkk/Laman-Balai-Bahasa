<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class PpidController extends Controller
{
    public function ppid()
    {
        return view('user.ppid.ppid');
    }
}
