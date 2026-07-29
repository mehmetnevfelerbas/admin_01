<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="card shadow-sm border-0 p-4" style="width: 100%; max-width: 420px;">
        <h3 class="text-center fw-bold mb-1">Hesap Oluştur</h3>
        <p class="text-center text-muted small mb-4">Kayıt talebiniz yönetici onayına gönderilecektir.</p>

        <form id="registerForm">
            @csrf
            <div class="mb-3">
                <label class="form-label">Ad Soyad</label>
                <input type="text" name="name" class="form-control" placeholder="Adınız Soyadınız" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email adresinizi giriniz." required>
            </div>

            <div class="mb-3">
    <label class="form-label">Telefon Numarası</label>
    <input type="text" name="phone" class="form-control" placeholder="05XXXXXXXXX" required>
</div>
            <div class="mb-3">
                <label class="form-label">Şifre</label>
                <input type="password" name="password" class="form-control" placeholder="Şifrenizi giriniz." required>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">Kayıt Talebi Gönder</button>
        </form>

        <div class="text-center mt-3 small">
            Zaten hesabınız var mı? <a href="{{ route('login') }}">Giriş Yap</a>
        </div>
    </div>
    <!-- İletişim Bilgileri Kutusu -->
<div class="mt-4 pt-3 border-top text-right">
    <p class="small text-muted mb-2">Destek veya soru/talepleriniz için bizimle iletişime geçebilirsiniz:</p>
    
    <div class="d-flex justify-content-center gap-3 small text-secondary">
        <div>
            <i class="bi bi-telephone-fill text-primary me-1"></i>
            <strong>Telefon:</strong> 0326 275 85
        </div>
        <div>
            <i class="bi bi-envelope-fill text-primary me-1"></i>
            <strong>E-posta:</strong> destek@mne.com
        </div>
    </div>
</div>

    <!-- JQUERY & AJAX İLE İSTEK GÖNDERME -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('#registerForm').on('submit', function(e) {
            e.preventDefault();
            
            $.ajax({
                url: "{{ route('api.register') }}",
                type: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    if(response.status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Başarılı!',
                            text: response.message,
                            confirmButtonText: 'Giriş Sayfasına Git'
                        }).then(() => {
                            window.location.href = "{{ route('login') }}";
                        });
                    } else {
                        Swal.fire({ icon: 'error', title: 'Hata', text: response.message });
                    }
                },
                error: function() {
                    Swal.fire({ icon: 'error', title: 'Hata', text: 'Bir sorun oluştu.' });
                }
            });
        });
    </script>
</body>
</html>