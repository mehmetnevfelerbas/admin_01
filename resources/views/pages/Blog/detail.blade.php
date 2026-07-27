@extends('layouts.app.app')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <h4 class="">Blog {{ $blog != null ? 'Güncelleme' : 'Kayıt' }} İşlemleri </h4>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <span class="badge badge-primary bg-primary float-end p-2" style="font-style: italic;font-weight:600">Sisteme yeni
                bir Blog/Haber ekleyebilir veya düzenleyebilirsiniz.</span>

        </div>
    </div>
    <hr />

    <div class="card">
        <div class="card-header card-border">

            <div class="row">
                <div class="col-sm-12 col-md-8 col-lg-8">
                    <a href="{{ route('blog') }}"><button type="button" class="btn btn-primary min-btn">Listeye
                            Dön</button></a>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <button type="button" class="btn btn-success min-btn float-end blogSaveBtn">Bilgileri Kaydet</button>
                    <select class="form-control float-end w-50 me-2 lang">
                        <option value="tr" selected>Türkçe</option>
                        <option value="en">İngilizce</option>
                        <option value="de">Almanca</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form id="blogForm">

                <div class="row">

                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="col-form-label">Başlık *</label>
                            <input type="text" class="form-control title" name="title" placeholder="Başlık giriniz." />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="col-form-label">Açıklama</label>
                            <input type="text" class="form-control description" placeholder="Açıklama yazınız." />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="col-form-label">Kapak Görseli</label>
                            <input type="file" class="form-control " placeholder="Kapak görseli yükleyiniz." />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="col-form-label">Durum *</label>
                            <select class="form-control status" placeholder="Durum seçiniz.">
                                <option value="1" selected>Aktif</option>
                                <option value="0">Pasif</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label class="col-form-label">Tip *</label>
                            <select class="form-control type" placeholder="Tip seçiniz.">
                                <option value="1" selected>Blog</option>
                                <option value="2">Haber</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group">
                            <label class="col-form-label">İçerik *</label>
                            <textarea class="form-control content_text w-100" id="editor" name="content" rows="10" placeholder="İçerik giriniz."></textarea>
                        </div>
                    </div>

                </div>

            </form>

        </div>
    </div>

    <input type="hidden" class="blog_id" value="{{ $blog }}"/>
@endsection

@section('js')
    <script type="text/javascript">
        var checkInterval = setInterval(function() {
            if (app.loader !== undefined && app.loader !== null) {
                app.loader.setModule("Blog");
                clearInterval(checkInterval);
            }
        }, 500);
    </script>
@endsection
