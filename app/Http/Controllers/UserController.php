<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        User::create($data);

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

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

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
