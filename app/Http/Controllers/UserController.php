<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Menampilkan seluruh data User
    public function index()
    {
        $data['dataUser'] = User::all();

        return view('admin.user.index', $data);
    }

    // Menampilkan halaman tambah User
    public function create()
    {
        return view('admin.user.create');
    }

    // Menyimpan data User
    public function store(Request $request)
    {
        // Validasi data User
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        // Enkripsi password
        $validated['password'] = Hash::make($validated['password']);

        // Simpan data User
        User::create($validated);

        return redirect()
            ->route('user.index')
            ->with('success', 'Penambahan Data User Berhasil!');
    }

    // Menampilkan halaman edit User
    public function edit(string $id)
    {
        $data['dataUser'] = User::findOrFail($id);

        return view('admin.user.edit', $data);
    }

    // Memperbarui data User
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        // Validasi data User
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => 'nullable|min:8|confirmed',
        ]);

        // Update password jika diisi
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Simpan perubahan data
        $user->update($validated);

        return redirect()
            ->route('user.index')
            ->with('success', 'Perubahan Data User Berhasil!');
    }

    // Menghapus data User
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()
            ->route('user.index')
            ->with('success', 'Data User Berhasil Dihapus!');
    }
}
