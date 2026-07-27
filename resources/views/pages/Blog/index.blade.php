@extends('layouts.app.app')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <h4 class="">Blog/Haber Listesi</h4>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <span class="badge badge-primary bg-primary float-end p-2" style="font-style: italic;font-weight:600">Blog/Haber
                ile blog ve haber kayıtlarınızı listeleyebilirsiniz.</span>
        </div>
    </div>
    <hr />
    <div class="col-12 w-100">
        <div class="card">
            <div class="card-header card-border">
                <div class="row">
                    <div class="col-sm-12 col-md-8 col-lg-8">
                        <a href="{{ route('blog/new') }}"><button type="button" class="btn btn-success min-btn">Yeni Ekle</button></a>
                        <button type="button" class="btn btn-primary min-btn ">Düzenle</button>
                        <button type="button" class="btn btn-danger min-btn">Sil</button>
                    </div>
                    <div class="col-sm-12 col-md-2 col-lg-2">
                        <small>Durum</small>
                        <br />
                        <select class="form-control list-cmb status-cmb">
                            <option value="1" selected>Aktif</option>
                            <option value="0">Pasif</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-2 col-lg-2">
                        <small>Tip</small>
                        <br />
                        <select class="form-control list-cmb type-cmb">
                            <option value="0" selected>Tümü</option>
                            <option value="1" >Blog</option>
                            <option value="2">Haber</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered" id="blogTable">
                    <thead>
                        <tr>
                            <th>Başlık</th>
                            <th>Açıklama</th>
                            <th>Tip</th> {{-- Blog/Haber --}}
                            <th>Durumu</th>
                            <th width="250">İşlem</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
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
