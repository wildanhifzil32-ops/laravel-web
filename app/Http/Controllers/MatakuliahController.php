<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    // Menampilkan data matakuliah
    public function index()
    {
        return "Menampilkan data matakuliah";
    }

    // Menampilkan form tambah matakuliah
    public function create()
    {
        return "Menampilkan form tambah matakuliah";
    }

    // Menyimpan data matakuliah
    public function store()
    {
        return "Menyimpan data matakuliah";
    }

    // Menampilkan detail matakuliah
    public function show($kode = null)
    {
        if ($kode == null) {
            return "Masukkan kode matakuliah!";
        }

        return "Anda mengakses matakuliah " . $kode;
    }

    // Menampilkan form edit matakuliah
    public function edit($kode)
    {
        return "Menampilkan form edit matakuliah " . $kode;
    }

    // Mengubah data matakuliah
    public function update($kode)
    {
        return "Mengubah data matakuliah " . $kode;
    }

    // Menghapus data matakuliah
    public function destroy($kode)
    {
        return "Menghapus data matakuliah " . $kode;
    }
}
