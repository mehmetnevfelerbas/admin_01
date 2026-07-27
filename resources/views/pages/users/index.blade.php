@extends('layouts.app.app')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <h4 class="">Kullanıcı Listesi</h4>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <span class="badge badge-primary bg-primary float-end p-2" style="font-style: italic;font-weight:600">Kullanıcı listesi ile sistemdeki kullanıcıları yönetebilirsiniz.</span>

        </div>
    </div>
    <hr/>
    <div class="col-12 w-100">
        <div class="card">
            <div class="card-header card-border">
                <a href="{{ route('users/new') }}"><button type="button" class="btn btn-success min-btn">Yeni
                        Ekle</button></a>
                <button type="button" class="btn btn-primary min-btn editUserBtn">Düzenle</button>
                <button type="button" class="btn btn-danger min-btn deleteUserBtn">Sil</button>
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered" id="usersTable">
                    <thead>
                        <tr>
                            <th>Adı Soyadı</th>
                            <th>E-Mail Adresi</th>
                            <th>Telefon Numarası</th>
                            <th>Durumu</th>
                            <th width="150">İşlem</th>
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
                app.loader.setModule("Users");
                clearInterval(checkInterval);
            }
        }, 500);
    </script>
@endsection
