<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Tampilkan daftar pengguna
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Tampilkan form untuk membuat pengguna baru
    public function create()
    {
        return view('users.create');
    }

    // Simpan pengguna baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:admin,user', // Validasi role
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // Simpan role
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    // Tampilkan detail pengguna
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    // Tampilkan form untuk mengedit pengguna
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // Update data pengguna di database
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|string|in:admin,user', // Validasi role
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role; // Update role

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        if ($user->isDirty()) {
            $user->save();
            return redirect()->route('users.index')->with('success', 'User berhasil diupdate.');
        } else {
            return redirect()->route('users.index')->with('info', 'Tidak ada perubahan pada data.');
        }
    }

    // Hapus pengguna dari database
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
