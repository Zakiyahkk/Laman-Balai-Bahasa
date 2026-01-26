<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class APengaturanController extends Controller
{
    public function index()
{
    $headers = [
        'apikey'        => env('SUPABASE_SERVICE_ROLE_KEY'),
        'Authorization' => 'Bearer ' . env('SUPABASE_SERVICE_ROLE_KEY'),
        'Accept'        => 'application/json',
    ];

    // Ambil data admin dari Supabase
    $admins = Http::withHeaders($headers)->get(
        rtrim(env('SUPABASE_URL'), '/') . '/rest/v1/admin?select=id,email,username,role'
    )->json() ?? [];

    // Hitung total admin
    $totalAdmin = count($admins);

    return view('admin.pengaturan', [
        'admins'      => $admins,
        'totalAdmin'  => $totalAdmin,
    ]);
}

}
