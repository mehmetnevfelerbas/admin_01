<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Bilgilerim</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- ÜST MENÜ (NAVBAR) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="dashboard">Mne Haberler</a>
            <div class="ms-auto">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-sm me-2">Panoya Dön</a>
                <a href="{{ route('visitor.blogs') }}" class="btn btn-warning btn-sm fw-bold">Siteyi Gör</a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <!-- BAŞARILI BİLDİRİMİ -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Kapat"></button>
                    </div>
                @endif

                <!-- PROFİL KARTI -->
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white fw-bold d-flex justify-content-between align-items-center">
                        <span>Profil Bilgilerim</span>
                        <span class="badge bg-secondary">{{ auth()->user()->role ?? 'Kullanıcı' }}</span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label fw-bold">Ad Soyad</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">E-posta Adresi</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
                            </div>

                            <hr class="my-4">
                            <p class="text-muted small">Şifrenizi değiştirmek istemiyorsanız aşağıdaki alanları boş bırakabilirsiniz.</p>

                            <div class="mb-3">
                                <label class="form-label">Yeni Şifre</label>
                                <input type="password" name="password" class="form-control" placeholder="******">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Yeni Şifre (Tekrar)</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="******">
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary fw-bold">Bilgileri Güncelle</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>