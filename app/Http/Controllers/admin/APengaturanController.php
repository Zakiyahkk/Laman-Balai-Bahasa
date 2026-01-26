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

    $response = Http::withHeaders($headers)->get(
        rtrim(env('SUPABASE_URL'), '/') .
        '/rest/v1/admin?select=id,email,username,role'
    );

    // DEFAULT KOSONG
    $admins = [];

    // PASTIKAN RESPONSE ARRAY
    if ($response->ok() && is_array($response->json())) {
        $admins = $response->json();
    }

    return view('admin.pengaturan', [
        'admins'     => $admins,
        'totalAdmin' => count($admins),
    ]);
}


}
