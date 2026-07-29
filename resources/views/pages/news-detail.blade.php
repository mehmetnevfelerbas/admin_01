<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $blog->translate->title ?? $blog->title ?? 'Haber Detayı' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">

  
    <nav class="navbar navbar-dark bg-dark py-3">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/haberler') }}">
                <i class="bi bi-arrow-left me-2"></i>Haberlere Dön
            </a>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card border-0 shadow-sm p-4 p-md-5 rounded-4">
                 
                    <h1 class="fw-bold mb-3 text-dark display-6">
                        {{ $blog->translate->title ?? $blog->title ?? 'Başlık Yok' }}
                    </h1>
                    
                    @php
                        $summary = $blog->translate->description ?? $blog->description ?? null;
                    @endphp
                    @if(!empty($summary))
                        <h5 class="text-secondary fw-normal mb-3 lh-base">
                            {{ $summary }}
                        </h5>
                    @endif

                   
                    <div class="text-muted small mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-clock"></i> 
                        <span>{{ $blog->created_at ? $blog->created_at->format('d.m.Y H:i') : date('d.m.Y H:i') }}</span>
                    </div>

                    
                    <hr class="text-muted opacity-25 my-4">
                    @if($blog->image)
                        <img src="{{ asset('storage/'.$blog->image) }}" class="img-fluid rounded-3 mb-4 w-100" style="max-height: 450px; object-fit: cover;" alt="Haber Görseli">
                    @endif
                    <div class="fs-5 text-secondary lh-lg news-content">
                        {!! nl2br(e($blog->translate->content ?? $blog->content ?? $blog->translate->text ?? $blog->text ?? $summary ?? 'İçerik bulunmuyor.')) !!}
                    
<div class="d-flex align-items-center gap-3 my-4 pt-3 border-top">
    <span class="fw-semibold text-secondary">Bu haberi yararlı buldunuz mu?</span>
    
    <button id="likeBtn" class="btn btn-outline-success btn-sm rounded-pill px-3 d-flex align-items-center gap-2">
        <i class="bi bi-hand-thumbs-up-fill"></i>
        <span>Beğen</span>
        <span id="likeCount" class="badge bg-success rounded-pill">{{ $blog->likes_count ?? 0 }}</span>
    </button>

    <button id="dislikeBtn" class="btn btn-outline-danger btn-sm rounded-pill px-3 d-flex align-items-center gap-2">
        <i class="bi bi-hand-thumbs-down-fill"></i>
        <span>Beğenme</span>
        <span id="dislikeCount" class="badge bg-danger rounded-pill">{{ $blog->dislikes_count ?? 0 }}</span>
    </button>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const blogId = "{{ $blog->id }}";
    const csrfToken = "{{ csrf_token() }}";

    const likeBtn = document.getElementById('likeBtn');
    const dislikeBtn = document.getElementById('dislikeBtn');

   
    if (localStorage.getItem('voted_blog_' + blogId)) {
        disableButtons();
    }

    likeBtn.addEventListener('click', function() {
        sendVote(`/haber/${blogId}/like`, 'like');
    });

    dislikeBtn.addEventListener('click', function() {
        sendVote(`/haber/${blogId}/dislike`, 'dislike');
    });

    function sendVote(url, type) {
        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === 'success') {
                if(type === 'like') {
                    document.getElementById('likeCount').innerText = data.likes;
                } else {
                    document.getElementById('dislikeCount').innerText = data.dislikes;
                }
                localStorage.setItem('voted_blog_' + blogId, true);
                disableButtons();
            }
        });
    }

    function disableButtons() {
        likeBtn.classList.add('disabled');
        dislikeBtn.classList.add('disabled');
    }
});
</script>                    
                    
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>
</html>