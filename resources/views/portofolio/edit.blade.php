<!-- resources/views/portofolio/edit.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Portfolio</title>
    <!-- Link Bootstrap CDN -->
    <link rel="stylesheet" href="https://unpkg.com">
    
    <!-- CSS Internal Backup agar Form Tampil Rapi Offline -->
    <style>
        body { background-color: #f8f9fa; font-family: sans-serif; padding-top: 3rem; padding-bottom: 3rem; }
        .card { background: #fff; border-radius: 0.5rem; box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075); border: 0; }
        .bg-dark { background-color: #212529 !important; color: #fff !important; }
        .p-3 { padding: 1rem !important; }
        .p-4 { padding: 1.5rem !important; }
        .fw-bold { font-weight: 700 !important; }
        .fw-semibold { font-weight: 600 !important; }
        .form-label { margin-bottom: 0.5rem; display: inline-block; }
        .form-control, .form-select { display: block; width: 100%; padding: 0.375rem 0.75rem; font-size: 1rem; font-weight: 400; line-height: 1.5; color: #212529; background-color: #fff; border: 1px solid #ced4da; border-radius: 0.375rem; }
        .mb-3 { margin-bottom: 1rem !important; }
        .mb-4 { margin-bottom: 1.5rem !important; }
        .row { display: flex; flex-wrap: wrap; margin-right: -0.75rem; margin-left: -0.75rem; }
        .col-md-6 { flex: 0 0 auto; width: 50%; padding-right: 0.75rem; padding-left: 0.75rem; }
        .container { width: 100%; max-width: 1140px; margin-right: auto; margin-left: auto; padding-right: 0.75rem; padding-left: 0.75rem; }
        .justify-content-center { justify-content: center !important; }
        .d-flex { display: flex !important; }
        .justify-content-end { justify-content: flex-end !important; }
        .gap-2 { gap: 0.5rem !important; }
        .border-top { border-top: 1px solid #dee2e6 !important; }
        .pt-3 { padding-top: 1rem !important; }
        .btn { display: inline-block; padding: 0.375rem 0.75rem; font-size: 1rem; border-radius: 0.375rem; text-decoration: none; text-align: center; cursor: pointer; border: 1px solid transparent; }
        .btn-secondary { color: #fff; background-color: #6c757d; }
        .btn-primary { color: #fff; background-color: #0d6efd; }
        .text-muted { color: #6c757d !important; }
        .img-thumbnail { padding: 0.25rem; background-color: #fff; border: 1px solid #dee2e6; border-radius: 0.375rem; max-width: 100%; height: auto; }
    </style>
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div style="flex: 0 0 auto; width: 66.66666667%;">
                <div class="card">
                    <div class="p-3 bg-dark fw-bold" style="border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem;">
                        📝 Edit Project Portfolio (Tabel: Porofolio_1202)
                    </div>
                    <div class="p-4">
                        <form action="{{ route('portfolio.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Nama Proyek / Karya</label>
                                    <input type="text" class="form-control" name="nama_proyek" value="{{ old('nama_proyek', $portfolio->nama_proyek) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Kategori</label>
                                    <select class="form-select" name="kategori" required>
                                        <option value="Web Development" {{ old('kategori', $portfolio->kategori) == 'Web Development' ? 'selected' : '' }}>Web Development</option>
                                        <option value="Mobile Apps" {{ old('kategori', $portfolio->kategori) == 'Mobile Apps' ? 'selected' : '' }}>Mobile Apps</option>
                                        <option value="UI/UX Design" {{ old('kategori', $portfolio->kategori) == 'UI/UX Design' ? 'selected' : '' }}>UI/UX Design</option>
                                        <option value="Graphic Design" {{ old('kategori', $portfolio->kategori) == 'Graphic Design' ? 'selected' : '' }}>Graphic Design</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Klien / Perusahaan (Opsional)</label>
                                    <input type="text" class="form-control" name="klien_perusahaan" value="{{ old('klien_perusahaan', $portfolio->klien_perusahaan) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Link Proyek / URL (Opsional)</label>
                                    <input type="url" class="form-control" name="link_proyek" value="{{ old('link_proyek', $portfolio->link_proyek) }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Deskripsi Proyek</label>
                                <textarea class="form-control" name="deskripsi" rows="4" required>{{ old('deskripsi', $portfolio->deskripsi) }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Ganti Gambar Proyek (Opsional)</label>
                                <input type="file" class="form-control" name="gambar_proyek">
                                
                                @if($portfolio->gambar_proyek)
                                    <div class="mt-3">
                                        <small class="text-muted" style="display:block; margin-bottom:0.25rem;">Gambar aktif saat ini:</small>
                                        <img src="{{ asset('/storage/'.$portfolio->gambar_proyek) }}" class="img-thumbnail" style="max-height: 150px; object-fit: cover;">
                                    </div>
                                @endif
                            </div>

                            <div class="d-flex justify-content-end gap-2 border-top pt-3">
                                <a href="{{ route('portfolio.index') }}" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary">Update Portofolio</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
