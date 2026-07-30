<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mne Haberler</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body {
            background-color: #f8f9fa;
        }
        .news-card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 12px;
            overflow: hidden;
        }
        .news-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.1) !important;
        }
        .news-img {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }
        .hero-section {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            color: white;
            padding: 60px 0 40px 0;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="{{ url('/') }}">
                <i class="bi bi-newspaper me-2 text-primary"></i>MNE Haberler
            </a>
            
            <div class="ms-auto d-flex align-items-center gap-2">
                @auth
                    <a href="{{ route('admin.panel') }}" class="btn btn-outline-light btn-sm px-3 rounded-pill">
                        <i class="bi bi-speedometer2 me-1"></i> Kullanıcı Sayfasına Dön
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm px-3 rounded-pill">Giriş Yap</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="hero-section text-center mb-5">
        <div class="container">
            <h1 class="fw-bold mb-3">Güncel Haberler</h1>
            <p class="text-white-50 fs-5 mb-4">Sitemizdeki en son gelişmeleri ve haberleri buradan takip edebilirsiniz.</p>
            
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="input-group input-group-lg shadow-sm">
                        <span class="bg-white input-group-text border-0 text-muted ps-3">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control border-0 fs-6 ps-2" placeholder="Haberlerde ara...">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row g-4">
            
            @forelse($blogs as $blog)
                <div class="col-md-4">
                    <div class="card news-card shadow-sm h-100">
                        <div class="card-body d-flex flex-column p-4">
                            <div class="mb-2">
                                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1 fw-semibold">Gündem</span>
                            </div>

                            <h5 class="card-title fw-bold text-dark mb-2">
                                {{ Str::limit($blog->translate->title ?? 'Başlık Yok', 50) }}
                            </h5>

                            <p class="card-text text-muted small mb-4 flex-grow-1">
                                {{ Str::limit(strip_tags($blog->translate->description ?? ''), 90) }}
                            </p>

                                       <div class="d-flex align-items-center justify-content-between pt-3 border-top mt-auto">
                                          <span class="small text-muted">
                                               <i class="bi bi-clock me-1"></i>{{ $blog->created_at ? $blog->created_at->format('d.m.Y') : date('d.m.Y') }}
                                </span>
                                
                                <a href="{{ route('news.detail', $blog->id) }}" class="btn btn-link text-primary text-decoration-none fw-semibold p-0 small">
                                    Devamını Oku <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-journal-x display-1 text-muted"></i>
                    <p class="mt-3 text-muted">Henüz eklenmiş bir haber bulunmuyor.</p>
                </div>
            @endforelse

        </div>
    </div>

    <footer class="bg-white border-top py-4 mt-auto">
        <div class="container text-center text-muted small">
            &copy; {{ date('Y') }} Mne Haberler. Tüm hakları saklıdır.
        </div>
    </footer>

</body>
</html>