<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Ayarları</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="dashboard">Mne Yönetim</a>
            <div class="ms-auto">
                <a href="{{ route('dashboard') }}" class="btn btn-warning btn-sm fw-bold">Anasayfaya Dön</a>
                <a href="{{ route('visitor.blogs') }}" class="btn btn-warning btn-sm fw-bold">Siteyi Gör</a>
                <a href="{{route("users")}}" class="btn btn-warning btn-sm fw-bold">Kullanıcı Menüsü</a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-dark text-white fw-bold d-flex align-items-center">
                        <i class="fas fa-cog me-2"></i> Sistem Ayarları
                    </div>
                    <div class="card-body text-center py-5">
                        
                        <div class="mb-4">
                            <span class="badge bg-warning text-dark fs-6 px-3 py-2 rounded-pill">
                                <i class="fas fa-tools me-1"></i> Geliştirme Aşamasında
                            </span>
                        </div>

                        <h2 class="fw-bold text-secondary mb-3">detaylar için yöneteticiyle görüşünüz</h2>
                        <p class="text-muted col-md-8 mx-auto mb-4">
                          
                        </p>

                        <div class="p-4 bg-white rounded border text-start d-none">
                        </div>

                        <a href="{{ route('dashboard') }}" class="btn btn-primary fw-bold px-4">
                            <i class="fas fa-arrow-left me-2"></i> Yönetim Paneline Dön
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>