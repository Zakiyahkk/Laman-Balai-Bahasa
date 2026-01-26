<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class APengaturanController extends Controller
{
    public function index()
    {
        $admin = DB::table('admin')
            ->select('email', 'username', 'role')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pengaturan', [
            'admin' => $admin,
            'totalAdmin' => $admin->count(),
        ]);
    }
}
