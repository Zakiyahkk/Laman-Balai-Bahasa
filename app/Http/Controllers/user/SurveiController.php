<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class SurveiController extends Controller
{
    public function survei()
    {
        return view('user.survei.survei');
    }
}