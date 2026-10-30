<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Portfolio & Showcase</title>
    
    <!-- Link Bootstrap CDN Alternatif yang Stabil -->
    <link rel="stylesheet" href="https://unpkg.com">

    <!-- Style Backup Internal (Memastikan tampilan tetap rapi jika CDN terhambat) -->
    <style>
        body { background-color: #f8f9fa; font-family: sans-serif; }
        .bg-dark { background-color: #212529 !important; }
        .text-white { color: #fff !important; }
        .text-muted { color: #6c757d !important; }
        .text-secondary { color: #adb5bd !important; }
        .py-5 { padding-top: 3rem !important; padding-bottom: 3rem !important; }
        .mb-5 { margin-bottom: 3rem !important; }
        .mb-4 { margin-bottom: 1.5rem !important; }
        .mt-2 { margin-top: 0.5rem !important; }
        .text-center { text-align: center !important; }
        .fw-bold { font-weight: 700 !important; }
        .lead { font-size: 1.25rem; font-weight: 300; }
        .btn { display: inline-block; font-weight: 400; text-align: center; vertical-align: middle; cursor: pointer; padding: 0.375rem 0.75rem; font-size: 1rem; border-radius: 0.25rem; text-decoration: none; }
        .btn-primary { color: #fff; background-color: #0d6efd; border-color: #0d6efd; }
        .btn-warning { color: #fff; background-color: #ffc107; border-color: #ffc107; }
        .btn-danger { color: #fff; background-color: #dc3545; border-color: #dc3545; }
        .container { width: 100%; padding-right: var(--bs-gutter-x,.75rem); padding-left: var(--bs-gutter-x,.75rem); margin-right: auto; margin-left: auto; }
        @media (min-width: 1200px) { .container { max-width: 1140px; } }
        .row { display: flex; flex-wrap: wrap; margin-top: calc(-1 * var(--bs-gutter-y, 0)); margin-right: calc(-.5 * var(--bs-gutter-x, 1.5rem)); margin-left: calc(-.5 * var(--bs-gutter-x, 1.5rem)); }
        .col-md-4 { flex: 0 0 auto; width: 33.33333333%; padding: 12px; }
        .card { position: relative; display: flex; flex-direction: column; min-width: 0; word-wrap: break-word; background-color: #fff; background-clip: border-box; border: 0 solid rgba(0,0,0,.125); border-radius: 0.375rem; box-shadow: 0  0.125rem  0.25rem rgba(0,0,0,.075); }
        .card-body { flex: 1 1 auto; padding: 1rem 1rem; }
        .badge { display: inline-block; padding: 0.35em 0.65em; font-size: .75em; font-weight: 700; line-height: 1; text-align: center; white-space: nowrap; vertical-align: baseline; border-radius: 0.25rem; }
        .bg-secondary { background-color: #6c757d !important; }
        .d-flex { display: flex !important; }
        .justify-content-between { justify-content: space-between !important; }
        .align-items-center { align-items: center !important; }
        .border-top { border-top: 1px solid #dee2e6 !important; }
        .pt-3 { padding-top: 1rem !important; }
    </style>
</head>
<body>

    <!-- Header Showcase -->
    <header class="bg-dark text-white text-center py-5 mb-5" style="box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075);">
        <div class="container">
            <h1 class="fw-bold text-white">Portofolio Kerja & Project</h1>
            <p class="lead text-secondary">Daftar karya visual, aplikasi, dan sistem (Tabel: Porofolio_1202).</p>
            <a href="{{ route('portfolio.create') }}" class="btn btn-primary mt-2">Tambah Project Baru</a>
        </div>
    </header>

    <div class="container mb-5">
        @if(session('success'))
            <div class="alert alert-success mb-4" style="padding: 1rem; background-color: #d1e7dd; color: #0f5132; border-radius: 0.375rem;">
                {{ session('success') }}
            </div>
        @endif

        <!-- Grid Tampilan Portofolio -->
        <div class="row">
            @forelse ($portfolios as $item)
                <div class="col-md-4">
                    <div class="card">
                        <!-- Gambar Proyek -->
                        @if($item->gambar_proyek)
                            <img src="{{ asset('/storage/'.$item->gambar_proyek) }}" style="height: 200px; object-fit: cover; border-top-left-radius: 0.375rem; border-top-right-radius: 0.375rem;">
                        @else
                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px; border-top-left-radius: 0.375rem; border-top-right-radius: 0.375rem;">
                                <span class="fw-bold">NO IMAGE PREVIEW</span>
                            </div>
                        @endif

                        <!-- Konten Kartu -->
                        <div class="card-body">
                            <div class="mb-2">
                                <span class="badge bg-secondary">{{ $item->kategori }}</span>
                                @if($item->klien_perusahaan)
                                    <small class="text-muted" style="display: block; margin-top: 0.25rem;">🏢 Klien: {{ $item->klien_perusahaan }}</small>
                                @endif
                            </div>
                            <h5 style="font-weight: 700; color: #212529; margin-bottom: 0.5rem;">{{ $item->nama_proyek }}</h5>
                            <p class="text-muted" style="font-size: 0.9rem; min-height: 50px;">
                                {{ Str::limit($item->deskripsi, 120, '...') }}
                            </p>
                            
                            @if($item->link_proyek)
                                <a href="{{ $item->link_proyek }}" target="_blank" class="btn" style="display: block; width: 100%; border: 1px solid #212529; color: #212529; font-size: 0.875rem; margin-bottom: 1rem;">Kunjungi Situs 🔗</a>
                            @endif

                            <!-- Aksi CRUD -->
                            <div class="border-top pt-3 d-flex justify-content-between align-items-center">
                                <a href="{{ route('portfolio.edit', $item->id) }}" class="btn btn-warning" style="font-size: 0.875rem;">Edit</a>
                                <form onsubmit="return confirm('Hapus project ini dari portfolio?');" action="{{ route('portfolio.destroy', $item->id) }}" method="POST" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="font-size: 0.875rem;">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div style="width: 100%; text-align: center; padding-top: 3rem; padding-bottom: 3rem;">
                    <p class="text-muted" style="font-size: 1.25rem;">Belum ada karya atau riwayat proyek yang dimasukkan.</p>
                </div>
            @endforelse
        </div>
    </div>

</body>
</html>
