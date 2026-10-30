<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index()
    {
  $portfolios = Portfolio::latest()->get();
    return view('portofolio.index', compact('portfolios'));
    }

    public function create()
    {
    
        return view('portofolio.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_proyek' => 'required|string|max:255',
            'kategori' => 'required|string',
            'deskripsi' => 'required|string',
            'klien_perusahaan' => 'nullable|string|max:255',
            'link_proyek' => 'nullable|url',
            'gambar_proyek' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar_proyek')) {
            $validated['gambar_proyek'] = $request->file('gambar_proyek')->store('portfolios', 'public');
        }

        Portfolio::create($validated);
        return redirect()->route('portfolio.index')->with('success', 'Project portfolio berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        // Ganti dari 'portfolio.edit' menjadi 'portofolio.edit'
        return view('portofolio.edit', compact('portfolio'));
    }

    public function update(Request $request, $id)
    {
        $portfolio = Portfolio::findOrFail($id);
        
        $validated = $request->validate([
            'nama_proyek' => 'required|string|max:255',
            'kategori' => 'required|string',
            'deskripsi' => 'required|string',
            'klien_perusahaan' => 'nullable|string|max:255',
            'link_proyek' => 'nullable|url',
            'gambar_proyek' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar_proyek')) {
            if ($portfolio->gambar_proyek) {
                Storage::disk('public')->delete($portfolio->gambar_proyek);
            }
            $validated['gambar_proyek'] = $request->file('gambar_proyek')->store('portfolios', 'public');
        }

        $portfolio->update($validated);
        return redirect()->route('portfolio.index')->with('success', 'Project portfolio berhasil diperbarui!');
    }

    public function destroy($id)
    {
       // Cari data berdasarkan ID di tabel Porofolio_1202
        $portfolio = Portfolio::findOrFail($id);
        
        // Hapus file gambar dari folder storage jika ada
        if ($portfolio->gambar_proyek) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($portfolio->gambar_proyek);
        }
        
        // Hapus data dari database
        $portfolio->delete();

        // Kembalikan ke halaman utama dengan pesan sukses
        return redirect()->route('portfolio.index')->with('success', 'Project portfolio berhasil dihapus!');
    }
}
