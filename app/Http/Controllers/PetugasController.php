<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index()
    {
        $petugas = User::where('role', 'petugas')->get();

        return view('dashboard.admin.index', [
            'title' => 'Admin',
            'petugas' => $petugas
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|min:5',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'petugas',
        ]);

        return redirect()->route('admin.index')->with('success', 'Petugas created successfully.');
    }

    public function create()
    {
        return view('dashboard.admin.create', [
            'title' => 'Buat Akun Petugas',
        ]);
    }

    public function show($id)
    {
        $petugas = User::findOrFail($id);
        return view('dashboard.admin.edit', [
            'title' => 'Edit Akun Petugas',
            'petugas' => $petugas,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'password' => 'nullable|min:5',
        ]);

        $petugas = User::findOrFail($id);
        $petugas->name = $request->name;
        $petugas->email = $request->email;
        $petugas->username = $request->username;
        if ($request->password) {
            $petugas->password = Hash::make($request->password);
        }
        $petugas->save();

        return redirect()->route('admin.index')->with('success', 'Akun Petugas berhasil diperbarui.');
    }

    public function suspend($id)
    {
        $petugas = User::findOrFail($id);
        $petugas->update(['is_suspended' => true]);

        return redirect()->route('admin.index')->with('success', 'Akun Petugas berhasil di-suspend.');
    }

    public function ban($id)
    {
        $petugas = User::findOrFail($id);
        $petugas->delete();

        return redirect()->route('admin.index')->with('success', 'Akun Petugas berhasil di-ban.');
    }

    public function recover($id)
    {
        $petugas = User::findOrFail($id);
        $petugas->update(['is_suspended' => false]);

        return redirect()->route('admin.index')->with('success', 'Akun Petugas berhasil di-recover.');
    }
}
