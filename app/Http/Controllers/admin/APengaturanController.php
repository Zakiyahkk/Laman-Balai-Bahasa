<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Closure;

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

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:admin,email',
            'username' => 'required|unique:admin,username',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,super_admin',
        ]);

        DB::table('admin')->insert([
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'created_at' => now(),
        ]);

        return redirect()
            ->route('admin.pengaturan')
            ->with('success', 'Admin berhasil ditambahkan');
    }


    public function update(Request $request, $email)
    {
            $request->validate([
                'username' => 'required|unique:admin,username,' . $email . ',email',
                'role' => 'required|in:admin,super_admin',
                'password' => 'nullable|min:6',
            ]);

            $data = [
                'username' => $request->username,
                'role' => $request->role,
            ];

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            DB::table('admin')
                ->where('email', $email)
                ->update($data);

            return redirect()
                ->route('admin.pengaturan')
                ->with('success', 'Data admin berhasil diperbarui');
        }

    public function destroy($email)
    {
        DB::table('admin')
            ->where('email', $email)
            ->delete();

        return redirect()
            ->route('admin.pengaturan')
            ->with('success', 'Admin berhasil dihapus');
    }
}
